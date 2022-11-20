<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TournamentController;

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

Route::get('/', [PagesController::class, 'index']);


Route::get('/login', [PagesController::class, 'login']);

Route::get('/nonuser', [PagesController::class, 'nonuser']);

Route::get('/loged_user', [PagesController::class, 'loged_user']);
Route::get('/profile', [PagesController::class, 'profile']);
Route::get('/my_tour', [PagesController::class, 'my_tour']);
Route::get('/tour_create', [PagesController::class, 'tour_create']);
Route::get('/team_create', [PagesController::class, 'team_create']);

Route::get('/tournaments', [PagesController::class, 'tournaments']);
Route::get('/users', [PagesController::class, 'users']);
Route::get('/teams', [PagesController::class, 'teams']);

Route::get('/team/{id}', [PagesController::class, 'team']);
Route::get('/tournament/{id}', [PagesController::class, 'tournament']);
Route::get('/user/{id}', [PagesController::class, 'user']);


//------------------USER----------------------------

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create']);

// Create new user
Route::post('/', [UserController::class, 'store']);

//------------------TOURNAMENT----------------------------

// Show create tournament form
Route::get('/tournaments/create', [TournamentController::class, 'create']);

// Store tournament data
Route::post('/', [TournamentController::class, 'store']);

// Show single tournament
Route::get('/tournaments/{tournament}', [TournamentController::class, 'show']);

// Edit tournament
Route::get('/tournaments/{tournament}/edit', [TournamentController::class, 'edit']);

// Update tournament
Route::put('/tournaments/{tournament}', [TournamentController::class, 'update']);

// Delete tournament
Route::delete('/tournaments/{tournament}', [TournamentController::class, 'destroy']);



// Common Resource Routes:
// index - show all listings
// show - show single listing
// create - show form to create new listing
// store - store new listing
// edit - show form to edit listing
// update - update listing
// destroy - delete listing