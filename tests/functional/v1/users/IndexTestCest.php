<?php

namespace v1\users;

use \EndpointTest;
use \FunctionalTester;
use App\Models\User;

class IndexTests extends EndpointTest
{
    public function __construct(){
        parent::__construct(__DIR__, __FILE__);
    }

    public function indexReturnsAllUsers(FunctionalTester $I)
    {
        // We send get
        $I->sendGet($this->endpoint);
        // We see the response is OK and JSON
        $I->seeResponseCodeIs(200); $I->seeResponseIsJson();
        // We check that are all the users inside
        $I->assertEquals(count(User::find()), count(json_decode($I->grabResponse())));
        // We see te fields that at least it contains an user value.
        $I->seeResponseContainsJson(User::findFirst()->toArray());
    }
}