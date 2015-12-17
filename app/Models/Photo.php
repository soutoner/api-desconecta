<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;

class Photo extends BaseModel
{
    public $id;

    public $uri;

    public $desc;

    public $event_id;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->class_name());

        $this->belongsTo('event_id', 'App\Models\Event', 'id',
            [
                'alias' => 'Event',
                'foreignKey' => [
                    'message'    => 'The event_id does not exist on the Event model'
                ]
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
            new PresenceOf([
                    'field'     => 'uri',
                    'message'   => 'An uri is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'event_id',
                    'message'   => 'An event_id is required'
                ]
            )
        );

        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}