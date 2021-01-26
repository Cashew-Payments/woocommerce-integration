<?php
/**
 * Cashewpayments client
 */

defined( 'ABSPATH' ) || exit;

use Cashewpayments\Exceptions\CashewpaymentsException;
use Cashewpayments\Http\Request;
use Cashewpayments\Http\Response;
use Cashewpayments\HttpClients\ClientInterface;

/**
 * Cashewpayments HTTP client class.
 */
class WC_Cashewpayments_Client implements ClientInterface {

	/**
	 * Sends a request to the server and returns the response.
	 *
	 * @param \Cashewpayments\Http\Request $request Request to send.
	 * @param int|null              $timeout The timeout for the request.
	 *
	 * @return Response
	 *
	 * @throws CashewpaymentsException If response status code is invalid.
	 */
	public function send( Request $request, $timeout = null ) {
		$options = array(
			'method'  => $request->getMethod(),
			'headers' => array_merge(
				array(
					'Authorization' => 'Basic ' . base64_encode(
						implode( ':', $request->getAuth() )
					),
				),
				$request->getHeaders()
			),
			'body'    => wp_json_encode( $request->json() ),
			'timeout' => $timeout,
		);

		$response = wp_remote_request( $request->getUrl(), $options );

		if ( is_wp_error( $response ) ) {
			throw new CashewpaymentsException(
				$response->get_error_message(),
				$response->get_error_code()
			);
		}

		return new Response(
			$request,
			wp_remote_retrieve_response_code( $response ),
			wp_remote_retrieve_headers( $response )->getAll(),
			wp_remote_retrieve_body( $response )
		);
	}
}
