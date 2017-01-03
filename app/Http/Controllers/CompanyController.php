<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
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

    public function indexUsers($companyId)
    {
        $users = Company::find($companyId)->users;

        $page = \Request::get('page', 1);
        $perPage = \Request::get('limit', 30);
        $offSet = ($page * $perPage) - $perPage;

        foreach ($users as $user) {
            $data[] = [
                'userId' => $user->id,
                'lastName' => $user->last_name,
                'firstName' => $user->first_name,
                'email' => $user->email,
                'status' => $user->status
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
                    'userList' => $data
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
                    'result' => [
                        'companyId' => $company->id,
                    ]
                ]
            );
        }
    }

    public function storeUsers($companyId, Request $request)
    {
        $rules = array(
            'userList' => [
                'lastName' => 'required',
                'firstName' => 'required',
                'email' => 'required',
            ]
        );
        $validator = Validator::make(\Request::all(), $rules);

        if ($validator->fails()) {
//            return Redirect::to('nerds/create')
//                ->withErrors($validator)
//                ->withInput(Input::except('password'));
        } else {
            $company = Company::find($companyId);
            foreach ($request->input('userList') as $newUser) {
                $user = new User();
                $user->last_name = $newUser['lastName'];
                $user->first_name = $newUser['firstName'];
                $user->email = $newUser['email'];
                $user->category = 'client';
                $user->status = 1;
                $company->users()->save($user);
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
