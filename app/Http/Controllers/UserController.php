<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $user->phone_number = $request->input('phoneNumber');
        $user->category = 'customer';
        $user->status = 1;
        $user->save();

        return response()->json(
            [
                'status' => [
                    'code' => 200,
                    'message' => 'API SUCCESS'
                ],
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

    public function update($userId, Request $request)
    {
        $rules = [
            'lastName' => 'required',
            'firstName' => 'required',
            'email' => 'required',
            'phoneNumber' => 'required',
        ];
        $validator = Validator::make(\Request::all(), $rules);

        if ($validator->fails()) {
//            return Redirect::to('nerds/' . $id . '/edit')
//                ->withErrors($validator)
//                ->withInput(Input::except('password'));
        } else {
            $user = User::find($userId);
            $user->last_name = $request->input('lastName');
            $user->first_name = $request->input('firstName');
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phoneNumber');
            $user->save();

            return response()->json(
                [
                    'status' => [
                        'code' => 200,
                        'message' => 'API SUCCESS'
                    ],
                ]
            );
        }
    }

    public function updatePassword($userId, Request $request)
    {
        $rules = [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmNewPassword' => 'required',
        ];
        $validator = Validator::make(\Request::all(), $rules);

        if ($validator->fails()) {
//            return Redirect::to('nerds/' . $id . '/edit')
//                ->withErrors($validator)
//                ->withInput(Input::except('password'));
        } else {
            $user = User::find($userId);
            $user->password = bcrypt($request->input('newPassword'));
            $user->save();

            return response()->json(
                [
                    'status' => [
                        'code' => 200,
                        'message' => 'API SUCCESS'
                    ],
                ]
            );
        }
    }

    public function destroy($id)
    {
        //
    }

}
