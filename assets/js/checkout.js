/**
 * Initializes In-Context Checkout.
 */

/* global wc_cashewpayments_checkout_params */
jQuery( document ).ready(
	function( $ ) {
		cashewpayments.checkout( wc_cashewpayments_checkout_params.token );
	}
);
