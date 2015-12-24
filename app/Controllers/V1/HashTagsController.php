<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Models\HashTag;
use Phalcon\Http\Response;
use App\Exceptions\ResourceNotFoundException;

class HashTagsController extends BaseController
{
    /**
     * Returns all the hashtags in the database.
     */
    public function index()
    {
        return $this->paginate();
    }

    /**
     * Creates a hashtag in the database.
     *
     * @return Response
     */
    public function create()
    {
        $request = $this->request;

        $hashtag = new HashTag();
        $hashtag->assign(
            [
            'value' => $request->get('value', 'string'),
            ]
        );

        return $this->response($request, $hashtag, true);
    }
}
