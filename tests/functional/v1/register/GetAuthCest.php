<?php

namespace v1\register;

use App\Models\Profile;
use App\Models\User;
use \EndpointTest;
use \FunctionalTester;

class GetAuthCest extends EndpointTest
{
    protected $facebook;

    public function _before(FunctionalTester $I)
    {
        $this->facebook = $I->grabServiceFromDi('facebook');
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->facebook);
    }

    public function __construct()
    {
        parent::__construct(__DIR__, __FILE__);
    }

    public function getSuccessfulURI(FunctionalTester $I)
    {
        $I->sendGET($this->endpoint.'/facebook');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContains($this->facebook->getAuthUrl());
    }
}
