<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class ControllerBase extends Controller
{
    /**
     * Check if the resource is saved or not and returns a response depending on this.
     * @param $request
     * @param $status (Whether the resource pass validations or not)
     * @return Phalcon\Http\Response
     */
    protected function response($request, $status)
    {
        // Create a response
        $response = new Response();

        // Request method
        $method = $request->getMethod();

        // Check if the insertion was successful
        if ($status->success() == true) {
            if ($method === "POST"){
                // Change the HTTP status
                $response->setStatusCode(201, "Created");

                $request->id = $status->getModel()->id;

                $response->setJsonContent(
                    array(
                        'status' => 'OK',
                        'data'   => $request
                    )
                );
            } else {
                $response->setStatusCode(200, "Ok");

                $response->setJsonContent(
                    array(
                        'status' => 'OK'
                    )
                );
            }
        } else {
            // Change the HTTP status
            $response->setStatusCode(409, "Conflict");

            // Send errors to the client
            $errors = array();
            foreach ($status->getMessages() as $message) {
                $errors[] = $message->getMessage();
            }

            $response->setJsonContent(
                array(
                    'status'   => 'ERROR',
                    'messages' => $errors
                )
            );
        }

        return $response;
    }
}
