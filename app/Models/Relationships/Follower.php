<?php


namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class Follower extends BaseModel
{
    public $user_id;

    public $follower_id;

    public function initialize()
    {
        $this->setSource('User_follows_User');

        $this->belongsTo(
            'user_id', 'App\Models\User', 'id', [
                'alias' => 'User',
                'foreignKey' => [
                    'message' => 'The part_id does not exist on the Parts model'
                ],
            ]
        );
        $this->belongsTo(
            'follower_id', 'App\Models\User', 'id', [
                'alias' => 'Follower',
                'foreignKey' => [
                    'message' => 'The part_id does not exist on the Parts model'
                ],
            ]
        );

        $this->addBehavior(
            new Timestampable(
                array(
                    'beforeCreate' => array(
                        'field'  => 'created_at',
                        'format' => 'Y-m-d H:i:sP'
                    )
                )
            )
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
                    'field'     => 'follower_id',
                    'message'   => 'The follower_id is required'
                ]
            )
        );
        $this->validate(
            new Uniqueness([
                    'field'     => ['user_id', 'follower_id'],
                    'message'   => 'The user_id and follower_id combination must be unique'
                ]
            )
        );

        if($this->user_id === $this->follower_id) {
            return false;
        }

        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}