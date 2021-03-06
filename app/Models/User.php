<?php

namespace App\Models;

use App\Exceptions\Facebook\FbCallbackException;
use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\Email;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\InclusionIn;
use Phalcon\Mvc\Model\Validator\Url;
use App\Lib\Validators\DateValidator;

/**
 * @SWG\Definition(required={"name","surname","email","profile_picture"}, @SWG\Xml(name="User"))
 */
class User extends BaseModel
{
    /**
     * @SWG\Property(type="integer")
     */
    public $id;

    /**
     * @SWG\Property(type="string")
     */
    public $name;

    /**
     * @SWG\Property(type="string")
     */
    public $surname;

    /**
     * @SWG\Property(type="string")
     */
    public $email;

    /**
     * @SWG\Property(type="string")
     */
    public $profile_picture;

    /**
     * @SWG\Property(type="date")
     */
    public $date_birth;

    /**
     * @SWG\Property(type="string",enum={"male","female"})
     */
    public $gender;

    /**
     * @SWG\Property(type="string")
     */
    public $location;

    /**
     * @SWG\Property(type="integer")
     */
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
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'surname',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => 'email',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'email',
                ]
            )
        );
        $this->validate(
            new Email(
                [
                    'field'     => 'email',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'profile_picture',
                ]
            )
        );
        $this->validate(
            new Url(
                [
                    'field'     => 'profile_picture',
                ]
            )
        );
        $this->validate(
            new InclusionIn(
                [
                    'field'     => 'gender',
                    'domain'    => ['male', 'female', '']
                ]
            )
        );
        $this->validate(
            new DateValidator(
                [
                    'field'     => 'date_birth',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => 'rrpp_id',
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Assigns User variables to the given ones of Facebook.
     *
     * @param  $me
     * @return \Phalcon\Mvc\Model
     * @throws FbCallbackException
     */
    public function assignFromFacebook($me)
    {
        if (empty($me->email)) {
            throw new FbCallbackException('User is not providing email.');
        }

        return $this->assign(
            [
                'name'              => $me->first_name,
                'surname'           => $me->last_name,
                'email'             => $me->email,
                'profile_picture'   => 'http://graph.facebook.com/'.$me->id.'/picture?type=large',
                'date_birth'        => date('Y-m-d', strtotime($me->birthday)),
                'gender'            => $me->gender,
                'from'              => $me->location->name,
            ]
        );
    }
}
