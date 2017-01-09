<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        $page = \Request::get('page', 1);
        $perPage = \Request::get('limit', 30);
        $offSet = ($page * $perPage) - $perPage;

        foreach ($roles as $role) {
            $data[] = [
                'roleId' => $role->id,
                'roleName' => $role->name,
                'manage' => json_decode($role->manage),
                'content' => json_decode($role->content),
                'residence' => json_decode($role->residence),
                'memo' => $role->memo,
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
                    'roleList' => $data
                ]
            ]
        );
    }

    public function show($roleId)
    {
        $role = Role::find($roleId);

        $data = [
            'roleName' => $role->name,
            'manage' => json_decode($role->manage),
            'content' => json_decode($role->content),
            'residence' => json_decode($role->residence),
            'memo' => $role->memo,
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

    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->input('roleName');
        $role->manage = json_encode($request->input('manage'));
        $role->content = json_encode($request->input('content'));
        $role->residence = json_encode($request->input('residence'));
        $role->memo = $request->input('memo');
        $role->save();

        return response()->json(
            [
                'status' => [
                    'code' => 200,
                    'message' => 'API SUCCESS'
                ],
            ]
        );
    }

    public function update($roleId, Request $request)
    {
        $rules = [
            'roleName' => 'required',
            'memo' => 'required',
        ];
        $validator = Validator::make(\Request::all(), $rules);

        if ($validator->fails()) {
//            return Redirect::to('nerds/' . $id . '/edit')
//                ->withErrors($validator)
//                ->withInput(Input::except('password'));
        } else {
            $role = Role::find($roleId);
            $role->name = $request->input('roleName');
            $role->manage = json_encode($request->input('manage'));
            $role->content = json_encode($request->input('content'));
            $role->residence = json_encode($request->input('residence'));
            $role->memo = $request->input('memo');
            $role->save();

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

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();

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
