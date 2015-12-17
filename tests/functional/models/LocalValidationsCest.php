<?php

namespace models;

use \FunctionalTester;
use App\Models\Local;
use App\Db\Seeds\Models\LocalSeeder;

class LocalValidationsCest
{
    protected $local;

    public function _before(FunctionalTester $I)
    {
        $this->local = new Local();
        $this->local->assign(
            LocalSeeder::ExtraSeeds()[0]
        );
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->local);
    }

    public function givenLocalIsValid(FunctionalTester $I){
        $I->assertTrue($this->local->save(), implode("|", $this->local->getMessages()));
    }

    /**
     * NAME
     */

    public function nameMustBeNotNull(FunctionalTester $I){
        $this->local->name = '';
        $I->assertFalse($this->local->save());
    }

    public function nameMustBeUnique(FunctionalTester $I){
        $this->local->name = Local::findFirst()->name;
        $I->assertFalse($this->local->save());
    }

    /**
     * DESC
     */

    public function descMustBeNotNull(FunctionalTester $I){
        $this->local->desc = '';
        $I->assertFalse($this->local->save());
    }

    /**
     * PHOTO_COVER
     */

    public function photoCoverMustBeNotNull(FunctionalTester $I){
        $this->local->photo_cover = '';
        $I->assertFalse($this->local->save());
    }

    /**
     * GEO
     */

    public function geoMustBeNotNull(FunctionalTester $I){
        $this->local->geo = '';
        $I->assertFalse($this->local->save());
    }

    /**
     * ADDRESS
     */

    public function addressMustBeNotNull(FunctionalTester $I){
        $this->local->address = '';
        $I->assertFalse($this->local->save());
    }

    /**
     * OWNER_ID
     */

    public function ownerIdMustBeValidRRPP(FunctionalTester $I){
        $this->local->owner_id = 0;
        $I->assertFalse($this->local->save());
    }
}
