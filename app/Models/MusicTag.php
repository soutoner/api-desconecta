<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class MusicTag extends BaseModel
{
    public $id;

    public $value;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->className());

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\EventHasMusicTag',
            'musicTag_id',
            'event_id',
            'App\Models\Event',
            'id',
            ['alias' => 'Events']
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
                    'field'     => 'value',
                ]
            )
        );
        $this->validate(
            new Uniqueness(
                [
                    'field'     => 'value',
                ]
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
