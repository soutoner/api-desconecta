<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

/**
 * @SWG\Definition(required={"type"}, @SWG\Xml(name="Period"))
 */
class Period extends BaseModel
{
    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $id;

    /**
     * @SWG\Property(type="string")
     * @var string
     */
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
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => 'type',
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
