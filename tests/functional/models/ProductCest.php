<?php

namespace models;

use \FunctionalTester;
use App\Models\Product;
use App\Db\Seeds\Models\ProductSeeder;

class ProductCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Product();
        $this->model->assign(
            ProductSeeder::ExtraSeeds()[0]
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
     * NAME
     */

    public function nameMustBeNotNull(FunctionalTester $I){
        $this->model->name = '';
        $I->assertFalse($this->model->save());
    }

    public function nameMustBeUnique(FunctionalTester $I){
        $this->model->name = Product::findFirst()->name;
        $I->assertFalse($this->model->save());
    }

    /**
     * ICON
     */

    public function iconMustBeNotNull(FunctionalTester $I){
        $this->model->icon = '';
        $I->assertFalse($this->model->save());
    }
}
