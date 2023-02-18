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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/product/all', 'App\Http\Controllers\ProductController@index');
Route::post('/product/add', 'App\Http\Controllers\ProductController@store');

Route::post('/supply/add', 'App\Http\Controllers\SupplyController@store');

Route::post('/info', 'App\Http\Controllers\InfoController@index');
