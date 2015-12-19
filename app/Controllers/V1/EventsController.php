<?php

namespace App\Controllers\V1;

use App\Controllers\ControllerBase;
use App\Models\Event;
use Phalcon\Http\Response;
use App\Exceptions\ResourceNotFoundException;

class EventsController extends ControllerBase
{
    /**
     * Returns all the events in the database.
     *
     * TODO: Pagination
     */
    public function index()
    {
        $events = Event::find();

        return new Response(json_encode($events->toArray()));
    }

    /**
     * Creates an event in the database.
     *
     * TODO: Create custom filters (e.g. filter for dates)
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
            'photo_cover'       => $request->get('photo_cover', 'string'),
            'start_date'        => $request->get('start_date', 'string'),
            'end_date'          => $request->get('end_date', 'string'),
            'flyer'             => $request->get('flyer', 'string'),
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
                'photo_cover'       => $request->getPut('photo_cover', 'string', $event->photo_cover),
                'start_date'        => $request->getPut('start_date', 'string', $event->start_date),
                'end_date'          => $request->getPut('end_date', 'string', $event->end_date),
                'flyer'             => $request->getPut('flyer', 'string', $event->flyer),
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
