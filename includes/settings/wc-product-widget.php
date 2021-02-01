<?php
/*
/* add product widget 
*/
function add_product_widget()
{
    global $product;
    $instal = $product->get_price();
    $curr = get_woocommerce_currency_symbol();
        echo '<div id="cashew-widget" data-amount="'.$instal.'" data-currency="' . $curr . '">' .
            '</div>' .
            ' <script>(function(w,d,s) {var f=d.getElementsByTagName(s)[0];var a=d.createElement(\'script\');a.async=true;a.src=\'https://s3-eu-west-1.amazonaws.com/cdn-dev.cashewpayments.com/widgets/woocommerce.widget.min.js\';f.parentNode.insertBefore(a,f);}(window, document, \'script\'));</script> ';
}
