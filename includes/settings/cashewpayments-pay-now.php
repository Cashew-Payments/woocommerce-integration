<?php
/**
 * Cashewpayments pay now settings
 */

defined( 'ABSPATH' ) || exit;

return array(
	'enabled'                => array(
		'title'   => __( 'Enable/Disable', 'cashewpayments' ),
		'type'    => 'checkbox',
		'label'   => __( 'Enable Pay Now', 'cashewpayments' ),
		'default' => 'yes',
	),
	'title'                  => array(
		'title'       => __( 'Title', 'cashewpayments' ),
		'type'        => 'text',
		'description' => __( 'This controls the title which the user sees during checkout.', 'cashewpayments' ),
		'default'     => __( 'Credit or Debit Card', 'cashewpayments' ),
		'desc_tip'    => true,
	),
	'description'            => array(
		'title'       => __( 'Description', 'cashewpayments' ),
		'type'        => 'text',
		'desc_tip'    => true,
		'description' => __( 'This controls the description which the user sees during checkout.', 'cashewpayments' ),
		'default'     => __( 'Secure checkout with your Credit or Debit card.', 'cashewpayments' ),
	),
	'merchant_id'            => array(
		'title'       => __( 'Merchant ID', 'cashewpayments' ),
		'type'        => 'text',
		'description' => __( 'Get your merchant ID from Cashewpayments.', 'cashewpayments' ),
		'default'     => '',
		'desc_tip'    => true,
	),
	'secret_key'             => array(
		'title'       => __( 'Secret key', 'cashewpayments' ),
		'type'        => 'password',
		'description' => __( 'Get your secret Key from Cashewpayments.', 'cashewpayments' ),
		'default'     => '',
		'desc_tip'    => true,
	),
	'sandbox_secret_key'     => array(
		'title'       => __( 'Sandbox secret key', 'cashewpayments' ),
		'type'        => 'password',
		'description' => __( 'Get your sandbox secret key from Cashewpayments.', 'cashewpayments' ),
		'default'     => '',
		'desc_tip'    => true,
	),
	'sandbox'                => array(
		'title'       => __( 'Cashewpayments sandbox', 'cashewpayments' ),
		'type'        => 'checkbox',
		'label'       => __( 'Enable Cashewpayments sandbox', 'cashewpayments' ),
		'default'     => 'yes',
		'description' => __( 'Cashewpayments sandbox can be used to test payments.', 'cashewpayments' ),
	),
	'in_context'             => array(
		'title'       => __( 'In-context checkout', 'cashewpayments' ),
		'type'        => 'checkbox',
		'label'       => __( 'Enable in-context checkout', 'cashewpayments' ),
		'default'     => 'yes',
		'description' => __( 'Checkout flow that keeps customers local to your website.', 'cashewpayments' ),
	),
	'debug'                  => array(
		'title'       => __( 'Debug log', 'cashewpayments' ),
		'type'        => 'checkbox',
		'label'       => __( 'Enable logging', 'cashewpayments' ),
		'default'     => 'no',
		'description' => __( 'Log Cashewpayments events, such as HTTP requests.', 'cashewpayments' ),
	),
	'theme'                  => array(
		'title'       => __( 'Theme', 'cashewpayments' ),
		'type'        => 'select',
		'desc_tip'    => true,
		'description' => __( 'This controls the color to coordinate and contrast with different backgrounds.', 'cashewpayments' ),
		'default'     => 'light',
		'options'     => array(
			'light' => __( 'Light', 'cashewpayments' ),
			'dark'  => __( 'Dark', 'cashewpayments' ),
		),
	),
	'cashewpayments_pay_now_widget' => array(
		'title'       => __( 'Payment summary widget', 'cashewpayments' ),
		'type'        => 'checkbox',
		'label'       => __( 'Enable payment summary widget', 'cashewpayments' ),
		'default'     => 'yes',
		'description' => __( 'Show the payment summary on the payment method selection.', 'cashewpayments' ),
	),
	'css'                    => array(
		'title'       => __( 'CSS selector', 'cashewpayments' ),
		'type'        => 'text',
		'description' => __( 'Selector to hide the payment method if it is not available.', 'cashewpayments' ),
		'default'     => '',
		'desc_tip'    => true,
	),
);
