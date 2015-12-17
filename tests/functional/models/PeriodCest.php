<?php

namespace models;

use \FunctionalTester;
use App\Models\Period;
use App\Db\Seeds\Models\PeriodSeeder;

class PeriodCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Period();
        $this->model->assign(
            PeriodSeeder::ExtraSeeds()[0]
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
     * TYPE
     */

    public function typeMustBeNotNull(FunctionalTester $I){
        $this->model->type = '';
        $I->assertFalse($this->model->save());
    }

    public function typeMustBeUnique(FunctionalTester $I){
        $this->model->type = Period::findFirst()->type;
        $I->assertFalse($this->model->save());
    }
}
