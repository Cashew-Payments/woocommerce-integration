<?php
/*
/* Plugin Parameters 
*/
function gatewayParameters($th, $type = null)
{

    $th->id = 'cashew_payments';
    $type == "Shop Now Pay Later" ? $th->icon = 'https://cdn.cashewpayments.com/images/logoblack.svg' : '';
    $th->method_title = 'cashew Payments';
    $th->method_description =  'Enable payment in installments with zero interest';

    // Options supported by Spotii payment gateway
    $th->supports = array(
        'products',
        'refunds'
    );

    // Initialize fields in admin panel
    $th->init_form_fields();

    // Load settings
    $th->init_settings();
    $th->title = $th->get_option('title', 'Shop now, Pay later');
    $th->description = $th->get_option('description', 'Shop now, Pay later');
    $th->enabled = $th->get_option('enabled', 'yes');
    $th->testMode = false;
    $th->testMode = 'yes' === $th->get_option('testmode', 'yes');
    $th->order_min = $th->get_option('order_minimum', '');
    $th->order_max = $th->get_option('order_maximum', '');
    $th->storeUrl = $th->get_option('store_url', '');
    $th->cashewPrivateKey = $th->get_option('cashew_private_key', '');

    $th->auth = $th->testMode ? "https://api-dev.cashewpayments.com/v1/" : "https://api.cashewpayments.com/v1/";
    $th->api = $th->testMode ? "https://api-dev.cashewpayments.com/v1/" : "https://api.cashewpayments.com/v1/";

    add_action('woocommerce_update_options_payment_gateways_' . $th->id, array($th, 'process_admin_options'));
}
