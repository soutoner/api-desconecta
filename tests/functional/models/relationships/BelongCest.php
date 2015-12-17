<?php

namespace models\relationships;

use \FunctionalTester;
use App\Models\Relationships\Belong;
use App\Db\Seeds\Models\Relationships\BelongSeeder;

class BelongCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Belong();
        $this->model->assign(
            BelongSeeder::ExtraSeeds()[0]
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

    public function guestListIdMustBeNotNull(FunctionalTester $I){
        $this->model->guestList_id = '';
        $I->assertFalse($this->model->save());
    }

    public function guestListIdMustBeValid(FunctionalTester $I){
        $this->model->guestList_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function belongMustBeUnique(FunctionalTester $I){
        $rel = Belong::findFirst();
        $this->model->user_id = $rel->user_id;
        $this->model->guestList_id = $rel->guestList_id;
        $I->assertFalse($this->model->save());
    }
}
