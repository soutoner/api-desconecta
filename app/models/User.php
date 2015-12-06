<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\Email;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\InclusionIn;
use Phalcon\Mvc\Model\Behavior\Timestampable;


class User extends Model
{
    public $name;

    public $surname;

    public $email;

    public $profile_picture;

    public $date_birth;

    public $gender;

    public $location;

    protected $created_at;

    protected $updated_at;

    public function initialize()
    {
        $this->setSource("User");

        $this->addBehavior(
            new Timestampable(
                array(
                    'beforeCreate' => array(
                        'field'  => 'created_at',
                        'format' => 'Y-m-d H:i:sP'
                    )
                )
            )
        );

        $this->addBehavior(
            new Timestampable(
                array(
                    'beforeUpdate' => array(
                        'field'  => 'updated_at',
                        'format' => 'Y-m-d H:i:sP'
                    )
                )
            )
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
        // TODO: length of fields
        $this->validate(
            new PresenceOf([
                    'field'     => 'name',
                    'message'   => 'The name is required'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'surname',
                    'message'   => 'The surname is required'
                ]
            )
        );
        $this->validate(
            new Uniqueness([
                    'field'     => 'email',
                    'message'   => 'The user email must be unique'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'email',
                    'message'   => 'The email is required'
                ]
            )
        );
        $this->validate(
            new Email([
                    'field'     => 'email',
                    'message'   => 'You must provide a valid email'
                ]
            )
        );
        $this->validate(
            new PresenceOf([
                    'field'     => 'profile_picture',
                    'message'   => 'The profile picture is required'
                ]
            )
        );
        // TODO: valid date of birth
        $this->validate(
            new InclusionIn([
                    'field'     => 'gender',
                    'message'   => 'The gender must be H or M',
                    'domain'    => ['H', 'M', '']
                ]
            )
        );

        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}