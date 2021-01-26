<?php
/**
 * Cashewpayments scripts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'wc-cashewpayments-js'       => array(
		'src'     => 'https://cdn.cashewpayments.io/v1/js/cashewpayments.js',
		'deps'    => array(),
		'version' => WC_CASHEWPAYMENTS_VERSION,
	),
	'wc-cashewpayments-init'     => array(
		'src'     => WC_CASHEWPAYMENTS_DIR_URL . 'assets/js/cashewpayments.js',
		'deps'    => array( 'wc-cashewpayments-js', 'jquery' ),
		'version' => WC_CASHEWPAYMENTS_VERSION,
	),
	'wc-cashewpayments-checkout' => array(
		'src'     => WC_CASHEWPAYMENTS_DIR_URL . 'assets/js/checkout.js',
		'deps'    => array( 'wc-cashewpayments-init' ),
		'version' => WC_CASHEWPAYMENTS_VERSION,
	),
);
