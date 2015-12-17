<?php

namespace models;

use \FunctionalTester;
use App\Models\Local;
use App\Db\Seeds\Models\LocalSeeder;

class LocalCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Local();
        $this->model->assign(
            LocalSeeder::ExtraSeeds()[0]
        );
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenModelIsValid(FunctionalTester $I){
        $I->assertTrue($this->model->save(), implode("|", $this->model->getMessages()));
    }

    /**
     * NAME
     */

    public function nameMustBeNotNull(FunctionalTester $I){
        $this->model->name = '';
        $I->assertFalse($this->model->save());
    }

    public function nameMustBeUnique(FunctionalTester $I){
        $this->model->name = Local::findFirst()->name;
        $I->assertFalse($this->model->save());
    }

    /**
     * DESC
     */

    public function descMustBeNotNull(FunctionalTester $I){
        $this->model->desc = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * PHOTO_COVER
     */

    public function photoCoverMustBeNotNull(FunctionalTester $I){
        $this->model->photo_cover = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * GEO
     */

    public function geoMustBeNotNull(FunctionalTester $I){
        $this->model->geo = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * ADDRESS
     */

    public function addressMustBeNotNull(FunctionalTester $I){
        $this->model->address = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * OWNER_ID
     */

    public function ownerIdMustBeNotNull(FunctionalTester $I){
        $this->model->owner_id = '';
        $I->assertFalse($this->model->save());
    }

    public function ownerIdMustBeValidRRPP(FunctionalTester $I){
        $this->model->owner_id = 0;
        $I->assertFalse($this->model->save());
    }
}
