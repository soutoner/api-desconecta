<?php

namespace middleware;

use App\Db\Seeds\OAuth\TestClientSeeder;
use \FunctionalTester;
use support\UseMiddleware;

class OAuthMiddlewareCest
{
    use UseMiddleware;

    public function unauthorizedReqWithoutAccessToken(FunctionalTester $I)
    {
        $I->seeExceptionThrown('App\Exceptions\OAuth\UnauthorizedRequest', function () use ($I) {
            $I->sendGET('/api/v1/users');
        });
    }

    public function authorizedReqExceptedEndpoint(FunctionalTester $I)
    {
        $I->dontSeeExceptionThrown('App\Exceptions\OAuth\UnauthorizedRequest', function () use ($I) {
            $I->sendPOST(\App\Middleware\OAuthMiddleware::$excepted_routes[1]);
        });
    }

    public function authorizedReqWithValidAccessToken(FunctionalTester $I)
    {
//        $I->sendPOST('/api/v1/oauth/token', [
//            'grant_type' => 'client_credentials',
//            'client_id' =>  'testclient',
//            'client_secret' => 'testsecret',
//        ]);
//        $I->assertEquals('',$I->grabResponse());
//        $access_token = json_decode($I->grabResponse())->access_token;
//        $I->dontSeeExceptionThrown('App\Exceptions\OAuth\UnauthorizedRequest', function () use ($I, $access_token) {
//            $I->sendGET('/api/v1/users', ['access_token' => $access_token]);
//        });
    }

    public function unauthorizedReqWithInValidAccessToken(FunctionalTester $I)
    {
        $access_token = 'testo';
        $I->seeExceptionThrown('App\Exceptions\OAuth\UnauthorizedRequest', function () use ($I, $access_token) {
            $I->sendGET('/api/v1/users', ['access_token' => $access_token]);
        });
    }
}
