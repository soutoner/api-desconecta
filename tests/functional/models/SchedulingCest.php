<?php

namespace models;

use \FunctionalTester;
use App\Models\Scheduling;
use App\Db\Seeds\Models\SchedulingSeeder;

class SchedulingCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Scheduling();
        $this->model->assign(
            SchedulingSeeder::ExtraSeeds()[0]
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
     * END_PERIOD
     */

    public function endPeriodMustBeNotNull(FunctionalTester $I){
        $this->model->end_period = '';
        $I->assertFalse($this->model->save());
    }

    // TODO: assert that end_period is after end_time of an event at least

    /**
     * PERIOD_ID
     */

    public function periodIdMustBeNotNull(FunctionalTester $I){
        $this->model->period_id = '';
        $I->assertFalse($this->model->save());
    }

    public function periodIdMustBeValid(FunctionalTester $I){
        $this->model->period_id = 0;
        $I->assertFalse($this->model->save());
    }
}
