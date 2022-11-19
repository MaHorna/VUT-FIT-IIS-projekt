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

Route::get('/', 'App\Http\Controllers\PagesController@login');
Route::get('/login', 'App\Http\Controllers\PagesController@login');

Route::get('/nonuser', 'App\Http\Controllers\PagesController@nonuser');

Route::get('/loged_user', 'App\Http\Controllers\PagesController@loged_user');
Route::get('/profile', 'App\Http\Controllers\PagesController@profile');
Route::get('/my_tour', 'App\Http\Controllers\PagesController@my_tour');
Route::get('/tour_create', 'App\Http\Controllers\PagesController@tour_create');
Route::get('/team_create', 'App\Http\Controllers\PagesController@team_create');

Route::get('/tournaments', 'App\Http\Controllers\PagesController@tournaments');
Route::get('/users', 'App\Http\Controllers\PagesController@users');
Route::get('/teams', 'App\Http\Controllers\PagesController@teams');

Route::get('/team/{id}', 'App\Http\Controllers\PagesController@team');
Route::get('/tournament/{id}', 'App\Http\Controllers\PagesController@tournament');
Route::get('/user/{id}', 'App\Http\Controllers\PagesController@user');

