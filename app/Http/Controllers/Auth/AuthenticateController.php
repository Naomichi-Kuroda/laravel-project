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
        $this->middleware('jwt.auth', ['except' => ['showSignIn', 'auth']]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // ログイン中のユーザー取得
        $loginUser = JWTAuth::parseToken()->toUser();
        return response()->json(['user' => $loginUser]);
    }

    /**
     * Authenticate from email and password
     */
    public function auth(Request $request){
        //
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could not create token'], 500);
        }

        return response()->json(compact('token'));
    }

}
