<?php

namespace App\Controllers\V1;

use App\Controllers\ControllerBase;
use App\Models\Photo;
use Phalcon\Http\Response;
use App\Exceptions\ResourceNotFoundException;

class PhotosController extends ControllerBase
{
    /**
     * Returns all the photos in the database.
     */
    public function index()
    {
        $photos = Photo::find();

        return new Response(json_encode($photos->toArray()));
    }

    /**
     * Creates a photo in the database.
     *
     * @return Response
     */
    public function create()
    {
        $request = $this->request;

        $photo = new Photo();
        $photo->assign(
            [
            'uri'        => $request->get('uri', 'string'),
            'desc'       => $request->get('desc', 'string'),
            'event_id'   => $request->get('event_id', 'string'),
            ]
        );

        return $this->response($request, $photo, true);
    }

    /**
     * Updates a photo. Always use `x-www-form-urlencoded` content type for PUT.
     *
     * @param  $id - Id of the event to be updated
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function update($id)
    {
        try {

            $request = $this->request;

            $photo = Photo::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            $photo->assign(
                [
                'id'               => $id,
                'uri'              => $request->getPut('uri', 'string', $photo->uri),
                'desc'             => $request->getPut('desc', 'string', $photo->desc),
                'event_id'         => $request->getPut('event_id', 'string', $photo->event_id),
                ]
            );

            return $this->response($request, $photo, true);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }

    /**
     * Deletes a photo from the database.
     *
     * @param  $id - Id of the pack to be deleted
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function delete($id)
    {
        try {

            $photo = Photo::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            return $this->response($this->request, $photo);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }
}
