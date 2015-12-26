<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

/**
 * @SWG\Definition(required={"name","icon"}, @SWG\Xml(name="Product"))
 */
class Product extends BaseModel
{
    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $id;

    /**
     * @SWG\Property(type="string")
     * @var string
     */
    public $name;

    /**
     * @SWG\Property(type="string")
     * @var string
     */
    public $icon;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->className());

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\PackHasProduct',
            'product_id',
            'pack_id',
            'App\Models\Pack',
            'id',
            ['alias' => 'Packs']
        );
    }

    /**
     * Executes the validation
     * @return bool
     * @internal param \Phalcon\Validation $validator
     * @internal param string $attribute
     */
    public function validation()
    {
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'name',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'icon',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => 'name',
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
