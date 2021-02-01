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
function wc_spotii_script()
{
    wp_enqueue_style('spotii-gateway', plugin_dir_url(__FILE__) .  '../assets/css/spotii-checkout.css', true);
    if (is_checkout()) {
        wp_enqueue_script('cashew-checkout', 'https://s3-eu-west-1.amazonaws.com/cdn-dev.cashewpayments.com/widgets/woocommerce.checkout.min.js', array('jquery'), '0.01', true);
    }
    wp_enqueue_script('spotii-checkout', plugin_dir_url(__FILE__) . '../assets/js/spotii-checkout.js', array('jquery'), '0.01', true);
    if (is_checkout()) {
        wp_deregister_script('wc-checkout');
        wp_enqueue_script('wc-checkout', plugin_dir_url(__FILE__) . '../assets/js/woocommerce-checkout.js', array('jquery'), '0.01', true);
    }
    wp_enqueue_script('jquery');
    wp_localize_script('jquery', 'spotii_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'wc_spotii_script', 12);

/*
/* Admin js for hide and show sandbox fields
*/
function admin_js()
{
?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            //Conditional calue 
            $("input[id*='order_minimum']").on("change paste keyup", function() {
                if (parseFloat($("input[id*='order_minimum']").val()) < 0) {
                    if (!$('#error-code-min').length) {
                        $("#woocommerce_spotii_shop_now_pay_later_order_minimum").parent().parent().append("<p id='error-code-min' style='color:red;'>Please enter a value more than 0 AED</p>");
                    } else {
                        $("#error-code-min").show();
                    }
                    $(".submit").children(0).prop("disabled", true);
                } else {
                    if ($('#error-code-min').length) {
                        $("#error-code-min").hide();
                    }
                    $(".submit").children(0).prop("disabled", false);
                }
            });
        });
    </script>
<?php }

add_action('admin_head', 'admin_js');
