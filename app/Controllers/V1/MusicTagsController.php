<?php

namespace App\Controllers\V1;

use App\Controllers\ControllerBase;
use App\Models\MusicTag;
use Phalcon\Http\Response;

class MusicTagsController extends ControllerBase
{
    /**
     * Returns all the Musictags in the database.
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

        $musictag = new MusicTag();
        $musictag->assign(
            [
            'value' => $request->get('value', 'string'),
            ]
        );

        return $this->response($request, $musictag, true);
    }
}
