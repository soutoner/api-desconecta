<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;

class HashTag extends BaseModel
{
    public $value;

    public $created_at;

    public $updated_at;

    public function initialize()
    {
        parent::initialize();

        /**
         * Table name.
         */
        $this->setSource('HashTag');
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
                    'field'     => 'HashTag',
                    'message'   => 'A hashtag is required'
                ]
            )
        );
        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    public static function findFirstOrFail($parameters=null, $resource_id='HashTag')
    {
        return parent::findFirstOrFail($parameters, $resource_id);
    }
}
