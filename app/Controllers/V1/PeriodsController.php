<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Models\Period;
use App\Http\Response;
use App\Exceptions\ResourceNotFoundException;

class PeriodsController extends BaseController
{
    /**
     * Returns all the period in the database.
     */
    public function index()
    {
        return $this->paginate();
    }
}
