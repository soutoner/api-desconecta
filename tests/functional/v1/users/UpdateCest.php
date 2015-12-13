<?php

namespace v1\users;

use \EndpointTest;
use \FunctionalTester;
use App\Models\User;

class UpdateCest extends EndpointTest
{
    public function __construct(){
        parent::__construct(__DIR__, __FILE__);
    }

    public function updateSuccessful(FunctionalTester $I)
    {
        $updated_param = [
            'name' => 'Romeito'
        ];

        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        // We send get
        $I->sendPUT($this->endpoint.'/'.User::findFirst()->id, 'name='.$updated_param['name']);
        // We see the response is OK and JSON
        $I->seeResponseCodeIs(200); $I->seeResponseIsJson();
        // We check that the resource is updated
        $I->assertEquals($updated_param['name'], User::findFirst()->name);
    }

    public function updateUnsuccessfulReturnErrors(FunctionalTester $I)
    {
        $original_name = User::findFirst()->name;
        $updated_param = [
            'name' => ''
        ];

        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        // We send get
        $I->sendPUT($this->endpoint.'/'.User::findFirst()->id, 'name='.$updated_param['name']);
        // We see the response is OK and JSON
        $I->seeResponseCodeIs(409); $I->seeResponseIsJson();
        // We see the response contains error messages
        $json_response = json_decode($I->grabResponse());
        $I->assertGreaterThan(0, $json_response->messages);
        // We check that the resource is not updated
        $I->assertEquals($original_name, User::findFirst()->name);
    }

    public function updateOnNonExistentRecordReturns404(FunctionalTester $I)
    {
        $userId = 0;
        // We send get
        $I->sendPUT($this->endpoint.'/'. $userId);
        // We see the response is OK and JSON
        $I->seeResponseCodeIs(404); $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'message' => 'User Not Found',
        ]);
    }
}