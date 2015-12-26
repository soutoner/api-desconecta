<?php


namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Behavior\Timestampable;

/**
 * @SWG\Definition(required={"photo_id","hashTag_id"}, @SWG\Xml(name="PhotoHasHashTag"))
 */
class PhotoHasHashTag extends BaseModel
{
    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $photo_id;

    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $hashTag_id;

    public function initialize()
    {
        $this->setSource('Photo_has_HashTag');

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
        $this->belongsTo(
            'hashTag_id',
            'App\Models\HashTag',
            'id',
            [
                'alias' => 'HashTag',
                'foreignKey' => [
                    'message' => 'The hashTag_id does not exist on the HashTag model',
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
                    'field'     => 'photo_id',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'hashTag_id',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => ['photo_id', 'hashTag_id'],
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
