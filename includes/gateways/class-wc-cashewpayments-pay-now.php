<?php
/**
 * Cashewpayments pay now gateway
 */

defined( 'ABSPATH' ) || exit;

/**
 * Cashewpayments pay now gateway class.
 */
final class WC_Cashewpayments_Pay_Now extends WC_Cashewpayments_Gateway {

	/**
	 * Number of instalments.
	 *
	 * @var int
	 */
	const NUM_INSTALMENTS = 1;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id                 = WC_Cashewpayments::PAYMENT_GATEWAY_ID . '-pay-now';
		$this->method_title       = __( 'Cashewpayments Pay Now', 'cashewpayments' );
		$this->method_description = __( 'Accept payments using credit and debit cards.', 'cashewpayments' );
		$this->order_button_text  = __( 'Pay Now', 'cashewpayments' );
		$this->icon               = WC_CASHEWPAYMENTS_DIR_URL . 'assets/images/' . $this->id . '.png';

		parent::__construct();
	}

	/**
	 * Initialise settings form fields.
	 */
	public function init_form_fields() {
		$this->form_fields = include WC_CASHEWPAYMENTS_DIR_PATH . 'includes/settings/cashewpayments-pay-now.php';
	}
}
