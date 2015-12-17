<?php

namespace models\relationships;

use \FunctionalTester;
use App\Models\Relationships\Attend;
use App\Db\Seeds\Models\Relationships\AttendSeeder;

class AttendCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Attend();
        $this->model->assign(
            AttendSeeder::ExtraSeeds()[0]
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
     * EVENT_ID
     */

    public function eventIdMustBeNotNull(FunctionalTester $I){
        $this->model->event_id = '';
        $I->assertFalse($this->model->save());
    }

    public function eventIdMustBeValid(FunctionalTester $I){
        $this->model->event_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function attendMustBeUnique(FunctionalTester $I){
        $rel = Attend::findFirst();
        $this->model->user_id = $rel->user_id;
        $this->model->event_id = $rel->event_id;
        $I->assertFalse($this->model->save());
    }

    /**
     * GEO_ATTENDED
     */

    public function geoAttendedIsOptionalAndFalseByDefault(FunctionalTester $I){
        $this->model->geo_attended = '';
        $I->assertTrue($this->model->save());
        $I->assertFalse($this->model->geo_attended);
    }
}
