<?php

namespace models;

use \FunctionalTester;
use App\Models\Profile;
use App\Db\Seeds\Models\ProfileSeeder;

class ProfileCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Profile();
        $this->model->assign(
            ProfileSeeder::ExtraSeeds()[0]
        );
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenModelIsValid(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save(), implode('|', $this->model->getMessages()));
    }

    /**
     * UID
     */

    public function uidMustBeNotNull(FunctionalTester $I)
    {
        $this->model->uid = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * ACCESS_TOKEN
     */

    public function accessTokenMustBeNotNull(FunctionalTester $I)
    {
        $this->model->access_token = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * USER_ID
     */

    public function userIdMustBeNotNull(FunctionalTester $I)
    {
        $this->model->user_id = '';
        $I->assertFalse($this->model->save());
    }

    public function userIdMustBeValid(FunctionalTester $I)
    {
        $this->model->user_id = 0;
        $I->assertFalse($this->model->save());
    }

    /**
     * PROVIDER_ID
     */

    public function providerIdMustBeNotNull(FunctionalTester $I)
    {
        $this->model->provider_id = '';
        $I->assertFalse($this->model->save());
    }

    public function providerIdMustBeValid(FunctionalTester $I)
    {
        $this->model->provider_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function userIdProviderIdMustBeUnique(FunctionalTester $I)
    {
        $this->model->user_id = Profile::findFirst()->user_id;
        $this->model->provider_id = Profile::findFirst()->provider_id;
        $I->assertFalse($this->model->save());
    }
}
