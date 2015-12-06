<?php

namespace v1;

use \FunctionalTester;

class UserTestCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function indexWorks(FunctionalTester $I)
    {
        $I->sendGet('/api/v1/users'); // GET
        $I->seeResponseContains('pepito');
    }
}
