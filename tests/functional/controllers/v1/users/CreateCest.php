<?php

namespace controllers\v1\users;

use \EndpointTest;
use \FunctionalTester;
use App\Models\User;
use App\Db\Seeds\Models\UserSeeder;

class CreateCest extends EndpointTest
{
    public function __construct()
    {
        parent::__construct(__DIR__, __FILE__);
    }

    public function createSuccessfulReturnUser(FunctionalTester $I)
    {
        $new_user = UserSeeder::ExtraSeeds()[0];

        $I->dontSeeRecord('App\Models\User', $new_user);
        $I->sendPOST($this->endpoint, $new_user);
        $I->seeResponseCodeIs(201);
        $I->seeRecord('App\Models\User', $new_user);
    }

    public function createUnsuccessfulReturnErrors(FunctionalTester $I)
    {
        $new_user = UserSeeder::ExtraSeeds()[0];
        $new_user['name'] = '';

        $I->dontSeeRecord('App\Models\User', $new_user);
        $I->sendPOST($this->endpoint, $new_user);
        $I->seeResponseCodeIs(409);
        $I->seeResponseContains('messages');
        $I->seeResponseContains('name');
        $I->assertGreaterThan(0, count(json_decode($I->grabResponse())->messages));
        $I->dontSeeRecord('App\Models\User', $new_user);
    }
}
