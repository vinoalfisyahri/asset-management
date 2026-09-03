<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\SubmissionsController;
use App\Http\Controllers\DepreciationsController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('assets', AssetController::class);
Route::resource('categories', CategoriesController::class);
Route::resource('items', ItemsController::class);
Route::resource('submissions', SubmissionsController::class);
Route::resource('depreciations', DepreciationsController::class);
