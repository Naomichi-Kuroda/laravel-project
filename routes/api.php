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


