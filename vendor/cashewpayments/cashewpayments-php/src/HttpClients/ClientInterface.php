<?php

namespace Cashewpayments\HttpClients;

use Cashewpayments\Http\Request;

interface ClientInterface
{
    /**
     * Sends a request to the server and returns the response.
     *
     * @param Request  $request Request to send.
     * @param int|null $timeout The timeout for the request.
     *
     * @return \Cashewpayments\Http\Response Response from the server.
     *
     * @throws \Cashewpayments\Exceptions\CashewpaymentsException
     */
    public function send(Request $request, $timeout = null);
}
