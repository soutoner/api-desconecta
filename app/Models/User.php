<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\Email;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\InclusionIn;
use Phalcon\Mvc\Model\Validator\Url;
use App\Lib\Validators\DateValidator;

class User extends BaseModel
{
    public $id;

    public $name;

    public $surname;

    public $email;

    public $profile_picture;

    public $date_birth;

    public $gender;

    public $location;

    public $rrpp_id;

    public function initialize()
    {
        parent::initialize();

        /**
         * Table name.
         */
        $this->setSource($this->className());

        /**
         * Relationships.
         */
        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\Follower',
            'user_id',
            'follower_id',
            'App\Models\User',
            'id',
            ['alias' => 'Followers']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\Follower',
            'follower_id',
            'user_id',
            'App\Models\User',
            'id',
            ['alias' => 'Following']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\Appear',
            'user_id',
            'photo_id',
            'App\Models\Photo',
            'id',
            ['alias' => 'Photos']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\Follow',
            'user_id',
            'local_id',
            'App\Models\Local',
            'id',
            ['alias' => 'LocalsFollowed']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\Attend',
            'user_id',
            'event_id',
            'App\Models\Event',
            'id',
            ['alias' => 'Events']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\Belong',
            'user_id',
            'guestList_id',
            'App\Models\GuestList',
            'id',
            ['alias' => 'GuestLists']
        );

        $this->belongsTo(
            'rrpp_id',
            'App\Models\RRPP',
            'id',
            [
                'alias' => 'RRPPprofile',
                'foreignKey' => [
                    'allowNulls' => true,
                    'message'    => 'The rrpp_id does not exist on the RRPP model'
                ]
            ]
        );

        $this->hasMany('id', 'App\Models\Profile', 'user_id', ['alias' => 'Profiles']);
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
                    'message'   => 'The user name is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'surname',
                    'message'   => 'The user surname is required'
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => 'email',
                    'message'   => 'The user email must be unique'
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'email',
                    'message'   => 'The user email is required'
                ]
            )
        );
        $this->validate(
            new Email(
                [
                    'field'     => 'email',
                    'message'   => 'The user email must be valid'
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'profile_picture',
                    'message'   => 'The user profile picture is requires'
                ]
            )
        );
        $this->validate(
            new Url(
                [
                    'field'     => 'profile_picture',
                    'message'   => 'The user profile picture must be valid'
                ]
            )
        );
        $this->validate(
            new InclusionIn(
                [
                    'field'     => 'gender',
                    'message'   => 'The user gender must be H or M',
                    'domain'    => ['H', 'M', '']
                ]
            )
        );
        $this->validate(
            new DateValidator(
                [
                    'field'     => 'date_birth',
                    'message'   => 'The user date of birth must be valid'
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => 'rrpp_id',
                    'message'   => 'The user rrpp_id must be unique'
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
