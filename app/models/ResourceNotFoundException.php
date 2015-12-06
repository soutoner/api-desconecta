<?php


class ResourceNotFoundException extends Exception
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
     * @return \Phalcon\Http\Response
     */
    public function return_response(){
        $response = new Phalcon\Http\Response();
        $response->setStatusCode(404, 'Resource Not Found');
        $response->setJsonContent([
            'status' => 'ERROR',
            'data'   => 'Resource Not Found'
        ]);

        return $response;
    }
}