<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Models\Event;
use App\Http\Response;
use App\Exceptions\ResourceNotFoundException;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class EventsController extends BaseController
{
    /**
     * Returns all the events in the database.
     */
    public function index()
    {
        return $this->paginate();
    }

    /**
     * Creates an event in the database.
     *
     * @return Response
     */
    public function create()
    {
        $request = $this->request;

        $event = new Event();
        $event->assign(
            [
            'name'              => $request->get('name', 'string'),
            'desc'              => $request->get('desc', 'string'),
            'photo_cover'       => $request->get('photo_cover', 'url'),
            'start_date'        => $request->get('start_date', 'timestamp'),
            'end_date'          => $request->get('end_date', 'timestamp'),
            'flyer'             => $request->get('flyer', 'url'),
            ]
        );

        return $this->response($request, $event, true);
    }

    /**
     * Updates an event. Always use `x-www-form-urlencoded` content type for PUT.
     *
     * @param  $id - Id of the event to be deleted
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function update($id)
    {
        $id = $this->filter->sanitize($id, 'int');

        try {

            $request = $this->request;

            $event = Event::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            $event->assign(
                [
                'id'                => $id,
                'name'              => $request->getPut('name', 'string', $event->name),
                'desc'              => $request->getPut('desc', 'string', $event->desc),
                'photo_cover'       => $request->getPut('photo_cover', 'url', $event->photo_cover),
                'start_date'        => $request->getPut('start_date', 'timestamp', $event->start_date),
                'end_date'          => $request->getPut('end_date', 'timestamp', $event->end_date),
                'flyer'             => $request->getPut('flyer', 'url', $event->flyer),
                ]
            );

            return $this->response($request, $event, true);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }

    /**
     * Deletes an event from the database.
     *
     * @param  $id - Id of the events to be deleted
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function delete($id)
    {
        $id = $this->filter->sanitize($id, 'int');

        try {

            $event = Event::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            return $this->response($this->request, $event);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }
}
