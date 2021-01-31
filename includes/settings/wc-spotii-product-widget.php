<?php
/*
/* add product widget 
*/
function add_product_widget()
{
    global $product;
    $th = new WC_Spotii_Gateway_Shop_Now_Pay_Later;
    $widget_text = $th->widget_text;
    $url = $th->popup_link;
    $theme = $th->widget_theme;
    $render = $th->render_path_product;
    $instal = $product->get_price();
    $curr = get_woocommerce_currency_symbol();
    $currency = get_woocommerce_currency();
        echo '<div id="spotii-product-widget">' .
            '</div><div id="spotii-product-widget-price" style="display:none;">' . $instal . '</div>' .
            '<script>window.spotiiConfig = {targetXPath: [\'#spotii-product-widget-price\'], renderToPath: [\'' . $render . '\'],currency: "' . $currency . '",templateLine:"' . $widget_text . '",theme:"' . $theme . '",minNote:"' . $custom_note_en . '",howItWorksURL : "' . $url . '",};</script>' .
            ' <script>(function(w,d,s) {var f=d.getElementsByTagName(s)[0];var a=d.createElement(\'script\');a.async=true;a.src=\'https://widget.spotii.me/v1/javascript/priceWidget-en.js\';f.parentNode.insertBefore(a,f);}(window, document, \'script\'));</script> ';
}
