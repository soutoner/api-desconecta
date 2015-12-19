<?php

namespace App\Lib\Facebook;

use GuzzleHttp\Client;

class Facebook
{
    // TODO: set code for securing Cross-site scripting
    /**
     * Client Facebook API key.
     *
     * @var string
     */
    private $client_id;

    /**
     * Client Facebook API secret.
     *
     * @var string
     */
    private $client_secret;

    /**
     * Facebook API version.
     *
     * @var string
     */
    private $API_version = 'v2.5';

    /**
     * Custom callback_uri for Faceboo OAuth 2 flow.
     *
     * @var string
     */
    private $callback_uri;

    public function __construct($params)
    {
        $this->client_id = urlencode($params['app_id']);
        $this->client_secret = urlencode($params['app_secret']);
        $this->callback_uri = urlencode('http://'.$params['callback_uri']);
    }

    /**
     * Returns the login uri for the user in order to authorize the app.
     *
     * @return string
     */
    public function getAuthUrl()
    {
        return 'https://www.facebook.com/'.$this->API_version.'/dialog/oauth?client_id='.$this->client_id.
            '&redirect_uri='.$this->callback_uri.'&response_type=code';
    }

    /**
     * Returns the response of the OAuth 2 r
     *
     * @param  $code
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getAccessToken($code)
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            'https://graph.facebook.com/'.$this->API_version.
            '/oauth/access_token?client_id='.$this->client_id.'&redirect_uri='.$this->callback_uri.
            '&client_secret='.$this->client_secret.'&code='.$code
        );

        return $response->getBody();
    }
}
