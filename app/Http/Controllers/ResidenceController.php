<?php

namespace App\Http\Controllers;

use App\Residence;
use App\Room;
use App\Tower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResidenceController extends Controller
{
    public function store(Request $request)
    {
        $rules = array(
            'residenceName' => 'required',
            'address' => [
                'zipCode' => 'required',
                'prefecture' => 'required',
                'city' => 'required',
                'town' => 'required',
            ],
            'towerList' => [
                'towerName' => 'required',
                'roomList' => [
                    'roomName' =>  'required',
                ]
            ]
        );
        $validator = Validator::make(\Request::all(), $rules);

        if ($validator->fails()) {
//            return Redirect::to('nerds/create')
//                ->withErrors($validator)
//                ->withInput(Input::except('password'));
        } else {
            $residence = new Residence();
            $residence->name = $request->input('residenceName');
            $residence->zip_code = $request->input('address.zipCode');
            $residence->prefecture = $request->input('address.prefecture');
            $residence->city = $request->input('address.city');
            $residence->town = $request->input('address.town');
            $residence->save();
            foreach ($request->input('towerList') as $newTower) {
                $tower = new Tower();
                $tower->name = $newTower['towerName'];
                $residence->towers()->save($tower);
                foreach ($newTower['roomList'] as $newRoom) {
                    $room = new Room();
                    $room->name = $newRoom['roomName'];
                    $tower->rooms()->save($room);
                }
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

