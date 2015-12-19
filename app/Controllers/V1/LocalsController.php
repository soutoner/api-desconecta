<?php

namespace App\Controllers\V1;

use App\Controllers\ControllerBase;
use App\Models\Local;
use Phalcon\Http\Response;
use App\Exceptions\ResourceNotFoundException;

class LocalsController extends ControllerBase
{
    /**
     * Returns all the events in the database.
     */
    public function index()
    {
        return $this->paginate();
    }

    /**
     * Creates a local in the database.
     *
     * @return Response
     */
    public function create()
    {
        $request = $this->request;

        $local = new Local();
        $local->assign(
            [
            'name'              => $request->get('name', 'string'),
            'desc'              => $request->get('desc', 'string'),
            'photo_cover'       => $request->get('photo_cover', 'string'),
            'geo'               => $request->get('geo', 'string'),
            'adress'            => $request->get('adress', 'string'),
            ]
        );

        return $this->response($request, $local, true);
    }

    /**
     * Updates a local. Always use `x-www-form-urlencoded` content type for PUT.
     *
     * @param  $id - Id of the event to be updated
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function update($id)
    {
        try {

            $request = $this->request;

            $local = Local::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            $local->assign(
                [
                'id'                => $id,
                'name'              => $request->getPut('name', 'string', $local->name),
                'desc'              => $request->getPut('desc', 'string', $local->desc),
                'photo_cover'       => $request->getPut('photo_cover', 'string', $local->photo_cover),
                'geo'               => $request->getPut('geo', 'string', $local->geo),
                'adress'            => $request->getPut('adress', 'string', $local->adress),
                ]
            );

            return $this->response($request, $local, true);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }

    /**
     * Deletes a local from the database.
     *
     * @param  $id - Id of the local to be deleted
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function delete($id)
    {
        try {

            $local = Local::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            return $this->response($this->request, $local);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }
}
