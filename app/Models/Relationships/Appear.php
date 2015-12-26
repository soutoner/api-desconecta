<?php


namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Behavior\Timestampable;

/**
 * @SWG\Definition(required={"user_id","photo_id"}, @SWG\Xml(name="Appear"))
 */
class Appear extends BaseModel
{
    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $user_id;

    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $photo_id;

    public function initialize()
    {
        $this->setSource('User_appears_Photo');

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
            'photo_id',
            'App\Models\Photo',
            'id',
            [
                'alias' => 'Photo',
                'foreignKey' => [
                    'message' => 'The photo_id does not exist on the Photo model',
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
                    'field'     => 'user_id',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'photo_id',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => ['user_id', 'photo_id'],
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
