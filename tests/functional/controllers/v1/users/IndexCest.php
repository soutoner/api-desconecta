<?php

namespace controllers\v1\users;

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
        $I->sendGet($this->endpoint);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['current' => '1']);
        $I->seeResponseContains('items');
        $items = count(json_decode($I->grabResponse())->items);
        $I->assertGreaterThan(0, $items);
        $I->assertLessThanOrEqual(10, $items);
    }

    public function indexWithParamReturnsUsersPaginated(FunctionalTester $I)
    {
        \App\Db\Seeds\Models\UserSeeder::Seed(true);
        // We send get
        $I->sendGet($this->endpoint, ['page' => '2']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['current' => '2']);
        $I->seeResponseContains('items');
        $items = count(json_decode($I->grabResponse())->items);
        $I->assertGreaterThan(0, $items);
        $I->assertLessThanOrEqual(10, $items);
    }
}
