<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;

class Scheduling extends BaseModel
{
    public $id;

    public $end_period;

    public $period_type_id;

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
        // TODO: length of fields
        $this->validate(
            new PresenceOf([
                    'field'     => 'end_period',
                    'message'   => 'A icon is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'period_type_id',
                    'message'   => 'A period type is required',
                ]
            )
        );
        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }

    }
}