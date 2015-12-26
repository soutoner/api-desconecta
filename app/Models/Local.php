<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

/**
 * @SWG\Definition(required={"name","desc","photo_cover","geo","address","owner_id"}, @SWG\Xml(name="Local"))
 */
class Local extends BaseModel
{
    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $id;

    /**
     * @SWG\Property(type="string")
     * @var string
     */
    public $name;

    /**
     * @SWG\Property(type="string")
     * @var string
     */
    public $desc;

    /**
     * @SWG\Property(type="string")
     * @var string
     */
    public $photo_cover;

    /**
     * @SWG\Property(type="string")
     * @var string
     */
    public $geo;

    /**
     * @SWG\Property(type="string")
     * @var string
     */
    public $address;

    /**
     * @SWG\Property(type="integer")
     * @var int
     */
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
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => 'name',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'desc',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'photo_cover',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'geo',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'address',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'owner_id',
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
