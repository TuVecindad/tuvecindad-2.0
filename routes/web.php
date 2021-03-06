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
    return view('portada');
});

Route::resource('users', 'UsersController');

Route::get('users/{id}/premium', 'UsersController@premium')->name('users.premium');
Route::patch('users/{id}/updatePremium','UsersController@updatePremium')->name('users.updatePremium');

Route::get('communities/{community}/adduser', 'CommunityController@adduser')->name('communities.adduser');

Route::post('communities/adduser', 'CommunityController@storeuser')->name('communities.storeuser');

Route::resource('communities', 'CommunityController');

Route::resource('properties', 'PropertyController');

Route::get('communities/{community}/property', 'PropertyController@create')->name('properties.create');

Auth::routes(['verify' => true]);
