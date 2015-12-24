<?php

namespace controllers\v1\register;

use App\Models\Profile;
use App\Models\User;
use \EndpointTest;
use \FunctionalTester;

class CallbackCest extends EndpointTest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function __construct()
    {
        parent::__construct(__DIR__, __FILE__);
    }

    public function callbackSomeError(FunctionalTester $I)
    {
        $count = User::count() + Profile::count();
        $I->sendGET($this->endpoint.'/facebook/callback', ['error' => 'hola']);
        $I->seeResponseCodeIs(409);
        $I->seeResponseContainsJson(
            [
                'status'    => 'ERROR',
                'message'   => 'FB authorization error: hola',
            ]
        );
        $I->assertEquals($count, User::count() + Profile::count());
    }

    public function callbackCanceledAuth(FunctionalTester $I)
    {
        $count = User::count() + Profile::count();
        $I->sendGET($this->endpoint.'/facebook/callback', ['error' => 'access_denied']);
        $I->seeResponseCodeIs(409);
        $I->seeResponseContainsJson(
            [
                'status'    => 'ERROR',
                'message'   => 'FB authorization error: access_denied',
            ]
        );
        $I->assertEquals($count, User::count() + Profile::count());
    }

    public function callbackHasNoCode(FunctionalTester $I)
    {
        $count = User::count() + Profile::count();
        $I->sendGET($this->endpoint.'/facebook/callback');
        $I->seeResponseCodeIs(409);
        $I->seeResponseContainsJson(
            [
                'status'    => 'ERROR',
                'message'   => 'Ups, something went wrong during authorization',
            ]
        );
        $I->assertEquals($count, User::count() + Profile::count());
    }
}
