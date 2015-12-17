<?php


namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class Follow extends BaseModel
{
    public $user_id;

    public $local_id;

    public function initialize()
    {
        $this->setSource('User_follows_Local');

        $this->belongsTo('user_id', 'App\Models\User', 'id', [
                'alias' => 'User',
                'foreignKey' => [
                    'message' => 'The user_id does not exist on the User model'
                ],
            ]
        );
        $this->belongsTo('local_id', 'App\Models\Local', 'id', [
                'alias' => 'Local',
                'foreignKey' => [
                    'message' => 'The local_id does not exist on the Local model'
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
                    'field'     => 'user_id',
                    'message'   => 'The user_id is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'local_id',
                    'message'   => 'The local_id is required'
                ]
            )
        );
        $this->validate(
            new Uniqueness([
                    'field'     => ['user_id', 'local_id'],
                    'message'   => 'The user_id and local_id combination must be unique'
                ]
            )
        );

        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}