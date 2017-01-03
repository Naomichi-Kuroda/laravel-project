<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// ログイン処理
Route::post('/authenticate', 'Auth\AuthenticateController@auth');

// ログインユーザー取得
Route::get('/authenticate', 'Auth\AuthenticateController@index');

// 住所検索
Route::get('/address', 'AddressController@search');

// ユーザー
Route::resource('user', 'UserController');
Route::get('/user/sendmail/{userId}', 'UserController@sendConfirmationMail');
Route::get('/user/confirm/{userId}', 'UserController@confirmAccount');
Route::put('/user/storeClient/{userId}', 'UserController@storeClient');
Route::put('/user/updatePassword/{userId}', 'UserController@updatePassword');

// 建物
Route::resource('residence', 'ResidenceController');

// 棟
Route::resource('tower', 'TowerController');
Route::get('/tower/indexRooms/{towerId}', 'TowerController@indexRooms');
Route::put('/tower/storeRooms/{towerId}', 'TowerController@storeRooms');

// 部屋
Route::resource('room', 'RoomController');
Route::get('/room/indexResidents/{roomId}', 'RoomController@indexResidents');
Route::put('/room/storeResident/{roomId}', 'RoomController@storeResident');

// 居住者
Route::resource('resident', 'ResidentController');

// 会社
Route::resource('company', 'CompanyController');
Route::get('/company/indexUsers/{companyId}', 'CompanyController@indexUsers');
Route::put('/company/storeUsers/{companyId}', 'CompanyController@storeUsers');

