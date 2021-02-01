<?php

/**
 * Plugin Name: cashew Payments
 * Description: allow customers to buy now pay later for WooCommerce
 * Version: 1.0.0
 * Author: cashew
 * Author URI: https://www.cashewpayments.com
 * Developer: Gonçalo Silva Dias
 * Developer URI: https://github.com/gsdias
 *
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package cashew
 */
/*
 * Register our PHP class as a WooCommerce payment gateway
 */
defined('ABSPATH') || exit;

require __DIR__ . '/includes/settings/wc-spotii-cart-widget.php';
require __DIR__ . '/includes/settings/wc-spotii-product-widget.php';

add_filter('woocommerce_payment_gateways', 'cashew_add_gateway_class');

function cashew_add_gateway_class($gateways)
{

    $gateways[] = 'WC_Cashew_Gateway';
    return $gateways;
}

add_action('plugins_loaded', 'cashew_init_gateway_class');


function cashew_init_gateway_class()
{

    if (class_exists('WC_Cashew_Gateway') || !class_exists('WC_Payment_Gateway')) {
        return;
    }

    define('WC_CASHEW_DIR', plugin_dir_path(__FILE__));
    /*
    /* Include files
    */
    include_once WC_CASHEW_DIR . 'includes/settings/wc-spotii-gateway-parameters.php';
    include_once WC_CASHEW_DIR . 'includes/request/wc-authentication.php';
    include_once WC_CASHEW_DIR . 'includes/settings/wc-spotii-form-fields.php';
    include_once WC_CASHEW_DIR . 'includes/settings/wc-spotii-validation.php';
    include_once WC_CASHEW_DIR . 'includes/request/wc-spotii-payload.php';
    include_once WC_CASHEW_DIR . 'includes/request/wc-spotii-process-payment.php';
    include_once WC_CASHEW_DIR . 'includes/request/wc-spotii-response-handler.php';
    include_once WC_CASHEW_DIR . 'includes/request/wc-spotii-refund.php';
    /*
    * Load cashew Gateway
    */
    include_once WC_CASHEW_DIR . '/includes/gateways/class-wc-cashew.php';
    /*
    * Load Spotii function 
    */
    include_once WC_CASHEW_DIR . '/includes/wc-helper.php';
}
