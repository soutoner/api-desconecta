<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Models\Pack;
use App\Http\Response;
use App\Exceptions\ResourceNotFoundException;

class PacksController extends BaseController
{
    /**
     * Returns all the packs in the database.
     */
    public function index()
    {
        return $this->paginate();
    }

    /**
     * Creates a pack in the database.
     *
     * @return Response
     */
    public function create()
    {
        $request = $this->request;

        $pack = new Pack();
        $pack->assign(
            [
            'price' => $request->get('price', 'string'),
            ]
        );

        return $this->response($request, $pack, true);
    }

    /**
     * Updates a pack. Always use `x-www-form-urlencoded` content type for PUT.
     *
     * @param  $id - Id of the event to be updated
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function update($id)
    {
        $id = $this->filter->sanitize($id, 'int');

        try {

            $request = $this->request;

            $pack = Pack::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            $pack->assign(
                [
                'id'                => $id,
                'price'             => $request->getPut('price', 'string', $pack->price),
                ]
            );

            return $this->response($request, $pack, true);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }

    /**
     * Deletes a pack from the database.
     *
     * @param  $id - Id of the pack to be deleted
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function delete($id)
    {
        $id = $this->filter->sanitize($id, 'int');

        try {

            $pack = Pack::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            return $this->response($this->request, $pack);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }
}
