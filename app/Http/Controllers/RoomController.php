<?php

namespace App\Http\Controllers;

use App\Resident;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function storeResident($roomId, Request $request)
    {
        $rules = array(
            'residentName' => 'required',
            'phoneNumber' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'limitDate' => 'required',
            'memo' => 'required',
        );
        $validator = Validator::make(\Request::all(), $rules);

        if ($validator->fails()) {
//            return Redirect::to('nerds/create')
//                ->withErrors($validator)
//                ->withInput(Input::except('password'));
        } else {
            $room = Room::find($roomId);
            $resident = new Resident();
            $resident->name = $request->input('residentName');
            $resident->phone_number = $request->input('phoneNumber');
            $resident->start_date = $request->input('startDate');
            $resident->end_date = $request->input('endDate');
            $resident->limit_date = $request->input('limitDate');
            $resident->memo = $request->input('memo');

            $room->residents()->save($resident);

            return response()->json(
                [
                    'status' => [
                        'code' => 200,
                        'message' => 'API SUCCESS'
                    ],
                    'result' => $room
                ]
            );
        }
    }
}
