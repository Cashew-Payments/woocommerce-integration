<?php

/**
 * Helper to prepare checkout payload
 */
function get_checkout_payload($order, $th, $type, $addon)
{
    $order_id = $order->get_meta('_alg_wc_custom_order_number') !== "" ? $order->get_meta('_alg_wc_custom_order_number') : $order->get_id();
    $currency = $order->get_currency();
    $total = $order->get_total();
    cashewApiAuth($th, $addon,  $currency);
    if ($currency == "USD") {
        $total = $total * 3.6730;
        $currency = "AED";
    }
    $headers =  getHeader($th);
    $notify_url = get_home_url(null, "?wc-api=" . $addon);
    $body = array(
        "orderReference" => $order_id,
        "totalAmount" => round($total, 4),
        "currencyCode" => $currency,
        "taxAmount" => $order->get_total_tax(),
        "language" => explode('_', get_locale())[0],
        "merchant" => array(
            "confirmationUrl" => $notify_url . "&o=" . $order->get_id() . "&s=s",
            "cancelUrl" => $notify_url . "&o=" . $order->get_id() . "&s=f",
        ),
        "discount" => $order->get_total_discount(),
        "customer" => array(
            "firstName" => $order->get_user()->first_name ? $order->get_user()->first_name : $order->get_billing_first_name(),
            "lastName" => $order->get_user()->last_name ? $order->get_user()->last_name : $order->get_billing_last_name(),
            "email" => $order->get_user()->user_email ? $order->get_user()->user_email : $order->get_billing_email(),
            "mobileNumber" => $order->get_billing_phone(),
        ),
        "billingAddress" => array(
            "title" => "",
            "firstName" => $order->get_billing_first_name(),
            "lastName" => $order->get_billing_last_name(),
            "line1" => $order->get_billing_address_1(),
            "line2" => $order->get_billing_address_2(),
            "city" => $order->get_billing_city(),
            "state" => $order->get_billing_state(),
            "postalcode" => $order->get_billing_postcode(),
            "country" => $order->get_billing_country(),
            "phone" => $order->get_billing_phone(),
        ),

        // Order
        "shipping" => array(
            "shipping_amount" => $order->get_shipping_total(),
            "address" => array(
                "title" => "",
                "firstName" => $order->get_shipping_first_name(),
                "lastName" => $order->get_shipping_last_name(),
                "line1" => $order->get_shipping_address_1(),
                "line2" => $order->get_shipping_address_2(),
                "city" => $order->get_shipping_city(),
                "state" => $order->get_shipping_state(),
                "postcode" => $order->get_shipping_postcode(),
                "country" => $order->get_shipping_country(),
                "phone" => $order->get_billing_phone(),
            )
        )
    );
    foreach ($order->get_items() as $item) {
        $product = wc_get_product($item['product_id']);
        $lines[] = array(
            "sku" => $product->get_sku(),
            "reference" => $item->get_id(),
            "title" => $product->get_title(),
            "upc" => $product->get_sku(),
            "quantity" => $item->get_quantity(),
            "unitPrice" => $product->get_price(),
            "currency" => $order->get_currency(),
            "image_url" => "",       //$product->get_image(),
        );
    }
    $body['items'] = $lines;
    $payload = array(
        'method' => 'POST',
        'headers' => $headers,
        'body' => wp_json_encode($body),
        'timeout' => 20
    );

    return $payload;
}
/**
 * Helper to prepare authentication header
 */
function getHeader($th)
{
    $headers = array(
        'Accept' => 'application/json; indent=4',
        'Content-Type' => 'application/json',
        'Access-Control-Allow-Origin' => '*',
        'Authorization' => $th->token
    );
    return $headers;
}
