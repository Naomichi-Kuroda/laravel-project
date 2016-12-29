<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Support\Facades\Request;

class AddressController extends Controller
{
    public function search()
    {
        $keyword = Request::get('keyword');

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
