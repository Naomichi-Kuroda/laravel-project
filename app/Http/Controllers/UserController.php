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
        $user->lastName = $request->input('lastName');
        $user->firstName = $request->input('firstName');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->userType = 'customer';
        $user->save();

        return response()->json(compact('user'));
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
