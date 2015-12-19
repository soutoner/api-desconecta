<?php

namespace models;

use \FunctionalTester;
use App\Models\Pack;
use App\Db\Seeds\Models\PackSeeder;

class PackCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Pack();
        $this->model->assign(
            PackSeeder::ExtraSeeds()[0]
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
     * PRICE
     */

    public function priceMustBeNotNull(FunctionalTester $I)
    {
        $this->model->price = '';
        $I->assertFalse($this->model->save());
    }

    public function priceMustBeUnique(FunctionalTester $I)
    {
        $this->model->price = Pack::findFirst()->price;
        $I->assertFalse($this->model->save());
    }

    public function priceMustBePositive(FunctionalTester $I)
    {
        $this->model->price = -10;
        $I->assertFalse($this->model->save());
    }
}
