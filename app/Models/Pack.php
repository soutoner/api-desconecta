<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Pack extends BaseModel
{
    public $id;

    public $price;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->class_name());

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\EventHasPack',
            'pack_id', 'event_id',
            'App\Models\Event',
            'id',
            ['alias' => 'Events']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\PackHasProduct',
            'pack_id', 'product_id',
            'App\Models\Product',
            'id',
            ['alias' => 'Products']
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
            new PresenceOf([
                    'field'     => 'price',
                    'message'   => 'A price is required'
                ]
            )
        );
        $this->validate(
            new Uniqueness([
                    'field'     => 'price',
                    'message'   => 'The price must be unique'
                ]
            )
        );

        if($this->price < 0){
            return false;
        }

        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}