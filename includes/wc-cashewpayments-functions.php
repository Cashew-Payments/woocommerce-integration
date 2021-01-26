<?php
/**
 * Cashewpayments functions
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get Cashewpayments template.
 *
 * @param string $template_name Template name.
 * @param array  $args          Arguments. (default: array).
 * @param string $template_path Template path. (default: '').
 */
function wc_get_cashewpayments_template( $template_name, $args = array(), $template_path = '' ) {
	wc_get_template( $template_name, $args, $template_path, WC_CASHEWPAYMENTS_DIR_PATH . 'templates/' );
}

/**
 * Register the script and inject parameters.
 *
 * @param string     $handle Script handle the data will be attached to.
 * @param array|null $params Parameters injected.
 */
function wc_cashewpayments_script( $handle, $params = null ) {
	$script = ( include 'wc-cashewpayments-scripts.php' )[ $handle ];

	wp_enqueue_script( $handle, $script['src'], $script['deps'], $script['version'], true );

	if ( null !== $params ) {
		wp_localize_script( $handle, str_replace( '-', '_', $handle ) . '_params', $params );
	}
}

/**
 * Register and load cashewpayments-js script.
 *
 * @param array $settings Gateway settings.
 */
function wc_cashewpayments_js( $settings ) {
	wc_cashewpayments_script( 'wc-cashewpayments-js' );

	wc_cashewpayments_script(
		'wc-cashewpayments-init',
		array(
			'sandbox'    => 'yes' === $settings['sandbox'],
			'merchantId' => $settings['merchant_id'],
			'theme'      => $settings['theme'] ?? 'light',
			'locale'     => get_locale(),
		)
	);
}
