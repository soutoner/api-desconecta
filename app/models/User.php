<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\InclusionIn;

class User extends  Model
{
    /**
     * Sets database table name of the model.
     * @return string
     */
    public function getSource()
    {
        return "User";
    }

    public function validation()
    {
        // User name must be unique
        $this->validate(
            new Uniqueness(
                array(
                    "field"   => "email",
                    "message" => "The user email must be unique"
                )
            )
        );

        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}