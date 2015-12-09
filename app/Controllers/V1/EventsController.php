<?php

namespace App\Controllers\V1;

use App\Controllers\ControllerBase;
use App\Models\Event;
use App\Models\User;
use Phalcon\Http\Response;
use App\Exceptions\ResourceNotFoundException;

class EventController extends ControllerBase
{
    /**
     * Returns all the users in the database.
     *
     * TODO: Pagination
     */
    public function index()
    {
        $events = Event::find();

        return new Response(json_encode($events->toArray()));
    }

    /**
     * Creates an user in the database.
     *
     * TODO: Create custom filters (e.g. filter for dates)
     *
     * @return Response
     */
    public function create()
    {
        $request = $this->request;

        $user = new User();
        $user->assign([
            'name'              => $request->get('name', 'string'),
            'surname'           => $request->get('surname', 'string'),
            'email'             => $request->get('email', 'email'),
            'profile_picture'   => $request->get('profile_picture', 'string'),
            'date_birth'        => $request->get('date_birth', 'string'),
            'gender'            => $request->get('gender', 'string'),
            'location'          => $request->get('location', 'string'),
        ]);

        return $this->response($request, $user, true);
    }

    /**
     * Updates an user. Always use `x-www-form-urlencoded` content type for PUT.
     *
     * @param $id - Id of the user to be deleted
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function update($id)
    {
        try {

            $request = $this->request;

            $user = User::findFirstOrFail([
                'id = ?0', 'bind' => [$id]
            ]);

            $user->assign([
                'id'                => $id,
                'name'              => $request->getPut('name', 'string', $user->name),
                'surname'           => $request->getPut('surname', 'string', $user->surname),
                'email'             => $request->getPut('email', 'email', $user->email),
                'profile_picture'   => $request->getPut('profile_picture', 'string', $user->profile_picture),
                'date_birth'        => $request->getPut('date_birth', 'string', $user->date_birth),
                'gender'            => $request->getPut('gender', 'string', $user->gender),
                'location'          => $request->getPut('location', 'string', $user->location),
            ]);

            return $this->response($request, $user, true);

        } catch (ResourceNotFoundException $e) {
            return $e->return_response();
        }
    }

    /**
     * Deletes an user from the database.
     *
     * @param $id - Id of the user to be deleted
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function delete($id)
    {
        try {

            $user = User::findFirstOrFail([
                'id = ?0', 'bind' => [$id]
            ]);

            return $this->response($this->request, $user);

        } catch (ResourceNotFoundException $e) {
            return $e->return_response();
        }
    }
}
