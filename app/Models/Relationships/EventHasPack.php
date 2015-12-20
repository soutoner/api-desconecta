<?php


namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class EventHasPack extends BaseModel
{
    public $event_id;

    public $pack_id;

    public function initialize()
    {
        $this->setSource('Event_has_Pack');

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
            'pack_id',
            'App\Models\Pack',
            'id',
            [
                'alias' => 'Pack',
                'foreignKey' => [
                    'message' => 'The pack_id does not exist on the Pack model',
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
                    'field'     => 'pack_id',
                    'message'   => 'The pack_id is required',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => ['event_id', 'pack_id'],
                    'message'   => 'The event_id and pack_id combination must be unique',
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
