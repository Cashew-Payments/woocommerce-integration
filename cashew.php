<?php

/**
 * Plugin Name: cashew Payments
 * Description: allow customers to buy now pay later for WooCommerce
 * Version: 1.0.6
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

error_log(get_option( 'woocommerce_hold_stock_minutes' ) > 0);

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
