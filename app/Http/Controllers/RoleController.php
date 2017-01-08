<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

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
                'manage' => $role->manage,
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
}
