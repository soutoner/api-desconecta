<?php

namespace App\Models;

use App\Lib\Validators\TimestampValidator;
use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;

/**
 * @SWG\Definition(required={"end_period","period_id"}, @SWG\Xml(name="Scheduling"))
 */
class Scheduling extends BaseModel
{
    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $id;

    /**
     * @SWG\Property(type="string",format="date-time")
     */
    public $end_period;

    /**
     * @SWG\Property(type="integer")
     * @var int
     */
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
                ]
            )
        );
        $this->validate(
            new TimestampValidator(
                [
                    'field'     => 'end_period',
                ]
            )
        );
        $this->validate(
            new PresenceOf(
                [
                    'field'     => 'period_id',
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
