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
                ]
            )
        );
        $this->validate(
            new TimestampValidator(
                [
                    'field'     => 'start_time',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'end_time',
                ]
            )
        );
        $this->validate(
            new TimestampValidator(
                [
                    'field'     => 'end_time',
                ]
            )
        );
        $this->validate(
            new Numericality(
                [
                    'field'     => 'max_friends',
                ]
            )
        );
        $this->validate(
            new Numericality(
                [
                    'field'     => 'max_capacity',
                ]
            )
        );

        if ($this->max_capacity < 0) {
            $this->appendMessage(new Message('The field max_capacity must be positive', 'max_capacity'));

            return false;
        }

        if ($this->max_friends < 0) {
            $this->appendMessage(new Message('The field max_friendsy must be positive', 'max_friends'));

            return false;
        }

        if ($this->end_time <= $this->start_time) {
            $this->appendMessage(new Message('The end_time must be after start_time', 'end_time'));

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
