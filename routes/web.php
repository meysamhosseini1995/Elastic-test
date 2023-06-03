<?php

use App\Enums\IndexModels;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

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
    return \App\Models\User::query()->has('tasks', '>', 0)->with('tasks')->get();
//    \App\Models\Twitter::find(1)->update([
//        "content" => "Meysam Karimi Khobi",
//    ]);
    return ['Laravel' => app()->version()];
});


