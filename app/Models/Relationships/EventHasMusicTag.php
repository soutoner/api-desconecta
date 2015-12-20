<?php


namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class EventHasMusicTag extends BaseModel
{
    public $event_id;

    public $musicTag_id;

    public function initialize()
    {
        $this->setSource('Event_has_MusicTag');

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
            'musicTag_id',
            'App\Models\MusicTag',
            'id',
            [
                'alias' => 'MusicTag',
                'foreignKey' => [
                    'message' => 'The musicTag_id does not exist on the MusicTag model',
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
                    'field'     => 'musicTag_id',
                    'message'   => 'The musicTag_id is required',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => ['event_id', 'musicTag_id'],
                    'message'   => 'The event_id and musicTag_id combination must be unique',
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
