<?php

namespace models\relationships;

use \FunctionalTester;
use App\Models\Relationships\Follower;
use App\Db\Seeds\Models\Relationships\FollowerSeeder;

class FollowerCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Follower();
        $this->model->assign(
            FollowerSeeder::ExtraSeeds()[0]
        );
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenModelIsValid(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save(), implode(',', $this->model->getMessages()));
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
     * FOLLOWER_ID
     */

    public function followerIdMustBeNotNull(FunctionalTester $I)
    {
        $this->model->follower_id = '';
        $I->assertFalse($this->model->save());
    }

    public function followerIdMustBeValid(FunctionalTester $I)
    {
        $this->model->follower_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function followerMustBeUnique(FunctionalTester $I)
    {
        $rel = Follower::findFirst();
        $this->model->user_id = $rel->user_id;
        $this->model->follower_id = $rel->follower_id;
        $I->assertFalse($this->model->save());
    }

    public function followerIsNotReflexive(FunctionalTester $I)
    {
        $this->model->user_id = $this->model->follower_id;
        $I->assertFalse($this->model->save());
    }
}
