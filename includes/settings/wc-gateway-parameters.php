<?php
/*
/* Plugin Parameters 
*/
function gatewayParameters($th)
{

    $th->id = 'cashew_payments';
    $th->icon = 'https://cdn.cashewpayments.com/images/logoblack.svg';
    $th->method_title = 'cashew Payments';
    $th->method_description =  'Enable payment in installments with zero interest';

    // Options supported by cashew payment gateway
    $th->supports = array(
        'products',
        'refunds'
    );

    $th->init_form_fields();

    $th->init_settings();
    $th->title = $th->get_option('title', 'Shop now, Pay later');
    $th->description = $th->get_option('description', 'Shop now, Pay later');
    $th->enabled = $th->get_option('enabled', 'yes');
    $th->sandbox = $th->get_option('sandbox', 'yes') === 'yes';
    $th->order_min = $th->get_option('order_minimum', '');
    $th->order_max = $th->get_option('order_maximum', '');
    $th->storeUrl = $th->get_option('store_url', '');
    $th->cashewPrivateKey = $th->get_option('cashew_private_key', '');

    $th->auth = $th->sandbox ? "https://api-dev.cashewpayments.com/v1/" : "https://api.cashewpayments.com/v1/";
    $th->api = $th->sandbox ? "https://api-dev.cashewpayments.com/v1/" : "https://api.cashewpayments.com/v1/";

    add_action('woocommerce_update_options_payment_gateways_' . $th->id, array($th, 'process_admin_options'));
}
