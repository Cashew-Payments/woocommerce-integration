<?php

function add_cart_widget($cart)
{
    global $woocommerce;
    $th = new WC_Cashew_Gateway;    
    $isSandbox = get_option('woocommerce_cashew_payments_settings')['sandbox'] == 'yes';
    $domain = $isSandbox ? 's3-eu-west-1.amazonaws.com/cdn-sandbox' : 'cdn';
    $price = $woocommerce->cart->total;
    $limit = get_option('woocommerce_cashew_payments_settings')['order_maximum'];
    $language = explode('_', get_locale())[0];
    $currency = get_woocommerce_currency_symbol();
    if (floatval($price) <= floatval($limit)) {
        echo '<div id="cashew-cart" data-language="' . $language . '" data-amount="' . $price . '" data-currency="' . $currency . '">' .
        '</div>' .
        ' <script>(function(w,d,s) {var f=d.getElementsByTagName(s)[0];var a=d.createElement(\'script\');a.async=true;a.src=\'https://'.$domain.'.cashewpayments.com/widgets/woocommerce.cart.min.js\';f.parentNode.insertBefore(a,f);}(window, document, \'script\'));</script> ';
    }
}
