<?php

namespace support;

trait UseMiddleware
{
    public function _before()
    {
        putenv('USE_MIDDLEWARE=true');
    }
}