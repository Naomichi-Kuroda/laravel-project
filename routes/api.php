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

// ユーザー
Route::resource('user', 'UserController');

