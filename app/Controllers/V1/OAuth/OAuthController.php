<?php


namespace App\Controllers\V1\OAuth;

use App\Controllers\BaseController;
use OAuth2\Request;

class OAuthController extends BaseController
{
    public function getToken()
    {
        // Handle a request for an OAuth2.0 Access Token and send the response to the client
        $this->oauth->handleTokenRequest(Request::createFromGlobals())->send();
    }
}
