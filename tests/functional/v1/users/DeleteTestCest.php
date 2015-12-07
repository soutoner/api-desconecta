<?php

namespace v1\users;

use \FunctionalTester;

class DeleteTestCest
{
    /**
     * API version.
     *
     * @var string
     */
    protected $version;

    /**
     * API endpoint.
     *
     * @var string
     */
    protected $endpoint;

    /**
     * IndexTest constructor.
     */
    public function __construct(){
        $this->version = basename(dirname(__DIR__));
        $this->endpoint = '/api/'.$this->version.'/'.basename(dirname(__FILE__));
    }

    public function deleteSuccessful(FunctionalTester $I)
    {
        $user = \User::findFirst();
        // We send get
        $I->sendDELETE($this->endpoint.'/'. $user->id);
        // We see the response is OK and JSON
        $I->seeResponseCodeIs(200); $I->seeResponseIsJson();
        // We check that the user is deleted from database
        $I->dontSeeRecord('User', $user);
    }

    public function deleteOnNonExistentRecordReturns404(FunctionalTester $I)
    {
        $userId = 0;
        // We send get
        $I->sendDELETE($this->endpoint.'/'. $userId);
        // We see the response is OK and JSON
        $I->seeResponseCodeIs(404); $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'message' => 'Resource Not Found',
        ]);
    }
}