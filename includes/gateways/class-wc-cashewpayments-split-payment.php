<?php
/**
 * Cashewpayments split payment gateway
 */

defined( 'ABSPATH' ) || exit;

/**
 * Cashewpayments split payment gateway class.
 */
final class WC_Cashewpayments_Split_Payment extends WC_Cashewpayments_Gateway {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id                 = WC_Cashewpayments::PAYMENT_GATEWAY_ID;
		$this->method_title       = __( 'Cashewpayments Split Payment', 'cashewpayments' );
		$this->method_description = __( 'Buy now and pay later with zero interest and zero fees.', 'cashewpayments' );
		$this->order_button_text  = __( 'Proceed to Cashewpayments', 'cashewpayments' );

		parent::__construct();
		$this->icon = WC_CASHEWPAYMENTS_DIR_URL . 'assets/images/' . $this->id . '-' . $this->theme . '.png';
	}

	/**
	 * Initialise settings form fields.
	 */
	public function init_form_fields() {
		$this->form_fields = include WC_CASHEWPAYMENTS_DIR_PATH . 'includes/settings/cashewpayments-split-payment.php';
	}
}
