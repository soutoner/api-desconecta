<?php


namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Behavior\Timestampable;

/**
 * @SWG\Definition(required={"event_id","hashTag_id"}, @SWG\Xml(name="EventHasHashTag"))
 */
class EventHasHashTag extends BaseModel
{
    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $event_id;

    /**
     * @SWG\Property(type="integer")
     * @var int
     */
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
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'hashTag_id',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => ['event_id', 'hashTag_id'],
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
