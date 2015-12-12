<?php

namespace App\Controllers\V1;

use App\Controllers\ControllerBase;
use App\Models\Pack;
use Phalcon\Http\Response;
use App\Exceptions\ResourceNotFoundException;

class PacksController extends ControllerBase
{
    /**
     * Returns all the packs in the database.
     *
     * TODO: Pagination
     */
    public function index()
    {
        $Packs = Pack::find();

        return new Response(json_encode($Packs->toArray()));
    }

    /**
     * Creates a pack in the database.
     *
     * TODO: Create custom filters (e.g. filter for dates)
     *
     * @return Response
     */
    public function create()
    {
        $request = $this->request;

        $pack = new Pack();
        $pack->assign([
            'price' => $request->get('price', 'string'),
        ]);

        return $this->response($request, $pack, true);
    }

    /**
     * Updates a pack. Always use `x-www-form-urlencoded` content type for PUT.
     *
     * @param $id - Id of the event to be updated
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function update($id)
    {
        try {

            $request = $this->request;

            $pack = Local::findFirstOrFail([
                'id = ?0', 'bind' => [$id]
            ]);

            $pack->assign([
                'id'                => $id,
                'price'             => $request->getPut('price', 'string', $pack->price),
            ]);

            return $this->response($request, $pack, true);

        } catch (ResourceNotFoundException $e) {
            return $e->return_response();
        }
    }

    /**
     * Deletes a pack from the database.
     *
     * @param $id - Id of the pack to be deleted
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function delete($id)
    {
        try {

            $pack = Pack::findFirstOrFail([
                'id = ?0', 'bind' => [$id]
            ]);

            return $this->response($this->request, $pack);

        } catch (ResourceNotFoundException $e) {
            return $e->return_response();
        }
    }
}