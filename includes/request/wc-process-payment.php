<?php
/*
* Process payments: magic begins here
*/

function processPayment($order_id, $th, $type = null, $addon)
{
    $lang = get_locale();
    $order = new WC_Order($order_id);
    $currency = $order->get_currency();
    $total = $order->get_total();
    
    $min = (int)$th->order_min;
    $max = (int)$th->order_max;
    $totalConverted = (int)$total;
    
    if ($totalConverted < $min || $totalConverted > $max) {
        $errorMin = "We only support at the moment value up to ".$currency . " " . $max . ".";
        error_log("Exception [WP_Error] " . $errorMin);
        throw new Exception(__($errorMin));
    }

    $orderId = $order_id;
    // validate currency 
    
    if (!validate_curr($currency)) {
        $errorCurr = $lang == 'ar' ? "سبوتي لا يدعم هذه العملة" : "Currency is not supported";
        error_log("Exception [WP_Error Process Payment] " . $errorCurr . $currency);
        throw new Exception(__($errorCurr));
    }
    try {
        $url = $th->api . 'checkouts/';

        $payload = get_checkout_payload($order, $th, $type, $addon);
        $response = wp_remote_post($url, $payload);
        add_action('woocommerce_api_' . $addon, array($th, 'cashew_response_handler'));


        if (is_wp_error($response)) {
            error_log("Exception [WP_Error Process Payment]: " . $response);
            throw new Exception(__('Network connection issue'));
        }
        if (empty($response['body'])) {
            error_log("Exception [Response Body Empty]: " . $response);
            throw new Exception(__('Empty response body'));
        }

        $response_body = $response['body'];
        $response_body_arr = json_decode($response_body, true);

        if (array_key_exists('token', $response_body_arr['data'])) {
            $redirect_url = $response_body_arr['data']['url'];
            $order->update_meta_data('reference', $response_body_arr['data']['orderId']);
            $order->save();
            return array('result' => 'success', 'redirect' => "", 'token' => $response_body_arr['data']['token'], 'storeToken' => $th->token, "checkout_url" => $redirect_url, "orderId" => $response_body_arr['data']['orderId'], "api" => $th->api, "cancelURL" => $order->get_cancel_order_url(), "sucessURL" => $order->get_checkout_order_received_url());
        } else {
            error_log("Error on process payment: " . $response_body);
            $res = json_decode($response_body, true);
        }
    } catch (Exception $e) {
        error_log("Error on process_payment: " . $e->getMessage());
    }
}
