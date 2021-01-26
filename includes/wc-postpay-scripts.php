<?php
/**
 * Postpay scripts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'wc-postpay-js'       => array(
		'src'     => 'https://s3-eu-west-1.amazonaws.com/cdn-dev.cashewpayments.com/widgets/woocommerce.widget.min.js',
		'deps'    => array(),
		'version' => WC_POSTPAY_VERSION,
	),
	'wc-postpay-init'     => array(
		'src'     => WC_POSTPAY_DIR_URL . 'assets/js/postpay.js',
		'deps'    => array( 'wc-postpay-js', 'jquery' ),
		'version' => WC_POSTPAY_VERSION,
	),
	'wc-postpay-checkout' => array(
		'src'     => WC_POSTPAY_DIR_URL . 'assets/js/checkout.js',
		'deps'    => array( 'wc-postpay-init' ),
		'version' => WC_POSTPAY_VERSION,
	),
);
