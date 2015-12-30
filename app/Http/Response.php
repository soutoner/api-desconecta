<?php

namespace App\Http;

// TODO: finish responseFromOAuth
class Response extends \Phalcon\Http\Response
{
    /**
     * Creates Phalcon response from OAuth2 Response.
     *
     * @param $oauth_response
     * @return Response
     */
    public static function responseFromOAuth($oauth_response)
    {
        $response = new Response();
        $response->setStatusCode($oauth_response->getStatusCode());
        foreach ($oauth_response->getHttpHeaders() as $header) {
            $response->setRawHeader($header);
        }
        $response->setContent($oauth_response->getResponseBody());

        return $response;
    }
}
