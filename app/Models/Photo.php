<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;

class Photo extends BaseModel
{
    // TODO: who owns a photo?
    public $id;

    public $uri;

    public $desc;

    public $event_id;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->className());

        $this->belongsTo(
            'event_id',
            'App\Models\Event',
            'id',
            [
            'alias' => 'Event',
            'foreignKey' =>
                [
                'message'    => 'The event_id does not exist on the Event model'
                ]
            ]
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\Appear',
            'photo_id',
            'user_id',
            'App\Models\User',
            'id',
            ['alias' => 'UsersAppearing']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\PhotoHasHashTag',
            'photo_id',
            'hashTag_id',
            'App\Models\HashTag',
            'id',
            ['alias' => 'HashTags']
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
                'field'     => 'uri',
                'message'   => 'An uri is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                'field'     => 'event_id',
                'message'   => 'An event_id is required'
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
