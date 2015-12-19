<?php

namespace App\Controllers\V1;

use App\Controllers\ControllerBase;
use App\Models\User;
use App\Models\Relationships\Follower;
use App\Exceptions\ResourceNotFoundException;
use Phalcon\Http\Response;

class FollowersController extends ControllerBase
{
    /**
     * Returns followers of the given user.
     *
     * @param $id
     * @return \App\Controllers\Phalcon\Http\Response
     */
    public function index($id)
    {
        try {

            $user = User::findFirstOrFail([
                'id = ?0', 'bind' => [$id]
            ]);

            return new Response(json_encode($user->getFollowers()->toArray()));

        } catch (ResourceNotFoundException $e) {
            return $e->return_response();
        }
    }

    /**
     * Creates a follower of the given user.
     *
     * @param $id
     * @return \App\Controllers\Phalcon\Http\Response
     */
    public function create($id)
    {
        try {
            $user = User::findFirstOrFail([
                'id = ?0', 'bind' => [$id]
            ]);

            $follower = User::findFirstOrFail([
                'id = ?0', 'bind' => [$this->request->get('follower_id', 'int')]
            ], 'Follower User');

            $relationship = new Follower();
            $relationship->assign([
                'user_id'       => $user->id,
                'follower_id'   => $follower->id
            ]);

            return $this->response($this->request, $relationship);

        } catch (ResourceNotFoundException $e) {
            return $e->return_response();
        }
    }

    /**
     * Deletes a follower of the given user.
     *
     * @param $id
     * @return \App\Controllers\Phalcon\Http\Response
     */
    public function delete($id)
    {
        try {
            $user = User::findFirstOrFail([
                'id = ?0', 'bind' => [$id]
            ]);
            $follower = User::findFirstOrFail([
                'id = ?0', 'bind' => [$this->request->get('follower_id', 'int')]
            ], 'Follower User');
            $relationship = Follower::findFirstOrFail([
                'user_id'       => $user->id,
                'follower_id'   => $follower->id,
            ]);

            return $this->response($this->request, $relationship);

        } catch (ResourceNotFoundException $e) {
            return $e->return_response();
        }
    }
}

