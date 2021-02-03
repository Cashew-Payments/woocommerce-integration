<?php

function add_product_widget($th)
{
    global $product;

    $isSandbox = get_option('woocommerce_cashew_payments_settings')['sandbox'] == 'yes';
    $domain = $isSandbox ? 's3-eu-west-1.amazonaws.com/cdn-sandbox' : 'cdn';
    $price = $product->get_price();
    $language = explode('_', get_locale())[0];
    $currency = get_woocommerce_currency_symbol();
    echo '<div id="cashew-widget" data-language="' . $language . '" data-amount="' . $price . '" data-currency="' . $currency . '">' .
        '</div>' .
        ' <script>(function(w,d,s) {var f=d.getElementsByTagName(s)[0];var a=d.createElement(\'script\');a.async=true;a.src=\'https://'.$domain.'.cashewpayments.com/widgets/woocommerce.widget.min.js\';f.parentNode.insertBefore(a,f);}(window, document, \'script\'));</script> ';
}
