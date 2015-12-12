<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Product extends BaseModel
{
    public $id;

    public $name;

    public $icon;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->class_name());
    }

    /**
     * Executes the validation
     * @return bool
     * @internal param \Phalcon\Validation $validator
     * @internal param string $attribute
     */
    public function validation()
    {
        // TODO: length of fields
        $this->validate(
            new PresenceOf([
                    'field'     => 'name',
                    'message'   => 'A name is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'icon',
                    'message'   => 'A icon is required'
                ]
            )
        );
        $this->validate(
            new Uniqueness([
                    'field'     => 'name',
                    'message'   => 'The name must be unique',
                ]
            )
        );
        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }

    }
}
