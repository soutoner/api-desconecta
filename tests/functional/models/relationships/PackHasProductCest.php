<?php

namespace models\relationships;

use \FunctionalTester;
use App\Models\Relationships\PackHasProduct;
use App\Db\Seeds\Models\Relationships\PackHasProductSeeder;

class PackHasProductCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new PackHasProduct();
        $this->model->assign(
            PackHasProductSeeder::ExtraSeeds()[0]
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

    public function packIdMustBeNotNull(FunctionalTester $I){
        $this->model->pack_id = '';
        $I->assertFalse($this->model->save());
    }

    public function packIdMustBeValid(FunctionalTester $I){
        $this->model->pack_id = 0;
        $I->assertFalse($this->model->save());
    }

    /**
     * PHOTO_ID
     */

    public function productIdMustBeNotNull(FunctionalTester $I){
        $this->model->product_id = '';
        $I->assertFalse($this->model->save());
    }

    public function productIdMustBeValid(FunctionalTester $I){
        $this->model->product_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function relMustBeUnique(FunctionalTester $I){
        $rel = PackHasProduct::findFirst();
        $this->model->pack_id = $rel->pack_id;
        $this->model->product_id = $rel->product_id;
        $I->assertFalse($this->model->save());
    }
}
