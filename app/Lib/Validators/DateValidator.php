<?php


namespace App\Lib\Validators;

use Phalcon\Mvc\Model\Validator;
use Phalcon\Mvc\Model\ValidatorInterface;
use Phalcon\Mvc\EntityInterface;

class DateValidator extends Validator implements ValidatorInterface
{
    public function validate(EntityInterface $model)
    {
        $field = $this->getOption('field');
        $message = $this->getOption('message');
        $validationMessage = (empty($message)) ? 'The field doesn\'t have a valid date (Y-m-d)' : $message;

        $value = $model->$field;

        try {
            $test_arr = explode('-', $value);

            if (!checkdate($test_arr[1], $test_arr[2], $test_arr[1])) {
                $this->appendMessage(
                    $validationMessage,
                    $field,
                    end(explode('\\', __CLASS__))
                );

                return false;
            }

            return true;
        } catch (\Exception $e) {
            $this->appendMessage(
                $validationMessage,
                $field,
                end(explode('\\', __CLASS__))
            );

            return false;
        }
    }
}
