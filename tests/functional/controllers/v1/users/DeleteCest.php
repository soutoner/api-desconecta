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
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->dontSeeRecord('App\Models\User', $user);
    }

    public function deleteOnNonExistentRecordReturns404(FunctionalTester $I)
    {
        $userId = 0;
        $I->sendDELETE($this->endpoint.'/'. $userId);
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => 'User Not Found']);
    }
}
