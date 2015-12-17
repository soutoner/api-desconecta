<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class MusicTag extends BaseModel
{
    public $id;

    public $value;

    public function initialize()
    {
        parent::initialize();

        /**
         * Table name.
         */
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
        $this->validate(
            new PresenceOf([
                    'field'     => 'value',
                    'message'   => 'A value is required'
                ]
            )
        );
        $this->validate(
            new Uniqueness([
                    'field'     => 'value',
                    'message'   => 'The value must be unique'
                ]
            )
        );


        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}

