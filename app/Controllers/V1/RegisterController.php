<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Exceptions\Facebook\FbCallbackException;
use App\Exceptions\Facebook\InvalidFbUser;
use App\Models\Profile;
use App\Models\User;
use Phalcon\Http\Response;

class RegisterController extends BaseController
{
    /**
     * Returns the URL that drives the user to the authorize page.
     *
     * @return Response
     */
    public function getAuthFacebook()
    {
        $state = $this->security->getToken();
        $permissions = [];

        return new Response($this->facebook->getAuthUrl($state, $permissions));
    }

    public function facebookCallback()
    {
        try {
            $state = $this->security->getToken();
            $code = $this->request->getQuery('code');
            $error = $this->request->getQuery('error');

            if (!empty($error)) {
                if ($error === 'access_denied') {
                    throw new FbCallbackException('FB authorization error: '.$error);
                } else {
                    throw new FbCallbackException('FB authorization error: '.$error);
                }
            }

            if (empty($code)) {
                throw new FbCallbackException('Ups, something went wrong during authorization');
            }

            $facebook_response = $this->facebook->getAccessToken($code, $state);
            $access_token = $facebook_response->access_token;
            $uid = $this->facebook->getUid($access_token);
            $profile = Profile::findFirst(['uid = ?0', 'bind' => [$uid]]);

            if (empty($profile)) { // No user, let's register it
                // TODO: encrypt access_token
                // TODO: Change default facebook avatar by ours
                // TODO: if user doesn't provide us with email we can't register it
                // TODO: facebook date format can vary
                $me = $this->facebook->me($access_token);

                // Create user
                $user = new User();
                $user = $user->assignFromFacebook($me);

                if ($user->save()) {
                    // Create profile and assign to the user
                    $profile = new Profile();
                    $profile->createFromFacebook($me->id, $access_token, $user->id);

                    return new Response(json_encode($user));
                } else {
                    throw new InvalidFbUser($user);
                }
            } else { // User already registered, update access_token
                $profile->save(['access_token' => $access_token]);
                $user = $profile->getUser();

                return new Response(json_encode($user->toArray()));
            }
        } catch (FbCallbackException $e) {
            return $e->returnResponse();
        } catch (InvalidFbUser $e) {
            return $e->returnResponse();
        } catch (\Exception $e) {
            return new Response($e->getMessage(), 409);
        }
    }
}
