<?php

namespace Cashewpayments\Exceptions;

use Cashewpayments\Http\Response;

abstract class ApiException extends CashewpaymentsException
{
    /**
     * @var Response The response that threw the exception.
     */
    protected $response;

    /**
     * @var array Decoded response.
     */
    protected $decodedBody;

    /**
     * Returns the response entity.
     *
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
