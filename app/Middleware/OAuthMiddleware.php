<?php


namespace App\Middleware;

use App\Exceptions\OAuth\UnauthorizedRequest;
use OAuth2\Request;
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class OAuthMiddleware implements MiddlewareInterface
{
    // TODO: Remove docs from here
    protected $excepted_routes = ['/api/v1/oauth/token', '/api/v1/register/facebook', '/api/v1/docs'];

    public function call(Micro $application)
    {
        $oauth  = $application['oauth'];

        $url  = strtok($_SERVER["REQUEST_URI"], '?');

        if (!in_array($url, $this->excepted_routes)) {
            // Handle a request to a resource and authenticate the access token
            if (!$oauth->verifyResourceRequest(Request::createFromGlobals())) {
                $oauth->getResponse()->send();

                throw new UnauthorizedRequest();
            }
        }

        return true;
    }
}
