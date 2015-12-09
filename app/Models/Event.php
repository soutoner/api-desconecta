<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;

class Event extends BaseModel
{
    public $name;

    public $desc;

    public $photo_cover;

    public $start_date;

    public $end_date;

    public $flyer;

    public function initialize()
    {
    /**
     * Table name.
     */
    $this->setSource('Event');
    }

    /**
     * Executes the validation
     * @return bool
     * @internal param \Phalcon\Validation $validator
     * @internal param string $attribute
     */
    public function validation()
    {
        // TODO: length of fields
        // TODO: Validate end_date>start_date
        $this->validate(
            new PresenceOf([
                    'field'     => 'name',
                    'message'   => 'The name is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'desc',
                    'message'   => 'A description is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'photo_cover',
                    'message'   => 'A photography is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'profile_picture',
                    'message'   => 'The profile picture is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'start_date',
                    'message'   => 'The event must have a start date',
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'end_date',
                    'message'   => 'The event must have an end date',
                ]
            )
        );
        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    public static function findFirstOrFail($parameters=null, $resource_id='Event')
    {
        return parent::findFirstOrFail($parameters, $resource_id);
    }
}
