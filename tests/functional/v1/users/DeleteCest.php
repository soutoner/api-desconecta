<?php

namespace v1\users;

use \EndpointTest;
use \FunctionalTester;
use App\Models\User;

class DeleteCest extends EndpointTest
{
    public function __construct()
    {
        parent::__construct(__DIR__, __FILE__);
    }

    public function deleteSuccessful(FunctionalTester $I)
    {
        $user = User::findFirst();
        // We send get
        $I->sendDELETE($this->endpoint.'/'. $user->id);
        // We see the response is OK and JSON
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        // We check that the user is deleted from database
        $I->dontSeeRecord('App\Models\User', $user);
    }

    public function deleteOnNonExistentRecordReturns404(FunctionalTester $I)
    {
        $userId = 0;
        // We send get
        $I->sendDELETE($this->endpoint.'/'. $userId);
        // We see the response is OK and JSON
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
            'message' => 'User Not Found',
            ]
        );
    }
}
