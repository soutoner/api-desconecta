<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\Email;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\InclusionIn;

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
        $this->setSource($this->class_name());

        /**
         * Relationships.
         */
        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\Follower',
            'user_id', 'follower_id',
            'App\Models\User',
            'id',
            ['alias' => 'Followers']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\Follower',
            'follower_id', 'user_id',
            'App\Models\User',
            'id',
            ['alias' => 'Following']
        );

        $this->belongsTo('rrpp_id', 'App\Models\RRPP', 'id',
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
        // TODO: length of fields
        $this->validate(
            new PresenceOf([
                    'field'     => 'name',
                    'message'   => 'The name is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'surname',
                    'message'   => 'The surname is required'
                ]
            )
        );
        $this->validate(
            new Uniqueness([
                    'field'     => 'email',
                    'message'   => 'The user email must be unique'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'email',
                    'message'   => 'The email is required'
                ]
            )
        );
        $this->validate(
            new Email([
                    'field'     => 'email',
                    'message'   => 'You must provide a valid email'
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
        // TODO: valid date of birth
        $this->validate(
            new InclusionIn([
                    'field'     => 'gender',
                    'message'   => 'The gender must be H or M',
                    'domain'    => ['H', 'M', '']
                ]
            )
        );
        $this->validate(
            new Uniqueness([
                    'field'     => 'rrpp_id',
                    'message'   => 'The user rrpp_id must be unique'
                ]
            )
        );

        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}