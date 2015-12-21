<?php

namespace App\Exceptions\Facebook;

use Phalcon\Http\Response;

class FbCallbackException extends \Exception
{
    public function __construct($message = 'Error during FB callback', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
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
        $response->setStatusCode(409, 'Error during FB callback');
        $response->setJsonContent(
            [
                'status' => 'ERROR',
                'message' => $this->message
            ]
        );

        return $response;
    }
}
