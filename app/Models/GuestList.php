<?php

namespace App\Models;

use App\Lib\Validators\TimestampValidator;
use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\Numericality;
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

        $this->setSource($this->className());

        $this->hasOne('id', 'App\Models\Event', 'guestList_id', ['alias' => 'Event']);

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\Belong',
            'guestList_id',
            'user_id',
            'App\Models\User',
            'id',
            ['alias' => 'Users']
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
                    'field'     => 'start_time',
                    'message'   => 'The start date is required'
                ]
            )
        );
        $this->validate(
            new TimestampValidator(
                [
                    'field'     => 'start_time',
                    'message'   => 'The guest list start time must be valid',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'end_time',
                    'message'   => 'The end date is required'
                ]
            )
        );
        $this->validate(
            new TimestampValidator(
                [
                    'field'     => 'end_time',
                    'message'   => 'The guest list end time must be valid',
                ]
            )
        );
        $this->validate(
            new Numericality(
                [
                    'field'     => 'max_friends',
                    'message'   => 'The guest list max friends must be a number',
                ]
            )
        );
        $this->validate(
            new Numericality(
                [
                    'field'     => 'max_capacity',
                    'message'   => 'The guest list max capacity must be a number',
                ]
            )
        );

        if ($this->max_capacity < 0 || $this->max_friends < 0) {
            return false;
        }

        if ($this->end_time <= $this->start_time) {
            return false;
        }

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    public function beforeSave()
    {
        $this->max_friends = ceil($this->max_friends);
        $this->max_capacity = ceil($this->max_capacity);
    }
}
