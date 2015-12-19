<?php


namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class Belong extends BaseModel
{
    public $user_id;

    public $guestList_id;

    public function initialize()
    {
        $this->setSource('User_belongs_GuestList');

        $this->belongsTo(
            'user_id',
            'App\Models\User',
            'id',
            [
            'alias' => 'User',
            'foreignKey' =>
                [
                'message' => 'The user_id does not exist on the User model'
                ],
            ]
        );
        $this->belongsTo(
            'guestList_id',
            'App\Models\GuestList',
            'id',
            [
            'alias' => 'GuestList',
            'foreignKey' =>
                [
                'message' => 'The guestList_id does not exist on the GuestList model'
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
                'field'     => 'user_id',
                'message'   => 'The user_id is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                'field'     => 'guestList_id',
                'message'   => 'The guestList_id is required'
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                'field'     => ['user_id', 'guestList_id'],
                'message'   => 'The user_id and guestList_id combination must be unique'
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
