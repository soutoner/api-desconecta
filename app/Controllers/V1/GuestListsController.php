<?php


namespace App\Controllers\V1;

use App\Controllers\ControllerBase;
use App\Models\GuestList;
use Phalcon\Http\Response;
use App\Exceptions\ResourceNotFoundException;

class GuestListsController extends ControllerBase
{
    /**
     * Returns all the lists in the database.
     *
     * TODO: Pagination
     */
    public function index()
    {
        $lists = GuestList::find();

        return new Response(json_encode($lists->toArray()));
    }

    /**
     * Creates a list in the database.
     *
     * TODO: Create custom filters (e.g. filter for dates)
     *
     * @return Response
     */
    public function create()
    {
        $request = $this->request;

        $list = new GuestList();
        $list->assign([
            'start_time'        => $request->get('start_time', 'string'),
            'end_time'          => $request->get('end_time', 'string'),
            'max_friends'       => $request->get('max_friends', 'string'),
            'max_capacity'      => $request->get('max_capacity', 'string'),
        ]);

        return $this->response($request, $list, true);
    }

    /**
     * Updates a list. Always use `x-www-form-urlencoded` content type for PUT.
     *
     * @param $id - Id of the event to be deleted
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function update($id)
    {
        try {

            $request = $this->request;

            $list = GuestList::findFirstOrFail([
                'id = ?0', 'bind' => [$id]
            ]);

            $list->assign([
                'id'                 => $id,
                'start_time'         => $request->getPut('start_time', 'string', $list->start_time),
                'end_time'           => $request->getPut('end_time', 'string', $list->end_time),
                'max_friends'        => $request->getPut('max_friends', 'string', $list->max_friends),
                'max_capacity'       => $request->getPut('max_capacity', 'string', $list->max_capacity),
            ]);

            return $this->response($request, $list, true);

        } catch (ResourceNotFoundException $e) {
            return $e->return_response();
        }
    }

    /**
     * Deletes a list from the database.
     *
     * @param $id - Id of the list to be deleted
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function delete($id)
    {
        try {

            $list = GuestList::findFirstOrFail([
                'id = ?0', 'bind' => [$id]
            ]);

            return $this->response($this->request, $list);

        } catch (ResourceNotFoundException $e) {
            return $e->return_response();
        }
    }
}