<?php

/**
 * Plugin Name: cashew Payments
 * Description: allow customers to buy now pay later for WooCommerce
 * Version: 1.0.2
 * Author: cashew
 * Author URI: https://www.cashewpayments.com
 * Developer: Gonçalo Silva Dias
 * Developer URI: https://github.com/gsdias
 *
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package Cashew
 */
/*
 * Register our PHP class as a WooCommerce payment gateway
 */
defined('ABSPATH') || exit;

require __DIR__ . '/includes/settings/wc-cart-widget.php';
require __DIR__ . '/includes/settings/wc-product-widget.php';
add_action( 'woocommerce_before_cart_totals' , 'test' );
function test($cart)
{
    echo 'HERE';
    // global $product, $woocommerce;
    // $th = new WC_Cashew_Gateway;    
    // $isSandbox = get_option('woocommerce_cashew_payments_settings')['sandbox'] == 'yes';
    // $domain = $isSandbox ? 's3-eu-west-1.amazonaws.com/cdn-sandbox' : 'cdn';
    // $price = $product->get_price();
    // $language = explode('_', get_locale())[0];
    // $currency = get_woocommerce_currency_symbol();
    // echo $woocommerce->cart->total;
    // echo '<div id="cashew-widget" data-language="' . $language . '" data-amount="' . $price . '" data-currency="' . $currency . '">' .
    //     '</div>' .
    //     ' <script>(function(w,d,s) {var f=d.getElementsByTagName(s)[0];var a=d.createElement(\'script\');a.async=true;a.src=\'https://'.$domain.'.cashewpayments.com/widgets/woocommerce.widget.min.js\';f.parentNode.insertBefore(a,f);}(window, document, \'script\'));</script> ';
}


add_filter('woocommerce_payment_gateways', 'Cashew_add_gateway_class');

function Cashew_add_gateway_class($gateways)
{

    $gateways[] = 'WC_Cashew_Gateway';
    return $gateways;
}

add_action('plugins_loaded', 'Cashew_init_gateway_class');


function Cashew_init_gateway_class()
{

    if (class_exists('WC_Cashew_Gateway') || !class_exists('WC_Payment_Gateway')) {
        return;
    }

    define('WC_CASHEW_DIR', plugin_dir_path(__FILE__));
    /*
    /* Include files
    */
    include_once WC_CASHEW_DIR . 'includes/settings/wc-gateway-parameters.php';
    include_once WC_CASHEW_DIR . 'includes/request/wc-authentication.php';
    include_once WC_CASHEW_DIR . 'includes/settings/wc-admin-fields.php';
    include_once WC_CASHEW_DIR . 'includes/settings/wc-validations.php';
    include_once WC_CASHEW_DIR . 'includes/request/wc-checkout.php';
    include_once WC_CASHEW_DIR . 'includes/request/wc-process-payment.php';
    include_once WC_CASHEW_DIR . 'includes/request/wc-response-handler.php';
    include_once WC_CASHEW_DIR . 'includes/request/wc-refund.php';
    /*
    * Load cashew Gateway
    */
    include_once WC_CASHEW_DIR . '/includes/gateways/class-wc-cashew.php';
    /*
    * Load helper
    */
    include_once WC_CASHEW_DIR . '/includes/wc-helper.php';
}
