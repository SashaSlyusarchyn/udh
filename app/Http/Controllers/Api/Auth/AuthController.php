<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\ProcessingException;
use App\Http\Requests\Api\User\UserLoginPostRequest;
use App\Http\Requests\Api\User\UserRegisterPostRequest;
use App\Http\Resources\User\UserResource;
use App\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class AuthController extends Controller
{
    /**
     * Authorization with Email and Password
     *
     * @param UserLoginPostRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ProcessingException
     */
    public function login(UserLoginPostRequest $request) {
        try {
            if (auth()->attempt($request->only(['email', 'password']))) {
                $user = tap(auth()->user(), function ($user) {
                    $user->roles;
                    $user->organization;
                });

                $token = JWTAuth::fromUser($user);
                $this->data['user'] = new UserResource($user);
                $this->data['jwt'] = [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ];
                return response()->json($this->makeResponse(), 200);
            }
            $errors = [
                [
                    'code' => 1,
                    'target' => 'password',
                    'message' => 'Password is incorrect'
                ]
            ];
            throw new ProcessingException(1, 'Validation error', $errors, 200);
        } catch (\Exception $exception) {
            throw new ProcessingException(2, 'User error', [], 200);
        }
    }

    /**
     * Registration with Email and Password
     *
     * @param UserRegisterPostRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ProcessingException
     */
    public function register(UserRegisterPostRequest $request) {
        try {
            $organizations = Organization::find($request->organizations_id);
            $user = $organizations->users()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $token = JWTAuth::fromUser($user);

            $this->data['user'] = new UserResource($user);
            $this->data['jwt'] = [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ];
            return response()->json($this->makeResponse(), 200);
        } catch (\Exception $exception) {
            throw new ProcessingException(5, 'Registration error', [], 200);
        }
    }

    /**
     * Refresh JWT token
     * Required header:
     *
     * Authorization: Bearer [token]
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ProcessingException
     */
    public function refresh(Request $request) {
        try {
            $newToken = $request->get('newToken');
            $this->data['jwt'] = [
                'access_token' => $newToken,
                'token_type' => 'Bearer',
            ];
            return response()->json($this->makeResponse(), 200);
        } catch (\Exception $exception) {
            throw new ProcessingException(6, 'JWT refresh error', [], 200);
        }
    }
}
