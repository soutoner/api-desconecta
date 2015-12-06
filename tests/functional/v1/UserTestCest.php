<?php

namespace v1;

use \FunctionalTester;

class UserTestCest
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
     * UserTestCest constructor.
     */
    public function __construct(){
        $this->version = basename(dirname(__FILE__));
        $this->endpoint = '/api/'.$this->version.'/users/';
    }

    /**
     * Executed before each test.
     *
     * @param FunctionalTester $I
     */
    public function _before(FunctionalTester $I)
    {
    }

    /**
     * Executed after each test.
     *
     * @param FunctionalTester $I
     */
    public function _after(FunctionalTester $I)
    {
    }


    public function indexReturnsAllUsers(FunctionalTester $I)
    {
        $I->sendGet($this->endpoint); // GET
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->assertEquals(count(\User::find()), count($I->grabResponse()[1]));
        $I->seeResponseContains('Romeo');
    }
}
