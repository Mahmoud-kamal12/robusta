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

Route::group([
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
Route::group(['middleware' => 'auth:api'],function (){
    Route::get("all-trips","TripController@allTrips");
    Route::get("trip/{id}","TripController@allSeats");
    Route::get("all-reserved/{id}","TripController@allReserved");
    Route::post("booking","TripController@booking");
    Route::post("store-trip","TripController@store");

});
