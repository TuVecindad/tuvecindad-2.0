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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', 'UsersController');

Route::resource('communities', 'CommunityController');

Auth::routes(['verify' => true]);

Route::resource('properties', 'PropertyController');

Auth::routes(['verify' => true]);
