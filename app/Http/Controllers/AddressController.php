<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;

class AddressController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show($id)
    {
        //
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

    public function search()
    {
        $keyword = \Request::get('keyword');

        $data = Address::where('zip_code', $keyword)
            ->first();

        return response()->json(
            [
                'status' => [
                    'code' => 200,
                    'message' => 'API SUCCESS'
                ],
                'result' => [
                    'zipCode' => $data->zip_code,
                    'prefecture' => $data->prefecture,
                    'city' => $data->city,
                    'town' => $data->town,
                ]
            ]
        );
    }

}
