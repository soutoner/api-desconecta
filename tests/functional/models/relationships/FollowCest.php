<?php

namespace models\relationships;

use \FunctionalTester;
use App\Models\Relationships\Follow;
use App\Db\Seeds\Models\Relationships\FollowSeeder;

class FollowCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Follow();
        $this->model->assign(
            FollowSeeder::ExtraSeeds()[0]
        );
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenModelIsValid(FunctionalTester $I){
        $I->assertTrue($this->model->save(), implode(',', $this->model->getMessages()));
    }

    /**
     * USER_ID
     */

    public function userIdMustBeNotNull(FunctionalTester $I){
        $this->model->user_id = '';
        $I->assertFalse($this->model->save());
    }

    public function userIdMustBeValid(FunctionalTester $I){
        $this->model->user_id = 0;
        $I->assertFalse($this->model->save());
    }

    /**
     * PHOTO_ID
     */

    public function localIdMustBeNotNull(FunctionalTester $I){
        $this->model->local_id = '';
        $I->assertFalse($this->model->save());
    }

    public function localIdMustBeValid(FunctionalTester $I){
        $this->model->local_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function followMustBeUnique(FunctionalTester $I){
        $rel = Follow::findFirst();
        $this->model->user_id = $rel->user_id;
        $this->model->local_id = $rel->local_id;
        $I->assertFalse($this->model->save());
    }
}
