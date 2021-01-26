<?php
/**
 * Cart widget.
 */

defined( 'ABSPATH' ) || exit;
?>

<div
	class="cashewpayments-widget"
	data-type="cart"
	data-amount="<?php echo WC_Cashewpayments_Adapter::decimal( WC()->cart->total )->jsonSerialize(); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>"
	data-currency="<?php echo get_woocommerce_currency(); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>"
></div>
