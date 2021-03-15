<?php
defined('ABSPATH') || exit;

add_action('woocommerce_cart_totals', 'add_cart_widget');
add_action('woocommerce_single_product_summary', 'add_product_widget');
$lang = get_locale();

function wc_cashew_scripts()
{
    $assetsPath = plugin_dir_url(__FILE__);
    $isSandbox = get_option('woocommerce_cashew_payments_settings')['sandbox'] == 'yes';
    $domain = $isSandbox ? 's3-eu-west-1.amazonaws.com/cdn-sandbox' : 'cdn';
    if (is_checkout()) {
        wp_enqueue_script('cashew-checkout', 'https://'.$domain.'.cashewpayments.com/widgets/woocommerce.checkout.min.js', array('jquery'), '1.0.2', true);
    }
    wp_enqueue_script('cashew-helper-checkout', $assetsPath . '../assets/js/cashew-checkout.js', array('jquery'), '1.0.2', true);
    if (is_checkout()) {
        wp_deregister_script('wc-checkout');
        wp_enqueue_script('wc-checkout', $assetsPath . '../assets/js/woocommerce-checkout.js', array('jquery'), '1.0.2', true);
    }
    wp_enqueue_script('jquery');
    wp_localize_script('jquery', 'cashew_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'wc_cashew_scripts', 12);
