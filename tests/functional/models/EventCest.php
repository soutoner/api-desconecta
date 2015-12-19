<?php

namespace models;

use \FunctionalTester;
use App\Models\Event;
use App\Db\Seeds\Models\EventSeeder;

class EventCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Event();
        $this->model->assign(
            EventSeeder::ExtraSeeds()[0]
        );
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenModelIsValid(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save(), implode("|", $this->model->getMessages()));
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
     * DESC
     */

    public function descMustBeNotNull(FunctionalTester $I)
    {
        $this->model->desc = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * PHOTO_COVER
     */

    public function photoCoverMustBeNotNull(FunctionalTester $I)
    {
        $this->model->photo_cover = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * START_DATE
     */

    public function startDateMustBeNotNull(FunctionalTester $I)
    {
        $this->model->start_date = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * END_DATE
     */

    public function endDateMustBeNotNull(FunctionalTester $I)
    {
        $this->model->end_date = '';
        $I->assertFalse($this->model->save());
    }

    public function endDateMustBeAfterStartDate(FunctionalTester $I)
    {
        $this->model->end_date = date('Y-m-d H:i:s');
        sleep(1);
        $this->model->start_date = date('Y-m-d H:i:s');
        $I->assertFalse($this->model->save());
    }

    /**
     * FLYER
     */

    public function flyerMustBeOptional(FunctionalTester $I)
    {
        $this->model->flyer = '';
        $I->assertTrue($this->model->save());
    }

    /**
     * LOCAL_ID
     */

    public function localIdMustBeNotNull(FunctionalTester $I)
    {
        $this->model->local_id = '';
        $I->assertFalse($this->model->save());
    }

    public function localIdMustBeValid(FunctionalTester $I)
    {
        $this->model->local_id = 0;
        $I->assertFalse($this->model->save());
    }

    /**
     * GUESTLIST_ID
     */

    public function guestListIsOptional(FunctionalTester $I)
    {
        $this->model->guestList_id = null;
        $I->assertTrue($this->model->save());
    }

    public function guestListMustBeValid(FunctionalTester $I)
    {
        $this->model->guestList_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function guestListMustBeUnique(FunctionalTester $I)
    {
        $this->model->guestList_id = Event::findFirst('guestList_id IS NOT NULL')->guestList_id;
        $I->assertFalse($this->model->save());
    }

    /**
     * SCHEDULING_ID
     */

    public function schedulingIsOptional(FunctionalTester $I)
    {
        $this->model->scheduling_id = null;
        $I->assertTrue($this->model->save());
    }

    public function schedulingdMustBeValid(FunctionalTester $I)
    {
        $this->model->scheduling_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function schedulingMustBeUnique(FunctionalTester $I)
    {
        $this->model->scheduling_id = Event::findFirst('scheduling_id IS NOT NULL')->scheduling_id;
        $I->assertFalse($this->model->save());
    }
}
