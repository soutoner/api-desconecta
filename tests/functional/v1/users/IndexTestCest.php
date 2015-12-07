<?php

namespace v1\users;

use \FunctionalTester;

class IndexTests
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

    public function indexReturnsAllUsers(FunctionalTester $I)
    {
        // We send get
        $I->sendGet($this->endpoint);
        // We see the response is OK and JSON
        $I->seeResponseCodeIs(200); $I->seeResponseIsJson();
        // We check that are all the users inside
        $I->assertEquals(count(\User::find()), count(json_decode($I->grabResponse())));
        // We see te fields that at least it contains an user value.
        $I->seeResponseContainsJson(\User::findFirst()->toArray());
    }
}