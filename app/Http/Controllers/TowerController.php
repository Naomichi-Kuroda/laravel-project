<?php

namespace App\Http\Controllers;

use App\Tower;
use Illuminate\Support\Facades\Request;

class TowerController extends Controller
{
    public function index()
    {
        $towers = Tower::all();

        $page = Request::get('page', 1);
        $perPage = Request::get('limit', 30);
        $offSet = ($page * $perPage) - $perPage;

        foreach ($towers as $tower) {
            $data[] = [
                'towerId' => $tower->id,
                'residenceName' => $tower->residence->name,
                'towerName' => $tower->name,
                'prefecture' => $tower->residence->prefecture,
                'city' => $tower->residence->city,
                'town' => $tower->residence->town,
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
                    'towerList' => $data
                ]
            ]
        );
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show($towerId)
    {
        $tower = Tower::find($towerId);

        $data = [
            'residenceName' => $tower->residence->name,
            'towerName' => $tower->name,
            'address' => [
                'zipCode' => $tower->residence->zip_code,
                'prefecture' => $tower->residence->prefecture,
                'city' => $tower->residence->city,
                'town' => $tower->residence->town,
                ],
            'memo' => $tower->memo,
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
