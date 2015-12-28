<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Models\User;
use App\Models\Relationships\Follower;
use App\Exceptions\ResourceNotFoundException;
use App\Http\Response;

/**
 * @SWG\Tag(
 *   name="follower",
 *   description="Everything about user to user followship",
 * )
 */
class FollowersController extends BaseController
{
    /**
     *  @SWG\Get(
     *      path="/followers/{id}",
     *      summary="Return all followers of the given users paginated",
     *      tags={"follower"},
     *      description="Returns paginated followers of given user in the database .",
     *      operationId="indexFollowers",
     *      @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          description="User ID whom followers we want",
     *          required=true,
     *          type="integer",
     *      ),
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
    public function index($id)
    {
        $id = $this->filter->sanitize($id, 'int');

        try {

            $user = User::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            return $this->paginate($user->getFollowers());

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }

    /**
     *  @SWG\Post(
     *      path="/followers/{id}",
     *      tags={"follower"},
     *      summary="Creates followers relationship",
     *      description="This can only be done by the API itself.",
     *      operationId="createFollowerRel",
     *      consumes={"application/x-www-form-urlencoded"},
     *      @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          description="User ID whom follower we want to create",
     *          required=true,
     *          type="integer",
     *      ),
     *      @SWG\Parameter(
     *          in="formData",
     *          name="follower_id",
     *          description="Follower id",
     *          required=true,
     *          type="integer",
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
    public function create($id)
    {
        $id = $this->filter->sanitize($id, 'int');

        try {
            $user = User::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            $follower = User::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$this->request->get('follower_id', 'int')]
                ],
                'Follower User'
            );

            $relationship = new Follower();
            $relationship->assign(
                [
                'user_id'       => $user->id,
                'follower_id'   => $follower->id
                ]
            );

            return $this->response($relationship);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }

    /**
     *  @SWG\Delete(
     *      path="/followers/{id}",
     *      tags={"follower"},
     *      summary="Deletes an follower relationship",
     *      description="Deletes an follower relationship given the follower_id.",
     *      operationId="deleteFollowers",
     *      @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          description="User ID whom follower is going to be deleted",
     *          required=true,
     *          type="integer",
     *      ),
     *      @SWG\Parameter(
     *          in="formData",
     *          name="follower_id",
     *          description="Follower id",
     *          required=true,
     *          type="integer",
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
            $user = User::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );
            $follower = User::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$this->request->get('follower_id', 'int')]
                ],
                'Follower User'
            );
            $relationship = Follower::findFirstOrFail(
                [
                'user_id'       => $user->id,
                'follower_id'   => $follower->id,
                ]
            );

            return $this->response($relationship);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }
}
