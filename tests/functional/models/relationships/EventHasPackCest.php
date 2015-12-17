<?php

namespace models\relationships;

use \FunctionalTester;
use App\Models\Relationships\EventHasPack;
use App\Db\Seeds\Models\Relationships\EventHasPackSeeder;

class EventHasPackCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new EventHasPack();
        $this->model->assign(
            EventHasPackSeeder::ExtraSeeds()[0]
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

    public function eventIdMustBeNotNull(FunctionalTester $I){
        $this->model->event_id = '';
        $I->assertFalse($this->model->save());
    }

    public function eventIdMustBeValid(FunctionalTester $I){
        $this->model->event_id = 0;
        $I->assertFalse($this->model->save());
    }

    /**
     * PHOTO_ID
     */

    public function packIdMustBeNotNull(FunctionalTester $I){
        $this->model->pack_id = '';
        $I->assertFalse($this->model->save());
    }

    public function packIdMustBeValid(FunctionalTester $I){
        $this->model->pack_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function relMustBeUnique(FunctionalTester $I){
        $rel = EventHasPack::findFirst();
        $this->model->event_id = $rel->event_id;
        $this->model->pack_id = $rel->pack_id;
        $I->assertFalse($this->model->save());
    }
}
