<?php

namespace models;

use \FunctionalTester;
use App\Models\Profile;
use App\Db\Seeds\Models\RRPPSeeder;
use App\Models\RRPP;

class RRPPValidationsCest
{
    protected $rrpp;

    public function _before(FunctionalTester $I)
    {
        $this->rrpp = new RRPP();
        $this->rrpp->assign(
            RRPPSeeder::ExtraSeeds()[0]
        );
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->rrpp);
    }

    public function givenRRPPisValid(FunctionalTester $I)
    {
        $I->assertTrue($this->rrpp->save());
    }

    /**
     * VERIFIED
     */

    public function verifiedIsDefaultFalse(FunctionalTester $I)
    {
        $this->rrpp->verified = '';
        $I->assertTrue($this->rrpp->save());
        $I->assertFalse($this->rrpp->verified);
    }
}
