<?php

namespace models;

use \FunctionalTester;
use App\Models\Profile;
use App\Db\Seeds\Models\RRPPSeeder;
use App\Models\RRPP;

class RRPPCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new RRPP();
        $this->model->assign(
            RRPPSeeder::ExtraSeeds()[0]
        );
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenModelisValid(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save());
    }

    /**
     * VERIFIED
     */

    public function verifiedIsDefaultFalse(FunctionalTester $I)
    {
        $this->model->verified = '';
        $I->assertTrue($this->model->save());
        $I->assertFalse($this->model->verified);
    }
}
