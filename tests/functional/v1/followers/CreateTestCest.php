<?php

namespace v1\followers;

use \EndpointTest;
use \FunctionalTester;
use App\Models\User;
use App\Db\Seeds\Models\UserSeeder;

class CreateTestCest extends EndpointTest
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
                "email = '" . UserSeeder::DbSeeds()[1]['email'] . "'",
            ])->id,
        ];
    }

    public function createRelationshipSuccessful(FunctionalTester $I)
    {

        $I->dontSeeRecord('App\Models\Relationships\Follower', $this->relationship);
        $I->sendPOST($this->endpoint . '/' . $this->relationship['user_id'], [
            'follower_id'   => $this->relationship['follower_id']
        ]);
        $I->seeResponseCodeIs(201); $I->seeResponseIsJson();
        $I->seeResponseContainsJson($this->relationship);
        $I->seeRecord('App\Models\Relationships\Follower', $this->relationship);
    }

    public function createRelationshipUnsuccessful(FunctionalTester $I)
    {
        $this->relationship['follower_id'] = User::findFirst()->id;

        $I->dontSeeRecord('App\Models\Relationships\Follower', $this->relationship);
        $I->sendPOST($this->endpoint . '/' . $this->relationship['user_id'], [
            'follower_id'   => $this->relationship['follower_id']
        ]);
        $I->seeResponseCodeIs(409); $I->seeResponseIsJson();
        $json_response = json_decode($I->grabResponse());
        $I->assertGreaterThan(0, $json_response->messages);
        $I->dontSeeRecord('App\Models\Relationships\Follower', $this->relationship);
    }

    public function createOnNonExistentUserReturns404(FunctionalTester $I)
    {
        $this->relationship['user_id'] = 0;
        $I->sendPOST($this->endpoint . '/' . $this->relationship['user_id'], [
            'follower_id'   => $this->relationship['follower_id']
        ]);
        $I->seeResponseCodeIs(404); $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'message' => 'User Not Found',
        ]);
    }

    public function createWithNonExistentUserReturns404(FunctionalTester $I)
    {
        $this->relationship['follower_id'] = 0;
        $I->sendPOST($this->endpoint . '/' . $this->relationship['user_id'], [
            'follower_id'   => $this->relationship['follower_id']
        ]);
        $I->seeResponseCodeIs(404); $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'message' => 'Follower User Not Found',
        ]);
    }
}
