<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ContestantController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\MyTeamController;

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

//------------------ADMIN----------------------------
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    //Show all users
    Route::get('/users', [AdminController::class, 'showUsers']);

    // Show all tournaments
    Route::get('/tournaments', [AdminController::class, 'showTournaments']);

    // Approve tournament
    Route::put('/tournaments/{tournament}', [AdminController::class, 'updateTournaments']);
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

// Show harmonogram
Route::get('/tournaments/harmonogram', [TournamentController::class, 'harmonogram'])->middleware('auth');

// Store tournament data
Route::post('/tournaments', [TournamentController::class, 'store'])->middleware('auth');

// Show single tournament
Route::get('/tournaments/{tournament}', [TournamentController::class, 'show']);

// Edit tournament
Route::get('/tournaments/{tournament}/edit', [TournamentController::class, 'edit'])->middleware('auth');

// Update tournament
Route::put('/tournaments/{tournament}', [TournamentController::class, 'update'])->middleware('auth');

// Start tournament
Route::put('/tournaments/{tournament}/start', [TournamentController::class, 'start'])->middleware('auth');

// End tournament
Route::put('/tournaments/{tournament}/end', [TournamentController::class, 'end'])->middleware('auth');

// Update tournament match score
Route::put('/tournaments/updatescore/{contest}', [TournamentController::class, 'updatescore'])->middleware('auth');

// Update tournament match winner
Route::put('/tournaments/updatewinner/{contest}', [TournamentController::class, 'updatewinner'])->middleware('auth');

// TODO:
Route::post('/tournaments/get_popup_data/{contest}', [MatchController::class, 'get_popup_data'])->middleware('auth');

// Delete tournament
Route::delete('/tournaments/{tournament}', [TournamentController::class, 'destroy'])->middleware('auth');

// Show my tournaments
Route::get('/my_tournaments', [TournamentController::class, 'my_tour'])->middleware('auth');

//------------------TEAM----------------------------

// Show all teams
Route::get('/teams', [TeamController::class, 'index']);

// Show create team form
Route::get('/teams/create', [TeamController::class, 'create']);

// Store team data
Route::post('/teams', [TeamController::class, 'store']);

// Show single team
Route::get('/teams/{team}', [TeamController::class, 'show']);

// Edit team
Route::get('/teams/{team}/edit', [TeamController::class, 'edit']);

// Update team
Route::put('/teams/{team}', [TeamController::class, 'update']);

// Delete team
Route::delete('/teams/{team}', [TeamController::class, 'destroy']);

// Add new player
Route::post('/my_teams/add_user/{team}', [TeamController::class, 'add_user']);

// Remove player
Route::delete('/my_teams/destroy/{user_id}/{team_id}', [TeamController::class, 'remove_user']);

//------------------MY_TEAM----------------------------

// Show all teams
Route::get('/my_teams', [MyTeamController::class, 'index']);

// Show single team
Route::get('/my_teams/{team}', [MyTeamController::class, 'show']);

//------------------CONTESTANT----------------------------

// Store contestant data
Route::post('/contestant', [ContestantController::class, 'store'])->middleware('auth');

// Delete team contestant
Route::delete('/contestant/destroy_team/{tournament}', [ContestantController::class, 'destroy_team'])->middleware('auth');

// Delete user contestant
Route::delete('/contestant/destroy_user/{tournament}', [ContestantController::class, 'destroy_user'])->middleware('auth');

// Common Resource Routes:
// index - show all listings
// show - show single listing
// create - show form to create new listing
// store - store new listing
// edit - show form to edit listing
// update - update listing
// destroy - delete listing