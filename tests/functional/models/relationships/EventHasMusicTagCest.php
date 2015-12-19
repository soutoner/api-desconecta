<?php

namespace models\relationships;

use \FunctionalTester;
use App\Models\Relationships\EventHasMusicTag;
use App\Db\Seeds\Models\Relationships\EventHasMusicTagSeeder;

class EventHasMusicTagCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new EventHasMusicTag();
        $this->model->assign(
            EventHasMusicTagSeeder::ExtraSeeds()[0]
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

    public function musicTagIdMustBeNotNull(FunctionalTester $I)
    {
        $this->model->musicTag_id = '';
        $I->assertFalse($this->model->save());
    }

    public function musicTagIdMustBeValid(FunctionalTester $I)
    {
        $this->model->musicTag_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function relMustBeUnique(FunctionalTester $I)
    {
        $rel = EventHasMusicTag::findFirst();
        $this->model->event_id = $rel->event_id;
        $this->model->musicTag_id = $rel->musicTag_id;
        $I->assertFalse($this->model->save());
    }
}
