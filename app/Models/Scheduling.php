<?php

namespace App\Models;

use App\Lib\Validators\TimestampValidator;
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

        $this->setSource($this->className());

        $this->belongsTo(
            'period_id',
            'App\Models\Period',
            'id',
            ['alias' => 'Period',
                'foreignKey' => [
                    'message'    => 'The period_id does not exist on the Period model',
                ],
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
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'end_period',
                    'message'   => 'The scheduling end_period is required',
                ]
            )
        );
        $this->validate(
            new TimestampValidator(
                [
                    'field'     => 'end_period',
                    'message'   => 'The scheduling end_period must be validd',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'period_id',
                    'message'   => 'The scheduling period_id is required',
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
