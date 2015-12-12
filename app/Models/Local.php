<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Local extends BaseModel
{
    public $id;

    public $name;

    public $desc;

    public $photo_cover;

    public $geo;

    public $address;

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
                    'message'   => 'The name is required'
                ]
            )
        );
        $this->validate(
            new Uniqueness([
                    'field'     => 'name',
                    'message'   => 'The name must be unique'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'desc',
                    'message'   => 'A description is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'photo_cover',
                    'message'   => 'A photography is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'geo',
                    'message'   => 'The geological position is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'adress',
                    'message'   => 'The local must have an adress',
                ]
            )
        );
        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
