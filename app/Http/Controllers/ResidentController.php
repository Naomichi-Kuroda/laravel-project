<?php

namespace App\Http\Controllers;

use App\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResidentController extends Controller
{
    public function update($residentId, Request $request)
    {
        $rules = [
            'residentName' => 'required',
            'phoneNumber' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'limitDate' => 'required',
            'memo' => 'required',
        ];
        $validator = Validator::make(\Request::all(), $rules);

        if ($validator->fails()) {
//            return Redirect::to('nerds/' . $id . '/edit')
//                ->withErrors($validator)
//                ->withInput(Input::except('password'));
        } else {
            $resident = Resident::find($residentId);
            $resident->name = $request->input('residentName');
            $resident->phone_number = $request->input('phoneNumber');
            $resident->start_date = $request->input('startDate');
            $resident->end_date = $request->input('endDate');
            $resident->limit_date = $request->input('limitDate');
            $resident->memo = $request->input('memo');
            $resident->save();

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

    public function destroy($residentId)
    {
        $resident = Resident::find($residentId);
        $resident->delete();

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
