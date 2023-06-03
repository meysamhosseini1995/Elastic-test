<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
$controller_namespace = 'App\Http\Controllers';
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group(['namespace' => $controller_namespace], function () {
    Route::get('/news', "NewsController@index");
    Route::get('/instagram', "InstagramController@index");
    Route::get('/twitter', "TwitterController@index");

    Route::resource('task', 'TaskController');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
