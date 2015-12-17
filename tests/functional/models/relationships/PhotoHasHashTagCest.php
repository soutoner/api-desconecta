<?php

namespace models\relationships;

use \FunctionalTester;
use App\Models\Relationships\PhotoHasHashTag;
use App\Db\Seeds\Models\Relationships\PhotoHasHashTagSeeder;

class PhotoHasHashTagCest
{
    protected $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new PhotoHasHashTag();
        $this->model->assign(
            PhotoHasHashTagSeeder::ExtraSeeds()[0]
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

    public function photoIdMustBeNotNull(FunctionalTester $I){
        $this->model->photo_id = '';
        $I->assertFalse($this->model->save());
    }

    public function photoIdMustBeValid(FunctionalTester $I){
        $this->model->photo_id = 0;
        $I->assertFalse($this->model->save());
    }

    /**
     * PHOTO_ID
     */

    public function hashTagIdMustBeNotNull(FunctionalTester $I){
        $this->model->hashTag_id = '';
        $I->assertFalse($this->model->save());
    }

    public function hashTagIdMustBeValid(FunctionalTester $I){
        $this->model->hashTag_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function relMustBeUnique(FunctionalTester $I){
        $rel = PhotoHasHashTag::findFirst();
        $this->model->photo_id = $rel->photo_id;
        $this->model->hashTag_id = $rel->hashTag_id;
        $I->assertFalse($this->model->save());
    }
}
