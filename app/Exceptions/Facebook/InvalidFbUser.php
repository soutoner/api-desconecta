<?php

namespace App\Exceptions\Facebook;

use Phalcon\Http\Response;

class InvalidFbUser extends \Exception
{
    protected $resource;

    public function __construct($resource, $message = 'Fb user is not valid', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->resource = $resource;
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    /**
     * Returns HTTP response explaining the error that caused the exception.
     *
     * @return Response
     */
    public function returnResponse()
    {
        $response = new Response();
        $response->setStatusCode(409, 'Fb user is not valid');
        $response->setJsonContent(
            [
                'status' => 'ERROR',
                'message' => $this->resource->getMessages(),
            ]
        );

        return $response;
    }
}
