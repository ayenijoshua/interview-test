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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//login
Route::post('login', 'AUth\LoginController@login')->name('api.login');
//signup
Route::post('signup', 'Auth\LoginController@signUp')->name('api.signup');

Route::get('users','API\UserController@index');

Route::delete('delete-user','API\UserController@destroy')->middleware();