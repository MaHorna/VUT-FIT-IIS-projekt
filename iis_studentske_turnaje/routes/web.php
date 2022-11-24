<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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

Route::get('/nonuser', [PagesController::class, 'nonuser']);
Route::get('/loged_user', [PagesController::class, 'loged_user']);
Route::get('/profile', [PagesController::class, 'profile']);
Route::get('/my_tour', [PagesController::class, 'my_tour']);
Route::get('/tour_create', [PagesController::class, 'tour_create']);
Route::get('/team_create', [PagesController::class, 'team_create']);
Route::get('/teams', [PagesController::class, 'teams']);

//------------------ADMIN----------------------------
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    //Show all users
    Route::get('/users', [AdminController::class, 'showUsers']);

    // Show all tournaments
    Route::get('/tournaments', [AdminController::class, 'showTournaments']);

});

//------------------USER----------------------------

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create new user
Route::post('/register', [UserController::class, 'store'])->middleware('guest');

// Log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Show all users
Route::get('/users', [UserController::class, 'index']);

// Log in user
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');

// Show user profile
Route::get('/users/{user}', [UserController::class, 'show']);

// Edit user profile
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware('auth');

// Update user profile
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth');

// Delete user profile
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth');

//------------------TOURNAMENT----------------------------

// Show all tournaments
Route::get('/tournaments', [TournamentController::class, 'index']);

// Show create tournament form
Route::get('/tournaments/create', [TournamentController::class, 'create'])->middleware('auth');

// Store tournament data
Route::post('/', [TournamentController::class, 'store'])->middleware('auth');

// Show single tournament
Route::get('/tournaments/{tournament}', [TournamentController::class, 'show']);

// Edit tournament
Route::get('/tournaments/{tournament}/edit', [TournamentController::class, 'edit'])->middleware('auth');

// Update tournament
Route::put('/tournaments/{tournament}', [TournamentController::class, 'update'])->middleware('auth');

// Delete tournament
Route::delete('/tournaments/{tournament}', [TournamentController::class, 'destroy'])->middleware('auth');



// Common Resource Routes:
// index - show all listings
// show - show single listing
// create - show form to create new listing
// store - store new listing
// edit - show form to edit listing
// update - update listing
// destroy - delete listing