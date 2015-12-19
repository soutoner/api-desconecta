<?php

namespace App\Controllers\V1;

use App\Controllers\ControllerBase;
use App\Models\Period;
use Phalcon\Http\Response;
use App\Exceptions\ResourceNotFoundException;

class PeriodsController extends ControllerBase
{
    /**
     * Returns all the period in the database.
     */
    public function index()
    {
        $periods = Period::find();

        return new Response(json_encode($periods->toArray()));
    }

}