<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Models\User;
use Phalcon\Http\Response;
use App\Exceptions\ResourceNotFoundException;

/**
 * @SWG\Tag(
 *   name="user",
 *   description="Everything about users",
 * )
 */
class UsersController extends BaseController
{
    /**
     *  @SWG\Get(
     *      path="/users",
     *      summary="Return all users paginated",
     *      tags={"user"},
     *      description="Returns paginated users in the database .",
     *      operationId="indexUsers",
     *      @SWG\Parameter(
     *          name="page",
     *          in="query",
     *          description="Pagination page required. First page if not present.",
     *          required=false,
     *          type="string",
     *          @SWG\Items(type="string"),
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Successful operation",
     *          @SWG\Schema(ref="#/definitions/User"),
     *          examples={
     *              "application/json": {
     *                  "items"={@SWG\Schema(ref="#/definitions/User")},
     *                  "first"="1",
     *                  "before"="1",
     *                  "current"="2",
     *                  "last"="5",
     *                  "next"="2",
     *                  "total_pages"="5",
     *                  "total_items"="48",
     *                  "limit"="10"
     *              }
     *          },
     *      ),
     *      @SWG\Response(
     *          response="401",
     *          description="Not authorized",
     *      ),
     *  )
     */
    public function index()
    {
        return $this->paginate();
    }

    /**
     *  @SWG\Post(
     *      path="/users",
     *      tags={"user"},
     *      summary="Create user",
     *      description="This can only be done by the API itself.",
     *      operationId="createUser",
     *      consumes={"multipart/form-data"},
     *      @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          description="User object to be created",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Response(
     *          response=201,
     *          description="Successfully created",
     *          @SWG\Schema(ref="#/definitions/User"),
     *          examples={
     *              "application/json": {
     *                  "status"="OK",
     *                  "data"=@SWG\Schema(ref="#/definitions/User"),
     *              }
     *          },
     *      ),
     *      @SWG\Response(
     *          response=409,
     *          description="Conflict (validation failed). Contains validation messages as an array where the
                   fields are the keys and validation messages the values.",
     *          @SWG\Schema(ref="#/definitions/ErrorResponse"),
     *      ),
     *      @SWG\Response(
     *          response="401",
     *          description="Not authorized",
     *          @SWG\Schema(ref="#/definitions/ErrorResponse"),
     *      ),
     *  )
     */
    public function create()
    {
        $request = $this->request;
        $user = new User();
        $user->assign(
            [
                'name'              => $request->get('name', 'string'),
                'surname'           => $request->get('surname', 'string'),
                'email'             => $request->get('email', 'email'),
                'profile_picture'   => $request->get('profile_picture', 'string'),
                'date_birth'        => $request->get('date_birth', 'string'),
                'gender'            => $request->get('gender', 'string'),
                'location'          => $request->get('location', 'string'),
                'rrpp_id'           => $request->get('rrpp_id', 'int'),
            ]
        );

        return $this->response($user);
    }

    /**
     *  @SWG\Put(
     *      path="/users/{id}",
     *      tags={"user"},
     *      summary="Update user",
     *      description="Field by field update can be done.",
     *      operationId="updateUser",
     *      @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          description="User ID to be updated",
     *          required=true,
     *          type="string",
     *      ),
     *      @SWG\Parameter(
     *          in="body",
     *          name="body",
     *          description="User fields to be updated. The rest will remain the same",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Successfully updated",
     *          @SWG\Schema(ref="#/definitions/User"),
     *          examples={
     *              "application/json": {
     *                  "status"="OK",
     *                  "data"=@SWG\Schema(ref="#/definitions/User"),
     *              }
     *          },
     *      ),
     *      @SWG\Response(
     *          response=409,
     *          description="Conflict (validation failed). Contains validation messages as an array where the
                    fields are the keys and validation messages the values.",
     *          @SWG\Schema(ref="#/definitions/ErrorResponse"),
     *      ),
     *      @SWG\Response(
     *          response="401",
     *          description="Not authorized",
     *          @SWG\Schema(ref="#/definitions/ErrorResponse"),
     *      ),
     *  )
     */
    public function update($id)
    {
        $id = $this->filter->sanitize($id, 'int');
        try {
            $request = $this->request;
            $user = User::findFirstOrFail(['id = ?0', 'bind' => [$id]]);

            $user->assign(
                [
                    'id'                => $id,
                    'name'              => $request->getPut('name', 'string', $user->name),
                    'surname'           => $request->getPut('surname', 'string', $user->surname),
                    'email'             => $request->getPut('email', 'email', $user->email),
                    'profile_picture'   => $request->getPut('profile_picture', 'string', $user->profile_picture),
                    'date_birth'        => $request->getPut('date_birth', 'string', $user->date_birth),
                    'gender'            => $request->getPut('gender', 'string', $user->gender),
                    'location'          => $request->getPut('location', 'string', $user->location),
                ]
            );

            return $this->response($user);
        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }

    /**
     *  @SWG\Delete(
     *      path="/users/{id}",
     *      tags={"user"},
     *      summary="Deletes an user",
     *      description="Deletes an user given the id.",
     *      operationId="updateUser",
     *      @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          description="User ID to be deleted",
     *          required=true,
     *          type="string",
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Successfully deleted",
     *          @SWG\Schema(ref="#/definitions/SuccessResponse"),
     *          examples={
     *              "application/json": {
     *                  "status"="OK"
     *              }
     *          },
     *      ),
     *      @SWG\Response(
     *          response="401",
     *          description="Not authorized",
     *          @SWG\Schema(ref="#/definitions/ErrorResponse"),
     *      ),
     *  )
     */
    public function delete($id)
    {
        $id = $this->filter->sanitize($id, 'int');
        try {
            $user = User::findFirstOrFail(['id = ?0', 'bind' => [$id]]);

            return $this->response($user);
        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }
}
