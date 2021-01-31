<?php
/*
/* Plugin Parameters 
*/
function gatewayParameters($th, $type = null)
{

    $th->id = 'spotii_shop_now_pay_later';
    $type == "Shop Now Pay Later" ? $th->icon = 'https://spotii.me/img/logo.svg' : '';
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
    // AED api 
    $th->storeUrl = $th->get_option('store_url', '');
    $th->cashewPrivateKey = $th->get_option('cashew_private_key', '');
    // Widget settings
    $th->widget_theme = $th->get_option('widget_theme', '');
    $th->widget_text = $th->get_option('widget_text', '');
    $th->popup_link = $th->get_option('popup_learnMore_link', '');
    $th->show_custom_note_ar = $th->get_option('show_custom_note_ar', '');
    $th->show_custom_note_en = $th->get_option('show_custom_note_en', '');
    $th->render_path_product = $th->get_option('render_path_product', '');
    $th->render_path_cart = $th->get_option('render_path_cart', '');

    $th->auth = $th->testMode ? "https://api-dev.cashewpayments.com/v1/" : "https://api.cashewpayments.com/v1/";
    $th->api = $th->testMode ? "https://api-dev.cashewpayments.com/v1/" : "https://api.cashewpayments.com/v1/";

    add_action('woocommerce_update_options_payment_gateways_' . $th->id, array($th, 'process_admin_options'));
}
