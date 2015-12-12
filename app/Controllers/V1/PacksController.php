<?php

namespace App\Controllers\V1;

use App\Controllers\ControllerBase;
use App\Models\HashTag;
use Phalcon\Http\Response;
use App\Exceptions\ResourceNotFoundException;

class HashTagsController extends ControllerBase
{
    /**
     * Returns all the hashtags in the database.
     *
     * TODO: Pagination
     */
    public function index()
    {
        $hashtags = HashTag::find();

        return new Response(json_encode($hashtags->toArray()));
    }

    /**
     * Creates a hashtag in the database.
     *
     * TODO: Create custom filters (e.g. filter for dates)
     *
     * @return Response
     */
    public function create()
    {
        $request = $this->request;

        $hashtag = new HashTag();
        $hashtag->assign([
            'value' => $request->get('value', 'string'),
        ]);

        return $this->response($request, $hashtag, true);
    }

}