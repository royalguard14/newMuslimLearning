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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return ['hello'];
});
Route::post('/auth/login','Api\AuthController@postLogin');
Route::group(['middleware' => 'api.auth'], function () {
    Route::post('/connect','Api\SettingController@connect');
    Route::post('/getData','Api\SettingController@getData');
});
