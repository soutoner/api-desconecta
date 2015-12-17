<?php

namespace models;

use \FunctionalTester;
use App\Models\Provider;
use App\Db\Seeds\Models\ProviderSeeder;

class ProviderCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Provider();
        $this->model->assign(
            ProviderSeeder::ExtraSeeds()[0]
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
     * VALUE
     */

    public function nameMustBeNotNull(FunctionalTester $I){
        $this->model->name = '';
        $I->assertFalse($this->model->save());
    }

    public function nameMustBeUnique(FunctionalTester $I){
        $this->model->name = Provider::findFirst()->name;
        $I->assertFalse($this->model->save());
    }
}
