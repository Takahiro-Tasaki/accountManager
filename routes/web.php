<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KindController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Route::resource('kind', KindController::class)->middleware('auth');
Route::resource('user', UserController::class, ['only' => ['index', 'edit', 'update', 'store', 'create', 'show', 'destroy']])->middleware('auth');
Route::resource('category', CategoryController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

