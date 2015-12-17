<?php

namespace models;

use \FunctionalTester;
use App\Models\Photo;
use App\Db\Seeds\Models\PhotoSeeder;

class PhotoCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Photo();
        $this->model->assign(
            PhotoSeeder::ExtraSeeds()[0]
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
     * URI
     */

    public function uriMustBeNotNull(FunctionalTester $I){
        $this->model->uri = '';
        $I->assertFalse($this->model->save());
    }

    /**
     * DESC
     */

    public function descMustBeOptional(FunctionalTester $I){
        $this->model->desc = '';
        $I->assertTrue($this->model->save());
    }

    /**
     * EVENT_ID
     */

    public function eventIdMustBeNotNull(FunctionalTester $I){
        $this->model->event_id = null;
        $I->assertFalse($this->model->save());
    }

    public function eventIdMustBeValid(FunctionalTester $I){
        $this->model->event_id = 0;
        $I->assertFalse($this->model->save());
    }
}
