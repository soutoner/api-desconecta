<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Period extends BaseModel
{
    public $id;

    public $type;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->className());

        $this->hasMany('id', 'App\Models\Scheduling', 'period_id', ['alias' => 'Schedulings']);
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
                'field'     => 'type',
                'message'   => 'A type is required'
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                'field'     => 'type',
                'message'   => 'The type must be unique'
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
