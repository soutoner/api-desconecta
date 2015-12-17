<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Event extends BaseModel
{
    public $id;

    public $name;

    public $desc;

    public $photo_cover;

    public $start_date;

    public $end_date;

    public $flyer;

    public $local_id;

    public $guestList_id;

    public $scheduling_id;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->class_name());

        $this->belongsTo('local_id', 'App\Models\Local', 'id',
            [
                'alias' => 'Local',
                'foreignKey' => [
                    'message'    => 'The local_id does not exist on the Local model'
                ]
            ]
        );

        $this->belongsTo('guestList_id', 'App\Models\GuestList', 'id',
            [
                'alias' => 'GuestList',
                'foreignKey' => [
                    'allowNulls' => true,
                    'message'    => 'The guestList_id does not exist on the GuestList model'
                ]
            ]
        );

        $this->belongsTo('scheduling_id', 'App\Models\Scheduling', 'id',
            [
                'alias' => 'Scheduling',
                'foreignKey' => [
                    'allowNulls' => true,
                    'message'    => 'The scheduling_id does not exist on the Scheduling model'
                ]
            ]
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\Attend',
            'event_id', 'user_id',
            'App\Models\User',
            'id',
            ['alias' => 'Users']
        );

        $this->hasMany('id', 'App\Models\Photo', 'event_id', ['alias' => 'Photos']);

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\EventHasHashTag',
            'event_id', 'hashTag_id',
            'App\Models\HashTag',
            'id',
            ['alias' => 'HashTags']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\EventHasMusicTag',
            'event_id', 'musicTag_id',
            'App\Models\MusicTag',
            'id',
            ['alias' => 'MusicTags']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\EventHasPack',
            'event_id', 'pack_id',
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
                    'message'   => 'A cover photo is required'
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
        $this->validate(
            new Uniqueness([
                    'field'     => 'guestList_id',
                    'message'   => 'The guestList_id must be unique',
                ]
            )
        );
        $this->validate(
            new Uniqueness([
                    'field'     => 'scheduling_id',
                    'message'   => 'The scheduling_id must be unique',
                ]
            )
        );

        if($this->end_date <= $this->start_date){
            return false;
        }

        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
