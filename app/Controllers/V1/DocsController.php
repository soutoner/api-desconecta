<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;

class DocsController extends BaseController
{
    /**
     * Serves the documentation for the Swagger UI client.
     *
     * Documentation must be located at `docs/api-doc.json`.
     *
     * @return \Phalcon\HTTP\Response
     */
    public function index()
    {
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Headers', 'X-Requested-With');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Authorization');
        $this->response->sendHeaders();
        $this->response->setFileToSend('docs/api-doc.json');

        return $this->response;
    }
}
