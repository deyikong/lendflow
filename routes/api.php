<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// get the redirect not to complain
Route::get('login', function() {
    return "login first";
});

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
});


Route::group([
    'prefix' => 'users',
], function () {
    Route::get('', 'UsersController@index');
    Route::get('{user}', 'UsersController@show');
    Route::post('', 'UsersController@store');
    Route::middleware('auth:api')->put('', 'UsersController@update');
});
