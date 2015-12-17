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

        $this->setSource($this->class_name());

        $this->belongsTo('user_id', 'App\Models\User', 'id', [
                'alias' => 'User',
                'foreignKey' => [
                    'message' => 'The user_id does not exist on the User model'
                ],
            ]
        );

        $this->belongsTo('provider_id', 'App\Models\Provider', 'id', [
                'alias' => 'Provider',
                'foreignKey' => [
                    'message' => 'The provider_id does not exist on the Provider model'
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
            new PresenceOf([
                    'field'     => 'uid',
                    'message'   => 'The uid is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'access_token',
                    'message'   => 'An access_token is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'user_id',
                    'message'   => 'The user_id is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'provider_id',
                    'message'   => 'The provider_id is required'
                ]
            )
        );
        $this->validate(
            new Uniqueness([
                    'field'     => ['user_id', 'provider_id'],
                    'message'   => 'The (user_id-provider_id) must be unique'
                ]
            )
        );

        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
