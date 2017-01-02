<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();

        $page = \Request::get('page', 1);
        $perPage = \Request::get('limit', 30);
        $offSet = ($page * $perPage) - $perPage;

        foreach ($companies as $company) {
            $data[] = [
                'companyId' => $company->id,
                'companyName' => $company->name,
                'prefecture' => $company->prefecture,
                'city' => $company->city,
                'town' => $company->town,
                'phoneNumber' => $company->phone_number,
                'registDate' => $company->created_at->format('Y年m月d日'),
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
                    'companyList' => $data
                ]
            ]
        );
    }

    public function store(Request $request)
    {
        $rules = array(
            'companyName' => 'required',
            'address' => [
                'zipCode' => 'required',
                'prefecture' => 'required',
                'city' => 'required',
                'town' => 'required',
            ],
            'phoneNumber' => 'required',
            'memo' => 'required',
        );
        $validator = Validator::make(\Request::all(), $rules);

        if ($validator->fails()) {
//            return Redirect::to('nerds/create')
//                ->withErrors($validator)
//                ->withInput(Input::except('password'));
        } else {
            $company = new Company();
            $company->name = $request->input('companyName');
            $company->zip_code = $request->input('address.zipCode');
            $company->prefecture = $request->input('address.prefecture');
            $company->city = $request->input('address.city');
            $company->town = $request->input('address.town');
            $company->phone_number = $request->input('phoneNumber');
            $company->memo = $request->input('memo');
            $company->save();

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
