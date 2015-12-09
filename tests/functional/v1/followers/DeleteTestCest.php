<?php

namespace v1\followers;

use \EndpointTest;
use \FunctionalTester;
use App\Models\User;
use App\Db\Seeds\Models\UserSeeder;

class DeleteTestCest extends EndpointTest
{
    protected $relationship;

    public function __construct(){
        parent::__construct(__DIR__, __FILE__);
    }

    public function _before(FunctionalTester $I)
    {
        $this->relationship = [
            'user_id'       => User::findFirst()->id,
            'follower_id'   => User::findFirst([
                "email = '" . UserSeeder::DbUserSeeds()[1]['email'] . "'",
            ])->id,
        ];
        $I->haveRecord('App\Models\Relationships\Follower', $this->relationship);
    }

    public function deleteSuccessful(FunctionalTester $I)
    {
        $I->seeRecord('App\Models\Relationships\Follower', $this->relationship);
        $I->sendDELETE($this->endpoint.'/'. $this->relationship['user_id'], [
            'follower_id'   => $this->relationship['follower_id']
        ]);
        // We see the response is OK and JSON
        $I->seeResponseCodeIs(200); $I->seeResponseIsJson();
        // We check that the user is deleted from database
        $I->dontSeeRecord('App\Models\Relationships\Follower', $this->relationship);
    }

    public function deleteOnNonExistentRecordReturns404(FunctionalTester $I)
    {
        $this->relationship['user_id'] = 0;
        // We send get
        $I->sendDELETE($this->endpoint.'/'. $this->relationship['user_id'], [
            'follower_id'   => $this->relationship['follower_id']
        ]);
        $I->seeResponseCodeIs(404); $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'message' => 'User Not Found',
        ]);
    }

    public function deleteWithNonExistentUserReturns404(FunctionalTester $I)
    {
        $this->relationship['follower_id'] = 0;
        $I->sendDELETE($this->endpoint . '/' . $this->relationship['user_id'], [
            'follower_id'   => $this->relationship['follower_id']
        ]);
        $I->seeResponseCodeIs(404); $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'message' => 'Follower User Not Found',
        ]);
    }
}
