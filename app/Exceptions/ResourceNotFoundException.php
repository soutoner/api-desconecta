<?php

namespace App\Exceptions;

use Phalcon\Http\Response;

class ResourceNotFoundException extends \Exception
{
    public function __construct($message = 'Resource Not Found', $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    /**
     * Returns HTTP response explaining the error that caused the exception.
     *
     * @return Response
     */
    public function return_response(){
        $response = new Response();
        $response->setStatusCode(404, 'Resource Not Found');
        $response->setJsonContent([
            'status' => 'ERROR',
            'message'   => 'Resource Not Found'
        ]);

        return $response;
    }
}