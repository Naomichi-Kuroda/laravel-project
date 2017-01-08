<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function indexClients()
    {
        $users = User::where('category', 'client')->get();

        $page = \Request::get('page', 1);
        $perPage = \Request::get('limit', 30);
        $offSet = ($page * $perPage) - $perPage;

        foreach ($users as $user) {
            $data[] = [
                'userId' => $user->id,
                'lastName' => $user->last_name,
                'firstName' => $user->first_name,
                'roleName' => $user->role->name,
                'status' => $user->status,
            ];
        }

        $data = array_slice($data, $offSet, $perPage, true);

        return response()->json(
            [
                'status' => [
                    'code' => 200,
                    'message' => 'API SUCCESS'
                ],
                'result' => [
                    'userList' => $data
                ]
            ]
        );
    }

    public function show($userId)
    {
        $user = User::find($userId);

        $data = [
            'userId' => $user->id,
            'lastName' => $user->last_name,
            'firstName' => $user->first_name,
            'email' => $user->email,
        ];

        return response()->json(
            [
                'status' => [
                    'code' => 200,
                    'message' => 'API SUCCESS'
                ],
                'result' => $data
            ]
        );
    }

    public function sendConfirmationMail($userId)
    {
        $user = User::find($userId);
        $user->status = 2;
        $user->save();

        $data = [];
        $data['email'] = $user->email;
        $data['subject'] = "【Laravel】アカウント確認メール";
        $msg = "アカウント確認メールです。\n
            http://localhost:8000/api/user/confirm/".$userId;
        Mail::raw($msg, function($message)use($data) {
            $message->to($data['email'])->subject($data['subject']);
        });

        return response()->json(
            [
                'status' => [
                    'code' => 200,
                    'message' => 'API SUCCESS'
                ],
            ]
        );
    }

    public function confirmAccount($userId)
    {
        $user = User::find($userId);
        $user->status = 3;
        $user->save();

        return redirect('http://localhost:4200/register-client/'.$userId);
    }


    public function store(Request $request)
    {
        $rules = [
            'lastName' => 'required',
            'firstName' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required',
            'phoneNumber' => 'required',
        ];
        $validator = Validator::make(\Request::all(), $rules);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => [
                        'code' => 301,
                        'message' => 'API SUCCESS'
                    ],
                    'result' => $validator->errors()
                ], 301
            );
        } else {
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
                ], 200
            );
        }
    }

    public function storeClient($userId, Request $request)
    {
        $user = User::find($userId);
        $user->last_name = $request->input('lastName');
        $user->first_name = $request->input('firstName');
        $user->password = bcrypt($request->input('password'));
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
