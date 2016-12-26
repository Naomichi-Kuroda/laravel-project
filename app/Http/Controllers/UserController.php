<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->last_name = $request->input('lastName');
        $user->first_name = $request->input('firstName');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->user_type = 'customer';
        $user->save();

        return response()->json(
            [
                'status' => [
                    'code' => 200,
                    'message' => 'API SUCCESS'
                ],
                'result' => [
                    'lastName' => $user->last_lame,
                    'firstName' => $user->first_lame,
                    'email' => $user->email,
                    'password' => $user->password,
                    'userType' => $user->user_type,
                ]
            ]
        );
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
