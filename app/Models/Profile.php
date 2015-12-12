<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;

class Profile extends BaseModel
{
    public $id;

    public $uid;

    public $access_token;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->class_name());
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

        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
