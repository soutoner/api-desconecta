<?php

namespace App\Lib\Facebook;

use GuzzleHttp\Client;

class Facebook
{
    // TODO: check state is not modified
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
     * Custom callback_uri for Facebook OAuth 2 flow.
     *
     * @var string
     */
    private $callback_uri;

    /**
     * Default scopes.
     *
     * @var array
     */
    public $default_permissions = ['public_profile', 'user_birthday', 'email', 'user_location'];

    public $test_user_access_token = "CAAX4kC9D4eIBAM8Q3DnlPdgLuuLElJspCOyZC16O3hoZAVFIKGJDMZC5i7SPZCxSzDFL3KOg2AVLWk667Ltp5TUEqAZATnwAInB9uuAECbUFZCJL1sf1mQky4MA27gpBPWZAYxbcP0nvJtkZAwlB2oRNtySIXZCX6xT4OD15OxU5x3vjxWCaeE5plElMAcHIhTKoujvTTA038BAZDZD";

    public function __construct($params)
    {
        $this->client_id = urlencode($params['app_id']);
        $this->client_secret = urlencode($params['app_secret']);
        $this->callback_uri = urlencode('http://'.$params['callback_uri']);
    }

    /**
     * Returns the login uri for the user in order to authorize the app.
     *
     * @param  null $state : CSRF token
     * @param  array|null $permissions : List of scopes to be granted by faceook.
     * @param null $callback
     * @return string
     */
    public function getAuthUrl($state = null, $permissions = [], $callback = null)
    {
        $state = (empty($state)) ? '' : '&state='.$state;
        $permissions = array_merge($this->default_permissions, $permissions);
        $scope = '&scope='.implode(',', $permissions);
        $callback = (empty($callback)) ? $this->callback_uri : $callback;

        return 'https://www.facebook.com/'.$this->API_version.'/dialog/oauth?client_id='.$this->client_id.
            '&redirect_uri='.$callback.'&response_type=code'.$scope.$state;
    }

    /**
     * Returns the response of the OAuth2.
     *
     * @param  $code
     * @param  null $state : CSRF token
     * @param null $callback
     * @return \Psr\Http\Message\StreamInterface : {“access_token”: <access-token>, “token_type”:<type>, “expires_in”:<seconds-til-expiration>}
     */
    public function getAccessToken($code, $state = null, $callback = null)
    {
        $state = (empty($state)) ? : '&state='.$state;
        $callback = (empty($callback)) ? $this->callback_uri : $callback;

        $client = new Client();
        $response = $client->request(
            'GET',
            'https://graph.facebook.com/'.$this->API_version.
            '/oauth/access_token?client_id='.$this->client_id.'&redirect_uri='.$callback.
            '&client_secret='.$this->client_secret.'&code='.$code.$state
        );

        return json_decode($response->getBody());
    }

    /**
     * Returns the uid of the given access_token.
     *
     * @param  $access_token
     * @return \Psr\Http\Message\StreamInterface : {“access_token”: <access-token>, “token_type”:<type>, “expires_in”:<seconds-til-expiration>}
     */
    public function getUid($access_token)
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            'https://graph.facebook.com/'.$this->API_version.
            '/me?fields=id&access_token='.$access_token
        );

        return json_decode($response->getBody())->id;
    }

    /**
     * Returns /me endpoint of Facebook.
     *
     * @param  $access_token
     * @return mixed
     */
    public function me($access_token)
    {
        $fields = ['id', 'birthday', 'email', 'name', 'first_name', 'middle_name', 'last_name',
            'gender', 'location', 'picture'];

        $client = new Client();
        $response = $client->request(
            'GET',
            'https://graph.facebook.com/'.$this->API_version.
            '/me?fields='.implode(',', $fields).'&access_token='.$access_token
        );

        return json_decode($response->getBody());
    }

    /**
     * TESTING
     */

    /**
     * Returns test-users entries.
     *
     * @return mixed
     */
    public function getTestUsers()
    {

        $client = new Client();
        // Get app access token
        $response = $client->request(
            'GET',
            'https://graph.facebook.com/'.$this->API_version.
            '/oauth/access_token?client_id='.$this->client_id.'&client_secret='.$this->client_secret.
            '&grant_type=client_credentials'
        );
        $app_access_token = json_decode($response->getBody())->access_token;
        $response = $client->request(
            'GET',
            'https://graph.facebook.com/'.$this->API_version.
            '/'.$this->client_id.'/accounts/test-users?access_token='.$app_access_token
        );

        return json_decode($response->getBody());
    }
}
