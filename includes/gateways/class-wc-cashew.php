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
    public function init_form_fields()
    {
        form_fields($this);
    }
    public function get_icon()
    {
        $icon = $this->icon ? '<img src="' . WC_HTTPS::force_https_url($this->icon) . '" alt="' . esc_attr($this->get_title()) . '" />' : '';
        return apply_filters('woocommerce_gateway_icon', $icon, $this->id);
    }
    public function payment_fields()
    {
        if (get_locale() == 'ar') {
            $timesch = 'الدفع بالتقسيط بدون فوائد';
        } else {
            $timesch = $this->get_description();
        }
        echo '<div id="cover"><span>' . $timesch . '</span></div>';
    }
    public function process_payment($order_id)
    {

        return processPayment($order_id, $this, "cashew Payments", "wc_cashew_gateway");
    }
    public function cashew_response_handler()
    {
        return cashewResponseHandler($this);
    }
    public function process_refund($order_id, $amount = null, $reason = '')
    {
        return processRefund($order_id, $amount, $reason, $this);
    }
}
