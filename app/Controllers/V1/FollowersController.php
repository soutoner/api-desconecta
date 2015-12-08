<?php

namespace App\Controllers\V1;

use App\Controllers\ControllerBase;
use App\Models\User;
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

            $user = User::findFirst([
                'id = ?0', 'bind' => [$id]
            ]);

            if(empty($user))
                throw new ResourceNotFoundException();

            return new Response(json_encode($user->getFollowers()->toArray()));

        } catch (ResourceNotFoundException $e) {
            return $e->return_response();
        }
    }

    /**
     * Creates a follower of the given user.
     *
     * TODO: disallow self-following.
     *
     * @param $id
     * @return \App\Controllers\Phalcon\Http\Response
     */
    public function create($id)
    {
        try {
            $user = User::findFirst([
                'id = ?0', 'bind' => [$id]
            ]);

            if(empty($user))
                throw new ResourceNotFoundException('User not found');

            $follower = User::findFirst([
                'id = ?0', 'bind' => [$this->request->getPost('follower_id', 'int')]
            ]);

            if(empty($follower))
                throw new ResourceNotFoundException('Follower user not found');

            $user->followers = [$follower];

            $response = new Response();

            if($user->update()){
                $response->setStatusCode(201, 'Created');
                $response->setJsonContent(
                    array(
                        'status'    => 'OK',
                    )
                );
            } else {
                $response->setStatusCode(409, 'Conflict');
                $response->setJsonContent(
                    array(
                        'status'   => 'ERROR',
                        'messages' => 'Internal error while creating relationship'
                    )
                );
            }

            return $response;

        } catch (ResourceNotFoundException $e) {
            return $e->return_response();
        }
    }

    /**
     * Deletes a follower of the given user.
     *
     * TODO: disallow self-following.
     *
     * @param $id
     * @return \App\Controllers\Phalcon\Http\Response
     */
    public function delete($id)
    {
        try {
            $user = User::findFirst([
                'id = ?0', 'bind' => [$id]
            ]);

            if(empty($user))
                throw new ResourceNotFoundException('User not found');

            $follower = User::findFirst([
                'id = ?0', 'bind' => [$this->request->getPut('follower_id', 'int')]
            ]);

            if(empty($follower))
                throw new ResourceNotFoundException('Follower user not found');

            $user->followers->delete(function($f) use ($follower) {
                if($f->id === $follower->id)
                    return true;
            });

            $response = new Response();

            if($user->update()){
                $response->setStatusCode(201, 'Deleted');
                $response->setJsonContent(
                    array(
                        'status'    => 'OK',
                    )
                );
            } else {
                $response->setStatusCode(409, 'Conflict');
                $response->setJsonContent(
                    array(
                        'status'   => 'ERROR',
                        'messages' => 'Internal error while deleting relationship'
                    )
                );
            }

            return $response;

        } catch (ResourceNotFoundException $e) {
            return $e->return_response();
        }
    }
}

