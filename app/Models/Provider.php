<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

/**
 * @SWG\Definition(required={"name"}, @SWG\Xml(name="Provider"))
 */
class Provider extends BaseModel
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
    public $name;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->className());

        $this->hasMany('id', 'App\Models\Profile', 'provider_id', ['alias' => 'Profiles']);
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
                    'field'     => 'name',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => 'name',
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
