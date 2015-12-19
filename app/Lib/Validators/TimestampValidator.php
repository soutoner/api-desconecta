<?php


namespace App\Lib\Validators;

use Phalcon\Mvc\Model\Validator;
use Phalcon\Mvc\Model\ValidatorInterface;
use Phalcon\Mvc\EntityInterface;

class TimestampValidator extends Validator implements ValidatorInterface
{
    public function validate(EntityInterface $model)
    {
        $field = $this->getOption('field');
        $message = $this->getOption('message');
        $validationMessage = (empty($message)) ? 'The field doesn\'t have a valid timestamp Y-m-d hh:mm:ss (24h)' : $message;

        $value = $model->$field;

        try {
            $test_arr = explode(' ', $value);
            $test_date = explode('-', $test_arr[0]);
            $valid_date = checkdate($test_date[1], $test_date[2], $test_date[1]);
            $valid_timestamp = preg_match("/^([1-2][0-3]|[01]?[1-9]):([0-5]?[0-9]):([0-5][0-9])$/", $test_arr[1]);

            if (!$valid_date || !$valid_timestamp) {
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
