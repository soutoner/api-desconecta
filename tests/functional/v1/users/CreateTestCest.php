<?php

namespace v1\users;

use \EndpointTest;
use \FunctionalTester;
use App\Models\User;

class CreateTestCest extends EndpointTest
{
    public function __construct(){
        parent::__construct(__DIR__, __FILE__);
    }

    public function createSuccessfulReturnUser(FunctionalTester $I)
    {
        $new_user = [
            'name'              => 'Nicky',
            'surname'           => 'Jam',
            'email'             => 'elperdon@enrique.com',
            'profile_picture'   => 'http://foo.jpg',
            'date_birth'        => '1981-11-11',
            'gender'            => 'H',
            'location'          => 'Boston',
        ];

        $I->dontSeeRecord('App\Models\User', $new_user);
        $I->sendPOST($this->endpoint, $new_user);
        $I->seeResponseCodeIs(201); $I->seeResponseIsJson();
        // We see the response contains the created user
        $I->seeResponseContainsJson($new_user);
        // We check that the database contains
        $I->seeRecord('App\Models\User', $new_user);
    }

    public function createUnsuccessfulReturnErrors(FunctionalTester $I)
    {
        $new_user = [
            'name'              => 'Nicky',
            'surname'           => 'Jam',
            'email'             => User::findFirst()->email,
            'profile_picture'   => 'http://foo.jpg',
            'date_birth'        => '1981-11-11',
            'gender'            => 'H',
            'location'          => 'Boston',
        ];

        $I->dontSeeRecord('App\Models\User', $new_user);
        $I->sendPOST($this->endpoint, $new_user);
        // We see the response is OK and JSON
        $I->seeResponseCodeIs(409); $I->seeResponseIsJson();
        // We see the response contains error messages
        $json_response = json_decode($I->grabResponse());
        $I->assertGreaterThan(0, $json_response->messages);
        // We check that the user us not saved to the database
        $I->dontSeeRecord('App\Models\User', $new_user);
    }
}