<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//Route::get("/users",[MessageController::class,"getUsers"]); 
Route::get("/messages/create", [MessageController::class, "create"])->name("message.index");
Route::get("/messages/{message}",[MessageController::class, "MessageShow"])->name("message.show");
Route::post("/messages/create", [MessageController::class, "CreateMessage"]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
