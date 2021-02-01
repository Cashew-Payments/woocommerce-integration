<?php
/*
/* cashew Payments
*/
class WC_Cashew_Gateway extends WC_Payment_Gateway
{

    public function __construct()
    {

        add_action('woocommerce_api_wc_cashew_gateway', array($this, 'cashew_response_handler'));
        gatewayParameters($this);
    }
    /**
     * Define fields and labels in Admin Panel
     */
    public function init_form_fields()
    {
        form_fields($this);
    }
    /**
     * Get icon for checkout page
     */
    public function get_icon()
    {
        $icon = $this->icon ? '<img src="' . WC_HTTPS::force_https_url($this->icon) . '" alt="' . esc_attr($this->get_title()) . '" />' : '';
        return apply_filters('woocommerce_gateway_icon', $icon, $this->id);
    }
    /*
    * Get description text for checkout page
    */
    public function payment_fields()
    {
        if (get_locale() == 'ar') {
            $timesch = 'جدول المدفوعات';
        } else {
            $timesch = 'Pay in installments with zero interest';
        }
        echo '<div id="cover"><span >' . $timesch . '</span></div>';
    }
    /*
    * Process payments: magic begins here
    */
    public function process_payment($order_id)
    {

        return processPayment($order_id, $this, "cashew Payments", "wc_cashew_gateway");
    }
    /**
     * Called when checkout page redirects back to merchant page
     */
    public function cashew_response_handler()
    {
        return cashewResponseHandler($this);
    }
    /**
     * Process refunds
     */
    public function process_refund($order_id, $amount = null, $reason = '')
    {
        return processRefund($order_id, $amount, $reason, $this);
    }
}
