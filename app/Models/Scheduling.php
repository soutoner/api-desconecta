<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;

class Scheduling extends BaseModel
{
    public $id;

    public $end_period;

    public $period_id;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->class_name());

        $this->belongsTo('period_id', 'App\Models\Period', 'id',
            [
                'alias' => 'Period',
                'foreignKey' => [
                    'message'    => 'The period_id does not exist on the Period model'
                ]
            ]
        );

        $this->hasOne('id', 'App\Models\Event', 'scheduling_id', ['alias' => 'Event']);
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
                    'field'     => 'period_id',
                    'message'   => 'A period_id is required',
                ]
            )
        );
        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }

    }
}