<?php

namespace models\relationships;

use \FunctionalTester;
use App\Models\Relationships\EventHasHashTag;
use App\Db\Seeds\Models\Relationships\EventHasHashTagSeeder;

class EventHasHashTagCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new EventHasHashTag();
        $this->model->assign(
            EventHasHashTagSeeder::ExtraSeeds()[0]
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

    public function eventIdMustBeNotNull(FunctionalTester $I)
    {
        $this->model->event_id = '';
        $I->assertFalse($this->model->save());
    }

    public function eventIdMustBeValid(FunctionalTester $I)
    {
        $this->model->event_id = 0;
        $I->assertFalse($this->model->save());
    }

    /**
     * PHOTO_ID
     */

    public function hashTagIdMustBeNotNull(FunctionalTester $I)
    {
        $this->model->hashTag_id = '';
        $I->assertFalse($this->model->save());
    }

    public function hashTagIdMustBeValid(FunctionalTester $I)
    {
        $this->model->hashTag_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function relMustBeUnique(FunctionalTester $I)
    {
        $rel = EventHasHashTag::findFirst();
        $this->model->event_id = $rel->event_id;
        $this->model->hashTag_id = $rel->hashTag_id;
        $I->assertFalse($this->model->save());
    }
}
