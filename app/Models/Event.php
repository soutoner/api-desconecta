<?php

namespace App\Models;

use App\Lib\Validators\TimestampValidator;
use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

/**
 * @SWG\Definition(required={"name","desc","photo_cover","start_date","end_date","local_id"}, @SWG\Xml(name="Event"))
 */
class Event extends BaseModel
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
     * @SWG\Property(type="string",format="date-time")
     * @var string
     */
    public $start_date;

    /**
     * @SWG\Property(type="string",format="date-time")
     * @var string
     */
    public $end_date;

    /**
     * @SWG\Property(type="string")
     * @var string
     */
    public $flyer;

    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $local_id;

    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $guestList_id;

    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $scheduling_id;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->className());

        $this->belongsTo(
            'local_id',
            'App\Models\Local',
            'id',
            [
                'alias' => 'Local',
                'foreignKey' => [
                    'message'    => 'The local_id does not exist on the Local model',
                ],
            ]
        );

        $this->belongsTo(
            'guestList_id',
            'App\Models\GuestList',
            'id',
            [
                'alias' => 'GuestList',
                'foreignKey' => [
                    'allowNulls' => true,
                    'message'    => 'The guestList_id does not exist on the GuestList model',
                ],
            ]
        );

        $this->belongsTo(
            'scheduling_id',
            'App\Models\Scheduling',
            'id',
            [
                'alias' => 'Scheduling',
                'foreignKey' => [
                    'allowNulls' => true,
                    'message'    => 'The scheduling_id does not exist on the Scheduling model',
                ],
            ]
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\Attend',
            'event_id',
            'user_id',
            'App\Models\User',
            'id',
            ['alias' => 'Users']
        );

        $this->hasMany('id', 'App\Models\Photo', 'event_id', ['alias' => 'Photos']);

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\EventHasHashTag',
            'event_id',
            'hashTag_id',
            'App\Models\HashTag',
            'id',
            ['alias' => 'HashTags']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\EventHasMusicTag',
            'event_id',
            'musicTag_id',
            'App\Models\MusicTag',
            'id',
            ['alias' => 'MusicTags']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\EventHasPack',
            'event_id',
            'pack_id',
            'App\Models\Pack',
            'id',
            ['alias' => 'Packs']
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
        // TODO: validates image paths
        $this->validate(
            new PresenceOf(
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
                    'field'     => 'start_date',
                ]
            )
        );
        $this->validate(
            new TimestampValidator(
                [
                    'field'     => 'start_date',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'end_date',
                ]
            )
        );
        $this->validate(
            new TimestampValidator(
                [
                    'field'     => 'end_date',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => 'guestList_id',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => 'scheduling_id',
                ]
            )
        );

        if ($this->end_date <= $this->start_date) {
            $this->appendMessage(new Message('The end_date must be after start_date', 'end_date'));

            return false;
        }

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
