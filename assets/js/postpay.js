/**
 * Initializes Postpay instance.
 */

/* global wc_postpay_init_params */
jQuery( document ).ready(
	function( $ ) {
		if (window.cashew) {
			window.cashew.init( wc_postpay_init_params );
		}
	}
);
