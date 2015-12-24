<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Profile extends BaseModel
{
    public $id;

    public $uid;

    public $access_token;

    public $user_id;

    public $provider_id;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->className());

        $this->belongsTo(
            'user_id',
            'App\Models\User',
            'id',
            [
                'alias' => 'User',
                'foreignKey' => [
                    'message' => 'The user_id does not exist on the User model',
                ],
            ]
        );

        $this->belongsTo(
            'provider_id',
            'App\Models\Provider',
            'id',
            [
                'alias' => 'Provider',
                'foreignKey' => [
                    'message' => 'The provider_id does not exist on the Provider model',
                ],
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
            new PresenceOf(
                [
                    'field'     => 'uid',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'access_token',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'user_id',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'provider_id',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => ['user_id', 'provider_id'],
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Create Facebook profile with the given data.
     *
     * @param  $id
     * @param  $access_token
     * @param  $user_id
     * @return bool
     */
    public function createFromFacebook($id, $access_token, $user_id)
    {
        return $this->create(
            [
            'uid'           => $id,
            'access_token'  => $access_token,
            'user_id'       => $user_id,
            'provider_id'   => Provider::findFirst("name = 'facebook'")->id,
            ]
        );
    }
}
