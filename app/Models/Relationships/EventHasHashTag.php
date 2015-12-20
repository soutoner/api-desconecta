<?php


namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class EventHasHashTag extends BaseModel
{
    public $event_id;

    public $hashTag_id;

    public function initialize()
    {
        $this->setSource('Event_has_HashTag');

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
        $this->belongsTo(
            'hashTag_id',
            'App\Models\HashTag',
            'id',
            [
                'alias' => 'HashTag',
                'foreignKey' => [
                    'message' => 'The hashTag_id does not exist on the HashTag model',
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
                    'field'     => 'event_id',
                    'message'   => 'The event_id is required',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'hashTag_id',
                    'message'   => 'The hashTag_id is required',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => ['event_id', 'hashTag_id'],
                    'message'   => 'The event_id and hashTag_id combination must be unique',
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
