<?php

namespace v1\followers;

use \EndpointTest;
use \FunctionalTester;
use App\Models\User;

class IndexCest extends EndpointTest
{
    public function __construct()
    {
        parent::__construct(__DIR__, __FILE__);
    }

    public function indexReturnsAllFollowers(FunctionalTester $I)
    {
        $user = User::findFirst();
        $I->sendGet($this->endpoint . '/' . $user->id);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->assertEquals(count($user->getFollowers()), count(json_decode($I->grabResponse())));
        $I->seeResponseContainsJson($user->getFollowers()->toArray());
    }
}
