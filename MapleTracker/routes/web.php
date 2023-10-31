<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::controller(CharacterController::class)->group(function() {
    Route::get("/characters", "displayCharactersPage")->middleware('auth');
    Route::post("/attempt_create", 'createCharacter')->middleware('auth');
    Route::post('/search_character', "searchCharacter")->middleware('auth');
    Route::get('/attempt_delete/{id}', "deleteCharacter")->middleware('auth');
});

Route::controller(TaskController::class)->group(function() {
    Route::get("/tasks", "displayTasksPage")->middleware('auth');
});

Route::controller(UserAuthController::class)->group(function() {

    Route::get("/register", "displayRegisterPage")->middleware('guest');

    Route::post("/attempt_register", 'registerUser');

    Route::get("/login", 'displayLoginPage')->name("login")->middleware('guest');

    Route::post("/attempt_login", 'authenticate');

    Route::get("/logout", 'logout');
});