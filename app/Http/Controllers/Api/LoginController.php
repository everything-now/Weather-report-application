<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     ** path="/api/login",
     *   tags={"auth"},
     *   summary="Login",
     *   operationId="login",
     *
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthorised"
     *   ),
     *)
     **/
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorised',
                'errors' => [
                    'data' => [
                        'Wrong credentials'
                    ]
                ]
            ], 401);
        }

        $token = auth()->user()->createToken(config('app.name'));
        $token->accessToken->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken->token,
        ], 200);
    }

    /**
     * @OA\Post(
     ** path="/api/register",
     *   tags={"auth"},
     *   summary="Register",
     *   operationId="register",
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=422,
     *      description="Unprocessable entity"
     *   ),
     *)
     **/
    public function register(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['password'] = app('hash')->make($credentials['password']);
        $user = User::create($credentials);
        $token =  $user->createToken('authToken');
        $token->accessToken->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken->token,
        ], 201);
    }
}
