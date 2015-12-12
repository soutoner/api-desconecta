<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;

class GuestList extends BaseModel
{
    public $id;

    public $start_time;

    public $end_time;

    public $max_friends;

    public $max_capacity;

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
                    'field'     => 'start_time',
                    'message'   => 'The start date is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'end_time',
                    'message'   => 'The end date is required'
                ]
            )
        );
        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
