<?php
/*
/* add product widget 
*/
function add_product_widget($th)
{
    echo 'HER';
    print_r($th);
    global $product;
    $price = $product->get_price();
    $language = explode('_', get_locale())[0];
    $currency = get_woocommerce_currency_symbol();
    echo '<div id="cashew-widget" data-language="' . $language . '" data-amount="' . $price . '" data-currency="' . $currency . '">' .
        '</div>' .
        ' <script>(function(w,d,s) {var f=d.getElementsByTagName(s)[0];var a=d.createElement(\'script\');a.async=true;a.src=\'https://s3-eu-west-1.amazonaws.com/cdn-dev.cashewpayments.com/widgets/woocommerce.widget.min.js\';f.parentNode.insertBefore(a,f);}(window, document, \'script\'));</script> ';
}
