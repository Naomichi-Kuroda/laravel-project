<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

// 認証後のページ
Route::get('/authenticate', 'Auth\AuthenticateController@index');

// 認証処理を行う
Route::post('/authenticate', 'Auth\AuthenticateController@auth');

// 認証用のフォームを表示
Route::get('/authenticate/signin', 'Auth\AuthenticateController@showSignIn');