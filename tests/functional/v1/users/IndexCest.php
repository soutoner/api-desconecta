<?php

namespace v1\users;

use \EndpointTest;
use \FunctionalTester;
use App\Models\User;

class IndexCest extends EndpointTest
{
    public function __construct()
    {
        parent::__construct(__DIR__, __FILE__);
    }

    public function indexWithoutParamReturnsFirstNUsersPaginated(FunctionalTester $I)
    {
        \App\Db\Seeds\Models\UserSeeder::Seed(true);
        // We send get
        $I->sendGet($this->endpoint);
        // We see the response is OK and JSON
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        // We check that are all the users inside
        $I->assertLessThanOrEqual($this->items_per_page, json_decode($I->grabResponse())->limit);
        // We see te fields that at least it contains an user value.
        $I->seeResponseContainsJson(User::findFirst()->toArray());
    }

    public function indexWithParamReturnsUsersPaginated(FunctionalTester $I)
    {
        \App\Db\Seeds\Models\UserSeeder::Seed(true);
        // We send get
        $I->sendGet($this->endpoint.'?page=5');
        // We see the response is OK and JSON
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        // We check that are all the users inside
        $I->assertLessThanOrEqual($this->items_per_page, json_decode($I->grabResponse())->limit);
        // We see te fields that at least it contains an user value.
        $I->seeResponseContainsJson(User::findFirst()->toArray());
    }
}
