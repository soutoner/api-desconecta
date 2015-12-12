<?php

namespace models;

use \FunctionalTester;
use App\Models\User;
use App\Db\Seeds\Models\UserSeeder;

class UserValidationsCest
{
    protected $user;

    public function _before(FunctionalTester $I)
    {
        $this->user = new User();
        $this->user->assign(
            UserSeeder::ExtraSeeds()[0]
        );
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->user);
    }

    public function givenUserIsValid(FunctionalTester $I){
        $I->assertTrue($this->user->save());
    }

    /**
     * NAME
     */

    public function nameMustBeNotNull(FunctionalTester $I)
    {
        $this->user->name = '';
        $I->assertFalse($this->user->save());
    }

    /**
     * SURNAME
     */

    public function surnameMustBeNotNull(FunctionalTester $I)
    {
        $this->user->surname = '';
        $I->assertFalse($this->user->save());
    }

    /**
     * EMAIL
     */

    public function emailMustBeNotNull(FunctionalTester $I)
    {
        $this->user->email = '';
        $I->assertFalse($this->user->save());
    }

    public function emailMustBeUnique(FunctionalTester $I)
    {
        $this->user->email = User::findFirst()->email;
        $I->assertFalse($this->user->save());
    }

    /**
     * PROFILE_PICTURE
     */

    public function profilePictureMustBeNotNull(FunctionalTester $I)
    {
        $this->user->profile_picture = '';
        $I->assertFalse($this->user->save());
    }

    /**
     * GENDER
     */

    public function genderMustBeHorM(FunctionalTester $I)
    {
        $this->user->gender = 'X';
        $I->assertFalse($this->user->save());
    }

    /**
     * CREATED_AT
     */

    public function createdAtContainsTimeStampOfCreation(FunctionalTester $I){
        $creation_timestamp = date('Y-m-d H:i:sP', time());
        $this->user->save();
        $I->assertEquals($creation_timestamp, $this->user->created_at);
    }

    /**
     * UPDATED_AT
     */

    public function updatedAtContainsTimeStampOfCreation(FunctionalTester $I){
        $creation_timestamp = date('Y-m-d H:i:sP', time());
        $this->user->save();
        $I->assertEquals($creation_timestamp, $this->user->updated_at);
    }

    public function updatedAtUpdatesTimeStampOnUpdate(FunctionalTester $I){
        $this->user->save();
        sleep(1);
        $update_timestamp = date('Y-m-d H:i:sP', time());
        $this->user->update([ 'name' => 'Foo' ]);
        $I->assertNotEquals($this->user->created_at, $this->user->updated_at);
        $I->assertEquals($update_timestamp, $this->user->updated_at);
    }
}
