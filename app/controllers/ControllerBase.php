<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class ControllerBase extends Controller
{
    /**
     * Check if the resource is saved or not and returns a response depending on this.
     * @param $request
     * @param $resource
     * @return Phalcon\Http\Response
     */
    protected function response($request, $resource)
    {
        // Create a response
        $response = new Response();

        // Request method
        $method = $request->getMethod();

        if ($method === "POST" || $method === "PUT"){
            if ($resource->save() == true) {
                // Change the HTTP status
                if($method === "POST") {
                    $response->setStatusCode(201, "Created");
                } else {
                    $response->setStatusCode(200, "Updated");
                }

                $response->setJsonContent(
                    array(
                        'status' => 'OK',
                        'data'   => $resource
                    )
                );
            } else {
                // Change the HTTP status
                $response->setStatusCode(409, "Conflict");

                // Send errors to the client
                $errors = array();
                foreach ($resource->getMessages() as $message) {
                    $errors[] = $message->getMessage();
                }

                $response->setJsonContent(
                    array(
                        'status'   => 'ERROR',
                        'messages' => $errors
                    )
                );
            }
        } else {
            if($resource->delete() == true){
                $response->setStatusCode(200, "Deleted");

                $response->setJsonContent(
                    array(
                        'status' => 'OK'
                    )
                );
            } else {
                // Change the HTTP status
                $response->setStatusCode(409, "Conflict");

                $response->setJsonContent(
                    array(
                        'status'   => 'ERROR',
                        'messages' => 'Internal error while deleting'
                    )
                );
            }
        }

        return $response;
    }
}
