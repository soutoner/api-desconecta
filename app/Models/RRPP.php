<?php

namespace App\Models;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;

/**
 * @SWG\Definition(@SWG\Xml(name="RRPP"))
 */
class RRPP extends BaseModel
{
    /**
     * @SWG\Property(type="integer")
     * @var int
     */
    public $id;

    /**
     * @SWG\Property(type="boolean")
     * @var boolean
     */
    public $verified;

    public function initialize()
    {
        parent::initialize();

        $this->setSource($this->className());

        $this->hasOne('id', 'App\Models\User', 'rrpp_id', ['alias' => 'User']);

        $this->hasMany('id', 'App\Models\Local', 'owner_id', ['alias' => 'Locals']);
    }

    public function beforeCreate()
    {
        if (empty($this->verified)) {
            $this->verified = false;
        }
    }
}
