<?php

namespace App\Http\Controllers;

use App\Residence;
use App\Tower;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TowerController extends Controller
{
    public function index()
    {
        $towers = Tower::all();

        $page = \Request::get('page', 1);
        $perPage = \Request::get('limit', 30);
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

    public function indexRooms($towerId)
    {
        $rooms = Tower::find($towerId)->rooms;

        $page = \Request::get('page', 1);
        $perPage = \Request::get('limit', 30);
        $offSet = ($page * $perPage) - $perPage;

        foreach ($rooms as $room) {
            if(!is_null($room->residents()->first())) {
                $data[] = [
                    'roomId' => $room->id,
                    'roomName' => $room->name,
                    'residentName' => $room->residents()->first()->name,
                ];
            } else {
                $data[] = [
                    'roomId' => $room->id,
                    'roomName' => $room->name,
                    'residentName' => '',
                ];
            }
        }

        $data = array_slice($data, $offSet, $perPage, true);

        return response()->json(
            [
                'status' => [
                    'code' => 200,
                    'message' => 'API SUCCESS'
                ],
                'result' => [
                    'roomList' => $data
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

    public function update($towerId, Request $request)
    {
        $rules = [
            'residenceName' => 'required',
            'towerName' => 'required',
            'address' => [
                'zipCode' => 'required',
                'prefecture' => 'required',
                'city' => 'required',
                'town' => 'required',
            ],
            'memo' => 'required',
        ];
        $validator = Validator::make(\Request::all(), $rules);

        if ($validator->fails()) {
//            return Redirect::to('nerds/' . $id . '/edit')
//                ->withErrors($validator)
//                ->withInput(Input::except('password'));
        } else {
            $tower = Tower::find($towerId);
            $tower->residence->name = $request->input('residenceName');
            $tower->name = $request->input('towerName');
            $tower->residence->zip_code = $request->input('address.zipCode');
            $tower->residence->prefecture = $request->input('address.prefecture');
            $tower->residence->city = $request->input('address.city');
            $tower->residence->town = $request->input('address.town');
            $tower->memo = $request->input('memo');
            $tower->save();
            $tower->residence->save();

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

    public function destroy($towerId)
    {
        $tower = Tower::find($towerId);
        $tower->delete();

        return response()->json(
            [
                'status' => [
                    'code' => 200,
                    'message' => 'API SUCCESS'
                ],
            ]
        );
    }

    public function storeRooms($towerId, Request $request)
    {
        $rules = array(
            'roomList' => [
                'roomName' => 'required',
            ]
        );
        $validator = Validator::make(\Request::all(), $rules);

        if ($validator->fails()) {
//            return Redirect::to('nerds/create')
//                ->withErrors($validator)
//                ->withInput(Input::except('password'));
        } else {
            $tower = Tower::find($towerId);
            foreach ($request->input('roomList') as $newRoom) {
                $room = new Room();
                $room->name = $newRoom['roomName'];
                $tower->rooms()->save($room);
            }

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
}

