<?php


namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Behavior\Timestampable;

/**
 * @SWG\Definition(required={"user_id","event_id"}, @SWG\Xml(name="Attend"))
 */
class Attend extends BaseModel
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
    public $event_id;

    /**
     * @SWG\Property(type="boolean")
     * @var boolean
     */
    public $geo_attended;

    public function initialize()
    {
        $this->setSource('User_attends_Event');

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
            'event_id',
            'App\Models\Event',
            'id',
            [
                'alias' => 'Event',
                'foreignKey' => [
                    'message' => 'The event_id does not exist on the Event model',
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
                    'field'     => 'event_id',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => ['user_id', 'event_id'],
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    public function beforeCreate()
    {
        if (empty($this->geo_attended)) {
            $this->geo_attended = false;
        }
    }
}
