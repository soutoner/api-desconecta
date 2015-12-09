<?php

namespace App\Controllers\V1;

use App\Controllers\ControllerBase;
use App\Models\MusicTag;
use Phalcon\Http\Response;

class MusicTagsController extends ControllerBase
{
    /**
     * Returns all the Musictags in the database.
     *
     * TODO: Pagination
     */
    public function index()
    {
        $musictags = MusicTag::find();

        return new Response(json_encode($musictags->toArray()));
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

        $musictag = new MusicTag();
        $musictag->assign([
            'value' => $request->get('value', 'string'),
        ]);

        return $this->response($request, $musictag, true);
    }

}