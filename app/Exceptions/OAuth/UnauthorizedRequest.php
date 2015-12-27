<?php

namespace App\Exceptions\OAuth;

class UnauthorizedRequest extends \Exception
{
    public function __construct($message = 'Unauthorized Request', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
