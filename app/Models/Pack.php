<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

/**
 * @SWG\Definition(required={"price"}, @SWG\Xml(name="Pack"))
 */
class Pack extends BaseModel
{
    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $id;

    /**
     * @SWG\Property(type="number",format="double")
     * @var double
     */
    public $price;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->className());

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\EventHasPack',
            'pack_id',
            'event_id',
            'App\Models\Event',
            'id',
            ['alias' => 'Events']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\PackHasProduct',
            'pack_id',
            'product_id',
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
            new PresenceOf(
                [
                    'field'     => 'price',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => 'price',
                ]
            )
        );

        if ($this->price < 0) {
            $this->appendMessage(new Message('The field price must be positive', 'price'));

            return false;
        }

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
