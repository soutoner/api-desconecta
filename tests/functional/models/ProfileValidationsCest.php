<?php

namespace models;

use \FunctionalTester;
use App\Models\Profile;
use App\Db\Seeds\Models\ProfileSeeder;
use App\Models\User;
use App\Models\Provider;

class ProfileValidationsCest
{
    protected $profile;

    public function _before(FunctionalTester $I)
    {
        $this->profile = new Profile();
        $this->profile->assign(
            ProfileSeeder::ExtraSeeds()[0]
        );
        $this->profile->user_id = User::findFirst()->id;
        $this->profile->provider_id = Provider::findFirst()->id;
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->profile);
    }

    public function givenProfileisValid(FunctionalTester $I)
    {
        $I->assertTrue($this->profile->save());
    }

    /**
     * UID
     */

    public function uidMustBeNotNull(FunctionalTester $I)
    {
        $this->profile->uid = '';
        $I->assertFalse($this->profile->save());
    }

    /**
     * ACCESS_TOKEN
     */

    public function accessTokenMustBeNotNull(FunctionalTester $I)
    {
        $this->profile->access_token = '';
        $I->assertFalse($this->profile->save());
    }
}
