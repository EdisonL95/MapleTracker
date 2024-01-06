<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\AdminController;
use App\Models\site_data;
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
    $siteData = site_data::first();

    // Pass the data to the 'home' view
    return view('home', ['siteData' => $siteData]);
});

Route::controller(CharacterController::class)->group(function() {
    Route::get("/characters", "displayCharactersPage")->middleware('auth');
    Route::post("/attempt_create_character", 'createCharacter')->middleware('auth');
    Route::post('/search_character', "searchCharacter")->middleware('auth');
    Route::get('/attempt_delete_character/{id}', "deleteCharacter")->middleware('auth');
    Route::post('/attempt_edit_character', "editCharacter")->middleware('auth');
});

Route::controller(TaskController::class)->group(function() {
    Route::get("/tasks", "displayTasksPage")->middleware('auth');
    Route::get("/taskmanager", "displayTaskManagerPage")->middleware('auth');
    Route::post("/attempt_create_task", "createTask")->middleware('auth');
    Route::get("/attempt_delete_task/{id}", "deleteTask")->middleware('auth');
    Route::post('/attempt_edit_task', "editTask")->middleware('auth');
    Route::get('/add_character_task/{characterId}/{taskId}', "addCharacterTask")->middleware('auth');
    Route::get('/delete_character_task/{taskId}', "deleteCharacterTask")->middleware('auth');
    Route::get('/set_task_status/{taskId}', "setTaskStatus")->middleware('auth');
});

Route::controller(UserAuthController::class)->group(function() {

    Route::get("/register", "displayRegisterPage")->middleware('guest');

    Route::post("/attempt_register", 'registerUser');

    Route::get("/login", 'displayLoginPage')->name("login")->middleware('guest');

    Route::post("/attempt_login", 'authenticate');

    Route::get("/logout", 'logout');
});

Route::controller(ForumController::class)->group(function() {
    Route::get("/forum", "displayForum")->middleware('auth');
    Route::get("/post/{id}", "displayThread")->middleware('auth');
    Route::post("/attempt_create_thread", "createThread")->middleware('auth');
    Route::post("/attempt_create_post/{id}", "createPost")->middleware('auth');
    Route::get("/attempt_delete_thread/{id}", "deleteThread")->middleware('auth');
    Route::get("/attempt_delete_post/{id}", "deletePost")->middleware('auth');
});

Route::controller(AdminController::class)->group(function() {
    Route::get("/admin", "displayAdmin")->middleware('auth');
    Route::post("/attempt_change_landing", "changeLandingText")->middleware('auth');
    Route::post("/attempt_add_base", "createBase")->middleware('auth');
    Route::get("/attempt_delete_base/{id}", "deleteBase")->middleware('auth');
    Route::post('/attempt_edit_base', "editBase")->middleware('auth');
});