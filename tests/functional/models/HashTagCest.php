<?php

namespace models;

use \FunctionalTester;
use App\Models\HashTag;
use App\Db\Seeds\Models\HashTagSeeder;

class HashTagCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new HashTag();
        $this->model->assign(
            HashTagSeeder::ExtraSeeds()[0]
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
     * VALUE
     */

    public function valueMustBeNotNull(FunctionalTester $I)
    {
        $this->model->value = '';
        $I->assertFalse($this->model->save());
    }

    public function valueMustBeUnique(FunctionalTester $I)
    {
        $this->model->value = HashTag::findFirst()->value;
        $I->assertFalse($this->model->save());
    }
}
