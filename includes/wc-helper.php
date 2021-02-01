<?php

/**
 * Spotii functions
 */

defined('ABSPATH') || exit;

/*
/* ADD WIDGETS, ENQUEUE NEEDED CSS AND JS
*/
add_action('woocommerce_proceed_to_checkout', 'add_cart_widget');
add_action('woocommerce_single_product_summary', 'add_product_widget');
$lang = get_locale();
/**
 * Register the script and inject parameters.
 *
 * @param string     $handle Script handle the data will be attached to.
 * @param array|null $params Parameters injected.
 */
function wc_cashew_scripts()
{
    if (is_checkout()) {
        wp_enqueue_script('cashew-checkout', 'https://s3-eu-west-1.amazonaws.com/cdn-dev.cashewpayments.com/widgets/woocommerce.checkout.min.js', array('jquery'), '0.01', true);
    }
    wp_enqueue_script('cashew-helper-checkout', plugin_dir_url(__FILE__) . '../assets/js/cashew-checkout.js', array('jquery'), '0.01', true);
    if (is_checkout()) {
        wp_deregister_script('wc-checkout');
        wp_enqueue_script('wc-checkout', plugin_dir_url(__FILE__) . '../assets/js/woocommerce-checkout.js', array('jquery'), '0.01', true);
    }
    wp_enqueue_script('jquery');
    wp_localize_script('jquery', 'cashew_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'wc_cashew_scripts', 12);
