<?php

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


Auth::routes();

Route::get('{page}', 'App\Http\Controllers\HomeController')->where('page', '.*');
//Route::post('/product/add', 'App\Http\Controllers\ProductController@store');
//Route::get('/product/all', 'App\Http\Controllers\ProductController@index');
