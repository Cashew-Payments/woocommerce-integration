<?php

/**
 * Called when checkout page redirects back to merchant page
 */
function cashewResponseHandler($th)
{
    $lang = get_locale();
    $errorChe = $lang == 'ar' ? 'خطأ في تأكيد الطلب: ' : 'Checkout Error: ';
    $order_id = $_GET['o'];
    $order = wc_get_order($order_id);
    $reference = $order->get_meta('reference');
    $token = $order->get_meta('token');
    if ($order->has_status('completed') || $order->has_status('processing')) {
        $redirect_url = $order->get_checkout_order_received_url();
        wp_redirect($redirect_url);
        exit;
    }
    $errorPaymentFailed = $lang == 'ar' ? "لقد حصل خطأ عند الدفع عن طريق سبوتي، رجاءً حاول مرة اخرى" : "Payment with cashew failed. Please try again";
    $status = $_GET['s'];
    // Check for url param success
    if ($status == 's') {
        try {
            // Capture payment
            $url = $th->api . 'orders/' . $reference .  '/capture/';
            $headers = array(
                'Accept' => 'application/json; indent=4',
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Authorization' => $token
            );
            $payload = array(
                'method' => 'POST',
                'headers' => $headers,
                'body' => '{}',
                'timeout' => 20
            );
            $response = wp_remote_post($url, $payload);
            if (is_wp_error($response)) {
                $order->add_order_note('Order capture failed');
                wc_add_notice(__($errorChe, 'woothemes') . $errorPaymentFailed, 'error');
                $order->update_status('cancelled', __('Order capture failed', 'woocommerce'));
                $redirect_url = $order->get_cancel_order_url();
                wp_redirect($redirect_url);
                die;
            }
            if (empty($response['body'])) {
                error_log('Response Empty [cashew_response_handler] ');
                throw new Exception(__('Empty response body'));
            }
            $response_body = $response['body'];
            $res = json_decode($response_body, true);
            if ($res['status'] === 'SUCCESS') {
                $order->add_order_note('Payment successful');
                //wc_add_notice(__('Payment Success: ', 'woothemes') . "Payment complete", 'success');
                $order->payment_complete();
                $redirect_url = $order->get_checkout_order_received_url();
                wp_redirect($redirect_url);
                error_log('redirect_url ' . $redirect_url);
                error_log('Order placed successfully [cashew_response_handler]');
                exit;
            } else {
                $order->add_order_note('Order capture failed');
                wc_add_notice(__($errorChe, 'woothemes') . $errorPaymentFailed, 'error');
                $order->update_status('cancelled', __('Order capture failed', 'woocommerce'));
                $redirect_url = $order->get_cancel_order_url();
                wp_redirect($redirect_url);
                die;
            }
        } catch (Exception $e) {
            error_log("Error on handler[cashew_response_handler]: " . $e->getMessage());
        }
    } else {
        // url param failed
        error_log('url param failed [cashew_response_handler]');
    }

    // If you are here, payment was unsuccessful
    $order->add_order_note('Payment with cashew failed');
    wc_add_notice(__($errorChe, 'woothemes') . $errorPaymentFailed, 'error');
    $order->update_status('cancelled', __('Payment with cashew failed', 'woocommerce'));
    $redirect_url = $order->get_cancel_order_url();
    wp_redirect($redirect_url);
    exit;
}
