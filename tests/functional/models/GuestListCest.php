<?php

namespace models;

use \FunctionalTester;
use App\Models\GuestList;
use App\Db\Seeds\Models\GuestListSeeder;

class GuestListCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new GuestList();
        $this->model->assign(
            GuestListSeeder::ExtraSeeds()[0]
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
     * START_TIME
     */

    public function startTimeMustBeNotNull(FunctionalTester $I){
        $this->model->start_time = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * END_TIME
     */

    public function endTimeMustBeNotNull(FunctionalTester $I){
        $this->model->end_time = '';
        $I->assertFalse($this->model->save());
    }

    public function endTimeMustBeAfterStartTime(FunctionalTester $I){
        $this->model->end_time = date('Y-m-d H:i:s');
        sleep(1);
        $this->model->start_time = date('Y-m-d H:i:s');
        $I->assertFalse($this->model->save());
    }

    /**
     * MAX_FRIENDS
     */

    public function maxFriendsMustBePositive(FunctionalTester $I){
        $this->model->max_friends = -10;
        $I->assertFalse($this->model->save());
    }

    /**
     * MAX_CAPACITY
     */

    public function maxCapacityMustBePositive(FunctionalTester $I){
        $this->model->max_capacity = -10;
        $I->assertFalse($this->model->save());
    }
}
