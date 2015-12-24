<?php

namespace controllers\v1\users;

use \EndpointTest;
use \FunctionalTester;
use App\Models\User;

class UpdateCest extends EndpointTest
{
    public function __construct()
    {
        parent::__construct(__DIR__, __FILE__);
    }

    public function updateSuccessful(FunctionalTester $I)
    {
        $id = 1;
        $updated_param = ['name' => 'Romeito'];
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPUT($this->endpoint.'/'.$id, 'name='.$updated_param['name']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->assertEquals($updated_param['name'], User::findFirst($id)->name);
    }

    public function updateUnsuccessfulReturnErrors(FunctionalTester $I)
    {
        $id = 1;
        $original_name = User::findFirst($id)->name;
        $updated_param = ['name' => ''];
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPUT($this->endpoint.'/'.$id, 'name='.$updated_param['name']);
        $I->seeResponseCodeIs(409);
        $I->seeResponseIsJson();
        $json_response = json_decode($I->grabResponse());
        $I->assertGreaterThan(0, count($json_response->messages));
        $I->assertEquals($original_name, User::findFirst($id)->name);
    }

    public function updateOnNonExistentRecordReturns404(FunctionalTester $I)
    {
        $userId = 0;
        $I->sendPUT($this->endpoint.'/'. $userId);
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => 'User Not Found']);
    }
}
