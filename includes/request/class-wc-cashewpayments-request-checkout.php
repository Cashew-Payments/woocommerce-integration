<?php
/**
 * Checkout request
 */

defined( 'ABSPATH' ) || exit;

/**
 * Checkout request class.
 */
class WC_Cashewpayments_Request_Checkout {

	/**
	 * Build request.
	 *
	 * @param string             $order_id Order id.
	 * @param WC_Cashewpayments_Gateway $gateway  Cashewpayments gateway instance.
	 *
	 * @return array
	 */
	public static function build( $order_id, $gateway ) {

		require_once WC_CASHEWPAYMENTS_DIR_PATH . 'includes/request/class-wc-cashewpayments-request-address.php';
		require_once WC_CASHEWPAYMENTS_DIR_PATH . 'includes/request/class-wc-cashewpayments-request-coupon.php';
		require_once WC_CASHEWPAYMENTS_DIR_PATH . 'includes/request/class-wc-cashewpayments-request-customer.php';
		require_once WC_CASHEWPAYMENTS_DIR_PATH . 'includes/request/class-wc-cashewpayments-request-guest.php';
		require_once WC_CASHEWPAYMENTS_DIR_PATH . 'includes/request/class-wc-cashewpayments-request-item.php';
		require_once WC_CASHEWPAYMENTS_DIR_PATH . 'includes/request/class-wc-cashewpayments-request-metadata.php';
		require_once WC_CASHEWPAYMENTS_DIR_PATH . 'includes/request/class-wc-cashewpayments-request-shipping.php';

		$order = wc_get_order( $order_id );

		$data = array(
			'order_id'        => $order_id . '-' . uniqid(),
			'total_amount'    => WC_Cashewpayments_Adapter::decimal( $order->get_total() ),
			'tax_amount'      => WC_Cashewpayments_Adapter::decimal( $order->get_total_tax() ),
			'currency'        => $order->get_currency(),
			'billing_address' => WC_Cashewpayments_Request_Address::build( $order->get_address( 'billing' ) ),
			'customer'        => $customer,
			'items'           => array_map(
				function( $item ) use ( $order ) {
					return WC_Cashewpayments_Request_Item::build( $order, $item );
				},
				array_values( $order->get_items() )
			),
			'discounts'       => array_map(
				'WC_Cashewpayments_Request_Coupon::build',
				array_values( $order->get_items( 'coupon' ) )
			),
			'merchant'        => array(
				'confirmation_url' => self::get_url( 'capture', $order->get_order_key(), $gateway->id ),
				'cancel_url'       => self::get_url( 'cancel', $order->get_order_key(), $gateway->id ),
			),
			'metadata'        => WC_Cashewpayments_Request_Metadata::build( $gateway ),
			'num_instalments' => $gateway::NUM_INSTALMENTS,
		);

		if ( is_user_logged_in() ) {
			$data['customer'] = WC_Cashewpayments_Request_Customer::build( $order->get_user_id() );
		} else {
			$data['customer'] = WC_Cashewpayments_Request_Guest::build( $order );
		}

		if ( $order->get_shipping_method() ) {
			$data['shipping'] = WC_Cashewpayments_Request_Shipping::build( $order );
		}

		return $data;
	}

	/**
	 * Create Api URL.
	 *
	 * @param string $action     Action to perform.
	 * @param string $order_key  Order key.
	 * @param string $gateway_id Cashewpayments gateway id.
	 *
	 * @return string
	 */
	public static function get_url( $action, $order_key, $gateway_id ) {
		return add_query_arg(
			array(
				'action'    => $action,
				'order_key' => $order_key,
			),
			WC()->api_request_url( $gateway_id )
		);
	}
}
