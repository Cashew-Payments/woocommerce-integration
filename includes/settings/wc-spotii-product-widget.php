<?php
/*
/* add product widget 
*/
function add_product_widget()
{
    global $product;
    $th = new WC_Spotii_Gateway_Shop_Now_Pay_Later;
    $instal = $product->get_price();
    $curr = get_woocommerce_currency_symbol();
    $currency = get_woocommerce_currency();
        echo '<div id="cashew-widget" data-amount="'.$instal.'" data-currency="' . $currency . '">' .
            '</div>' .
            '<script>window.spotiiConfig = {targetXPath: [\'#spotii-product-widget-price\'], currency: "' . $currency . '",};</script>' .
            ' <script>(function(w,d,s) {var f=d.getElementsByTagName(s)[0];var a=d.createElement(\'script\');a.async=true;a.src=\'https://s3-eu-west-1.amazonaws.com/cdn.cashewpayments.com/widgets/woocommerce.widget.min.js\';f.parentNode.insertBefore(a,f);}(window, document, \'script\'));</script> ';
}
