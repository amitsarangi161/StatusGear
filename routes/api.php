<?php

use Illuminate\Http\Request;
use App\User;
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

Route::post('/authenticateuser','ApiController@authenticateuser');
Route::post('/saveuserlocation','ApiController@saveuserlocation');
Route::post('/savetraveldetails','ApiController@savetraveldetails');
Route::post('/saveattendance','ApiController@saveattendance');
Route::post('/saveuser','ApiController@saveuser');
Route::get('/getusers/{id}','ApiController@getusers');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
