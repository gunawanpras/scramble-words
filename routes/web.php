<?php

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

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@home');
Route::get('get_words', 'GameController@generateRandomWords');
Route::get('reshuffle', 'GameController@reShuffle');
Route::get('check_answer', 'GameController@checkAnswer');
Route::get('refresh_game', 'GameController@refreshTheGame');
Route::get('invalid_route', 'GameController@invalidRoute');

Route::get('admin/home', 'admin/AdminController@home');
Route::post('admin/login', 'admin/LoginController@login');
Route::post('admin/logout', 'admin/LoginController@logout');

Route::get('dataseeds', function() {
    // DB::table('users')->insert([
    //     [
    //         "name"  =>  'devguy',
    //         "email"  =>  'gunawann.prasetio@gmail.com',
    //         "password"  =>  'NjMxMGU2ODI3NDA0NGVkMDU3NzgzMTRhZDE1MmVhNTA='
    //     ]
    // ]);
});

Auth::routes();
