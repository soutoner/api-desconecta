<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Local extends BaseModel
{
    public $id;

    public $name;

    public $desc;

    public $photo_cover;

    public $geo;

    public $address;

    public $owner_id;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->className());

        $this->belongsTo(
            'owner_id',
            'App\Models\RRPP',
            'id',
            [
            'alias' => 'Owner',
            'foreignKey' => [
                'message' => 'The owner_id does not exist on the RRPP model',
                ],
            ]
        );

        $this->hasMany('id', 'App\Models\Event', 'local_id', ['alias' => 'Events']);

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\Follow',
            'local_id',
            'user_id',
            'App\Models\User',
            'id',
            ['alias' => 'Followers']
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
                    'field'     => 'name',
                    'message'   => 'The local name is required',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => 'name',
                    'message'   => 'The local name must be unique',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'desc',
                    'message'   => 'The local description is required',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'photo_cover',
                    'message'   => 'The local cover photo is required',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'geo',
                    'message'   => 'The local geological position is required',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'address',
                    'message'   => 'The local address is required',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'owner_id',
                    'message'   => 'The local owner is required',
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
