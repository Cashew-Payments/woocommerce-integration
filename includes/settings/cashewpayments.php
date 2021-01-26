<?php
/**
 * Cashewpayments settings
 */

defined( 'ABSPATH' ) || exit;

return array(
	'enabled'                => array(
		'title'   => __( 'Enable/Disable', 'cashewpayments' ),
		'type'    => 'checkbox',
		'label'   => __( 'Enable cashew Payments', 'cashewpayments' ),
		'default' => 'yes',
	),
	'title'                  => array(
		'title'       => __( 'Title', 'cashewpayments' ),
		'type'        => 'text',
		'description' => __( 'Title to be shwon in checkout.', 'cashewpayments' ),
		'default'     => __( 'cashew Payments', 'cashewpayments' ),
		'desc_tip'    => true,
	),
	'description'            => array(
		'title'       => __( 'Description', 'cashewpayments' ),
		'type'        => 'text',
		'desc_tip'    => true,
		'description' => __( 'Description for the payment method in checkout.', 'cashewpayments' ),
		'default'     => __( 'Pay small installments without fee charge.', 'cashewpayments' ),
	),
	'store_url'            => array(
		'title'       => __( 'Store Url', 'cashewpayments' ),
		'type'        => 'text',
		'description' => __( 'Get your merchant ID from Cashewpayments.', 'cashewpayments' ),
		'default'     => '',
		'desc_tip'    => true,
	),
	'api_key'     => array(
		'title'       => __( 'Api key', 'cashewpayments' ),
		'type'        => 'password',
		'description' => __( 'Get your sandbox secret key from Cashewpayments.', 'cashewpayments' ),
		'default'     => '',
		'desc_tip'    => true,
	),
	'min_order'                => array(
		'title'       => __( 'Mininum order', 'cashewpayments' ),
		'type'        => 'text',
		'label'       => __( 'Enable Cashewpayments sandbox', 'cashewpayments' ),
		'default'     => 'yes',
		'description' => __( 'Cashewpayments sandbox can be used to test payments.', 'cashewpayments' ),
	),
	'max_order'             => array(
		'title'       => __( 'Maximum order', 'cashewpayments' ),
		'type'        => 'text',
		'label'       => __( 'Enable in-context checkout', 'cashewpayments' ),
		'default'     => 'yes',
		'description' => __( 'Checkout flow that keeps customers local to your website.', 'cashewpayments' ),
	),
	'api_domain'                  => array(
		'title'       => __( 'Environment', 'cashewpayments' ),
		'type'        => 'select',
		'desc_tip'    => true,
		'description' => __( 'This controls the color to coordinate and contrast with different backgrounds.', 'cashewpayments' ),
		'default'     => 'https://api-sandbox.cashewpayments.com/v1/',
		'options'     => array(
			'https://api-sandbox.cashewpayments.com/v1/' => __( 'Sandbox', 'cashewpayments' ),
			'https://api.cashewpayments.com/v1/'  => __( 'Production', 'cashewpayments' ),
		),
	),
);
