<?php


namespace App\Middleware;

use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class OAuthMiddleware implements MiddlewareInterface
{
    protected $excepted_routes = ['/api/v1/oauth/token', '/api/v1/register/facebook'];

    public function call(Micro $application)
    {
        $oauth  = $application['oauth'];

        $url  = strtok($_SERVER["REQUEST_URI"], '?');

        if (!in_array($url, $this->excepted_routes)) {
            // Handle a request to a resource and authenticate the access token
            if (!$oauth->verifyResourceRequest(\OAuth2\Request::createFromGlobals())) {
                $oauth->getResponse()->send();

                // TODO: evict die
                die;
            }
        }

        return true;
    }
}
