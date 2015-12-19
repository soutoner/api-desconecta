<?php

namespace App\Controllers\V1;

use App\Controllers\ControllerBase;
use Phalcon\Http\Response;

class RegisterController extends ControllerBase
{
    public function getAuthFacebook()
    {
        return new Response($this->facebook->getAuthUrl());
    }

    public function facebookCallback()
    {
        return new Response($this->facebook->getAccessToken($this->request->getQuery('code')));
    }
}
