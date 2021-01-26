<?php
/**
 * Metadata request
 */

defined( 'ABSPATH' ) || exit;

/**
 * Metadata request class.
 */
class WC_Cashewpayments_Request_Metadata {

	/**
	 * Build request.
	 *
	 * @param WC_Cashewpayments_Gateway $gateway Cashewpayments gateway instance.
	 *
	 * @return array
	 */
	public static function build( $gateway ) {
		global $wp_version;

		return array(
			'php'      => array(
				'version' => phpversion(),
			),
			'platform' => array(
				'wordpress'   => array(
					'version' => $wp_version,
				),
				'woocommerce' => array(
					'version' => WC_VERSION,
				),
			),
			'module'   => array(
				'package' => 'cashewpayments/woocommerce',
				'version' => WC_CASHEWPAYMENTS_VERSION,
			),
			'settings' => array(
				'in_context' => $gateway->in_context,
				'debug'      => $gateway->debug,
				'theme'      => $gateway->theme,
				'css'        => $gateway->css,
			),
		);
	}
}
