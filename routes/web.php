<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/data', [UserController::class, 'getDataUser']);
Route::get('/user/{id}', [UserController::class, 'getUserById']);
Route::post('/user/create', [UserController::class, 'createDataUser']);
Route::put('/user/edit', [UserController::class, 'editDataUser']);
Route::delete('/user/{id}', [UserController::class, 'softDelete']);

Route::get('/menu', [MenuController::class, 'index']);
Route::post('/menu/create', [MenuController::class, 'createMenu']);
Route::get('/menu/data', [MenuController::class, 'getMenu']);

Route::get('/dashboard', [DashboardController::class, 'showDashboard']);


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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [LoginController::class, 'login']);
