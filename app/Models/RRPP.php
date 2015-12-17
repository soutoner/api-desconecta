<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;

class RRPP extends BaseModel
{
    public $id;

    public $verified;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->class_name());

        $this->hasOne('id', 'App\Models\User', 'rrpp_id', ['alias' => 'User']);
    }

    public function beforeCreate()
    {
        if(empty($this->verified)){
            $this->verified = false;
        }
    }
}
