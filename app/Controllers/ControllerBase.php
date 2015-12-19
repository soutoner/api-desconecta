<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

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

        if ($method === "POST" || $method === "PUT") {
            if ($resource->save() == true) {
                // Change the HTTP status
                if ($method === "POST") {
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
            if ($resource->delete() == true) {
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

    /**
     * Paginates given Resource. By default paginates ::find of caller Model.
     *
     * @param null $resource : Resource to be paginated
     * @return Response
     */
    public function paginate($resource = null)
    {
        if (empty($resource)) {
            $className = 'App\Models\\'.str_replace('sController', '', end(explode('\\', get_called_class())));
            $resource = $className::find();
        }

        $paginator = new PaginatorModel(
            array(
                'data'  => $resource,
                'limit' => 10,
                'page'  => (int) $this->request->getQuery('page', 'int', '1')
            )
        );

        return new Response(json_encode($paginator->getPaginate()));
    }
}
