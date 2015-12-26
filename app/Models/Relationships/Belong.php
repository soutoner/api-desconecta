<?php


namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Behavior\Timestampable;

/**
 * @SWG\Definition(required={"user_id","guestList_id"}, @SWG\Xml(name="Belong"))
 */
class Belong extends BaseModel
{
    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $user_id;

    /**
     * @SWG\Property(type="integer")
     * @var int
     */
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
                'foreignKey' => [
                    'message' => 'The user_id does not exist on the User model',
                ],
            ]
        );
        $this->belongsTo(
            'guestList_id',
            'App\Models\GuestList',
            'id',
            [
                'alias' => 'GuestList',
                'foreignKey' => [
                    'message' => 'The guestList_id does not exist on the GuestList model',
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
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'guestList_id',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => ['user_id', 'guestList_id'],
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
