<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
     /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $inputs = $request->validated();

        $inputs['password'] = bcrypt($inputs['password']);

        $user = User::create($inputs);

        $api_token =  $user->createToken('')->plainTextToken;

        return $this->sendResponse(compact('user', 'api_token'),
                                    'User registered successfully.');

    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return response()->json(['errors' => ['general' => ['Invalid credentials!']]], 401);
        }

        $user = auth()->user();

        $api_token = $user->createToken('')->plainTextToken;

        return $this->sendResponse(compact('user', 'api_token'),
        'User logged in successfully.');
    }
}
