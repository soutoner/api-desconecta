<?php


namespace App\Controllers\V1\OAuth;

use App\Controllers\BaseController;
use OAuth2\Request;
use App\Http\Response;

/**
 * @SWG\Tag(
 *   name="oauth",
 *   description="Everything about OAuth access tokens",
 * )
 */
class OAuthController extends BaseController
{
    /**
     *  @SWG\Post(
     *      path="/oauth/token",
     *      tags={"oauth"},
     *      summary="Request for a valid access token",
     *      description="Given client_id and client_secret a valid access token is issued.",
     *      operationId="getToken",
     *      consumes={"application/x-www-form-urlencoded"},
     *      @SWG\Parameter(
     *          in="formData",
     *          name="grant_type",
     *          description="Type of grant wanted.",
     *          required=true,
     *          type="string",
     *          enum={"client_credentials"},
     *      ),
     *      @SWG\Parameter(
     *          in="formData",
     *          name="client_id",
     *          description="A valid client_id.",
     *          required=true,
     *          type="string",
     *      ),
     *      @SWG\Parameter(
     *          in="formData",
     *          name="client_secret",
     *          description="A valid client_secret.",
     *          required=true,
     *          type="string",
     *      ),
     *      @SWG\Parameter(
     *          in="formData",
     *          name="scope",
     *          description="List of scopes separated by comma.",
     *          required=false,
     *          type="string",
     *      ),
     *      @SWG\Parameter(
     *          in="formData",
     *          name="state",
     *          description="String parameter to check if there is no man in the middle.",
     *          required=false,
     *          type="string",
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Successfully created",
     *          @SWG\Schema(),
     *          examples={
     *              "application/json": {
     *                  "access_token": "a63097c58497b42bf2793e1f7851fe10ae7cff18",
     *                  "expires_in": 3600,
     *                  "token_type": "Bearer",
     *                  "scope": null
     *              }
     *          },
     *      ),
     *      @SWG\Response(
     *          response=400,
     *          description="Bad request. Some parameter is missing.",
     *      ),
     *  )
     */
    public function getToken()
    {
        // TODO: return same access token if not expired
        $request = Request::createFromGlobals();
        // Handle a request for an OAuth2.0 Access Token and send the response to the client
        return Response::responseFromOAuth($this->oauth->handleTokenRequest($request));
    }
}
