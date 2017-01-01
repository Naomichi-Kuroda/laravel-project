<?php

namespace App\Http\Controllers;

use App\Resident;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function indexResidents($roomId)
    {
        $residents = Room::find($roomId)->residents;

        $page = \Request::get('page', 1);
        $perPage = \Request::get('limit', 30);
        $offSet = ($page * $perPage) - $perPage;

        foreach ($residents as $resident) {
            $data[] = [
                'residentId' => $resident->id,
                'residentName' => $resident->name,
                'phoneNumber' => $resident->phone_number,
                'startDate' => $resident->start_date,
                'endDate' => $resident->end_date,
                'limitDate' => $resident->limit_date,
                'memo' => $resident->memo,
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
                    'residentList' => $data
                ]
            ]
        );
    }

    public function show($roomId)
    {
        $room = Room::find($roomId);

        $data = [
            'residenceName' => $room->tower->residence->name,
            'towerName' => $room->tower->name,
            'roomName' => $room->name,
            'leaveApplySpan' => $room->leave_apply_span,
            'contractSpan' => $room->contract_span,
            'manageCode' => $room->manage_code,
            'memo' => $room->memo,
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

    public function update($roomId, Request $request)
    {
       $rules = [
           'roomName' => 'required',
           'leaveApplySpan' => 'required',
           'contractSpan' => 'required',
           'manageCode' => 'required',
           'memo' => 'required',
        ];
        $validator = Validator::make(\Request::all(), $rules);

        if ($validator->fails()) {
//            return Redirect::to('nerds/' . $id . '/edit')
//                ->withErrors($validator)
//                ->withInput(Input::except('password'));
        } else {
            $room = Room::find($roomId);
            $room->name = $request->input('roomName');
            $room->leave_apply_span = $request->input('leaveApplySpan');
            $room->contract_span = $request->input('contractSpan');
            $room->manage_code = $request->input('manageCode');
            $room->memo = $request->input('memo');
            $room->save();

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
                ]
            );
        }
    }

    public function destroy($roomId)
    {
        $room = Room::find($roomId);
        $room->delete();

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
