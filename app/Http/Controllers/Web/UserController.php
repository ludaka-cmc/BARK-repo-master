<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Helpers\GigyaHelper;
use AKCBark\Helpers\JWTTokenHelper;
use AKCBark\Services\Auth\AuthService;
use AKCBark\Helpers\AuthTokenHelper;
use AKCBark\Services\Layer\LayerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use DB;

class UserController extends Controller
{
    /**
     * Login
     *
     * @param Request      $request
     * @param AuthService  $authService
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function login(Request $request, AuthService $authService) {
        try {
            DB::beginTransaction();
            $post = $request->input();

            if (!$request->input('validSignature', false)) {
                if (!$valid_signature = GigyaHelper::validateUserSignature(
                    $post['UID'],
                    $post['signatureTimestamp'],
                    $post['UIDSignature'])
                ) {
                    return response()->json([
                        'success' => false,
                        'error_code' => $this->errorHelper->getErrorCode(
                            'invalid_user_signature',
                            get_class($this))
                    ], 401);
                }
            }

            if (!isset($post['provider']) || $post['provider'] == '') {
                $post['provider'] = null;
            }

            $gigya_uid = $post['UID'];
            $gigya_provider = (!isset($post['provider']) || $post['provider'] == '')
                ? null :
                $post['provider'];
            $email_user = isset($post['profile']) && isset($post['profile']['email'])
                ? $post['profile']['email']
                : null;
            $gigya_user = $authService->updateOrCreateGigyaUserByGigyaInfoLogin(
                $gigya_uid,
                $gigya_provider,
                $email_user
            );
            $user = $gigya_user->user;
            $post['user_id'] = $user->id;
            // $user->last_login = new \DateTime();
            $user->getGigyaData();

            auth()->login($user);
            DB::commit();

            $token = $user->createToken('token')->accessToken;

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user
            ]);
        } catch(Exception $e) {
            DB::rollBack();
            Log::error("Web/UsersController@login: {$e->getMessage()}");

            return response()->json([
                'success' => false,
                'error_code' => $this->errorHelper->getErrorCode(
                    $e->getMessage(),
                    get_class($this))
            ], 400);
        }
    }

    public function verifyToken() {
        $this->user = AuthTokenHelper::getUser();

        $user_id = ($this->user)
            ? $this->user->id
            : null;

        return response()->json([
            'verified' => !empty($this->user),
            'data' => ['user_id' => $user_id]
        ], 200);
    }

    protected function revokeUserTokens($user_id = null) {
        if (!empty($user_id)) {
            return AuthTokenHelper::revokeUserTokens($user_id);
        }

        $user = AuthTokenHelper::getUser();

        if ($user && $user->id) {
            return AuthTokenHelper::revokeUserTokens($user->id);
        }
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {
        try {
            $user_id = null;

            if ($auth_user = Auth::user()) {
                $user_id = $auth_user->id;
            }

            $this->revokeUserTokens($user_id);

            if (auth()->check()) {

                $before_user = null;
                if (session("isSuperUser")) {
                    $before_user = session("beforeUser");
                }

                session()->flush();
                auth()->logout();
                session()->flush();

                if ($before_user) {
                    auth()->login(User::find($before_user));
                }

                return redirect('/');
            }
        } catch (\Exception $e) {
            Log::error("Web/UserController@logout: {$e->getMessage()}");

            return response()->json(['success' => false], 500);
        }

        return redirect('/');
    }

    public function createSessionSuperAdmin() {

    }

    public function getResetPass(Request $request) {

    }

    public function postResetPass(Request $request) {

    }

    /**
     * Create a user on Gigya
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function signUp(Request $request) {
        $response = GigyaHelper::createUser(
            $request->first_name,
            $request->last_name,
            $request->email,
            $request->password
        );

        $response->validSignature = true;

        $responseToArray = $response->getData()->serialize();

        if (
            $response->getErrorCode() !== 0
            && isset($responseToArray['validationErrors'])
            && isset($responseToArray['validationErrors'][0])
        ) {
            $message = ucfirst($responseToArray['validationErrors'][0]['message']);
            return response()->json(['success' => false, 'message' => $message], 422);
        }

        return response()->json(array_merge(['success' => true], $responseToArray), 200);
    }
}
