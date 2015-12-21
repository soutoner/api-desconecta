<?php

namespace models;

use \FunctionalTester;
use App\Models\User;
use App\Db\Seeds\Models\UserSeeder;

class UserCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new User();
        $this->model->assign(
            UserSeeder::ExtraSeeds()[0]
        );
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenUserIsValid(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save());
    }

    /**
     * NAME
     */

    public function nameMustBeNotNull(FunctionalTester $I)
    {
        $this->model->name = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * SURNAME
     */

    public function surnameMustBeNotNull(FunctionalTester $I)
    {
        $this->model->surname = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * EMAIL
     */

    public function emailMustBeNotNull(FunctionalTester $I)
    {
        $this->model->email = '';
        $I->assertFalse($this->model->save());
    }

    public function emailMustBeUnique(FunctionalTester $I)
    {
        $this->model->email = User::findFirst()->email;
        $I->assertFalse($this->model->save());
    }

    /**
     * PROFILE_PICTURE
     */

    public function profilePictureMustBeNotNull(FunctionalTester $I)
    {
        $this->model->profile_picture = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * GENDER
     */

    public function genderMustBeHorM(FunctionalTester $I)
    {
        $this->model->gender = 'X';
        $I->assertFalse($this->model->save());
    }

    /**
     * RRPP_ID
     */

    public function rrppIdCouldBeNull(FunctionalTester $I)
    {
        $this->model->rrpp_id = null;
        $I->assertTrue($this->model->save(), implode('|', $this->model->getMessages()));
    }

    public function rrppIdIfExistentMustBeValid(FunctionalTester $I)
    {
        $this->model->rrpp_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function rrppIdMustBeUnique(FunctionalTester $I)
    {
        $this->model->rrpp_id = User::findFirst('rrpp_id IS NOT NULL')->rrpp_id;
        $I->assertFalse($this->model->save());
    }

    /**
     * CREATED_AT
     */

    public function createdAtContainsTimeStampOfCreation(FunctionalTester $I)
    {
        $creation_timestamp = date('Y-m-d H:i:s', time());
        $this->model->save();
        $I->assertEquals($creation_timestamp, $this->model->created_at);
    }

    /**
     * UPDATED_AT
     */

    public function updatedAtContainsTimeStampOfCreation(FunctionalTester $I)
    {
        $creation_timestamp = date('Y-m-d H:i:s', time());
        $this->model->save();
        $I->assertEquals($creation_timestamp, $this->model->updated_at);
    }

    public function updatedAtUpdatesTimeStampOnUpdate(FunctionalTester $I)
    {
        $this->model->save();
        sleep(1);
        $update_timestamp = date('Y-m-d H:i:s', time());
        $this->model->update([ 'name' => 'Foo' ]);
        $I->assertNotEquals($this->model->created_at, $this->model->updated_at);
        $I->assertEquals($update_timestamp, $this->model->updated_at);
    }
}
