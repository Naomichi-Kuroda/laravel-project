<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthenticateController extends Controller
{

    /**
     * constructor
     */
    public function __construct(){
        $this->middleware('jwt.auth', ['except' => 'auth']);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $loginUser = JWTAuth::parseToken()->toUser();
        return response()->json(
            [
                'status' => [
                    'code' => 200,
                    'message' => 'API SUCCESS'
                ],
                'result' => [
                    'userId' => $loginUser->id,
                    'lastName' => $loginUser->last_name,
                    'firstName' => $loginUser->first_name,
                    'email' => $loginUser->email,
                    'phoneNumber' => $loginUser->phone_number,
                ]
            ]
        );
    }

    /**
     * Authenticate from email and password
     */
    public function auth(Request $request){
        //
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(
                    [
                        'error' => 'invalid credentials'
                    ], 401
                );
            }
        } catch (JWTException $e) {
            return response()->json(
                [
                    'error' => 'could not create token'
                ], 500
            );
        }

        return response()->json(
            [
                'status' => [
                    'code' => 200,
                    'message' => 'API SUCCESS'
                ],
                'result' => $token
            ], 200
        );
    }

}
