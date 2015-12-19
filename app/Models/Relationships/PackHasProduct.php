<?php


namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class PackHasProduct extends BaseModel
{
    public $pack_id;

    public $product_id;

    public function initialize()
    {
        $this->setSource('Pack_has_Product');

        $this->belongsTo(
            'pack_id',
            'App\Models\Pack',
            'id',
            [
            'alias' => 'Pack',
            'foreignKey' =>
                [
                'message' => 'The pack_id does not exist on the Pack model'
                ],
            ]
        );
        $this->belongsTo(
            'product_id',
            'App\Models\Product',
            'id',
            [
            'alias' => 'Product',
            'foreignKey' =>
                [
                'message' => 'The product_id does not exist on the Product model'
                ],
            ]
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
                'field'     => 'pack_id',
                'message'   => 'The pack_id is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                'field'     => 'product_id',
                'message'   => 'The product_id is required'
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                'field'     => ['pack_id', 'product_id'],
                'message'   => 'The pack_id and product_id combination must be unique'
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
