<?php

namespace models\relationships;

use \FunctionalTester;
use App\Models\Relationships\Appear;
use App\Db\Seeds\Models\Relationships\AppearSeeder;

class AppearCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Appear();
        $this->model->assign(
            AppearSeeder::ExtraSeeds()[0]
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
     * PHOTO_ID
     */

    public function photoIdMustBeNotNull(FunctionalTester $I)
    {
        $this->model->photo_id = '';
        $I->assertFalse($this->model->save());
    }

    public function photoIdMustBeValid(FunctionalTester $I)
    {
        $this->model->photo_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function appearMustBeUnique(FunctionalTester $I)
    {
        $rel = Appear::findFirst();
        $this->model->user_id = $rel->user_id;
        $this->model->photo_id = $rel->photo_id;
        $I->assertFalse($this->model->save());
    }
}
