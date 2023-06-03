<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\StarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('movie', [MovieController::class, 'search']);
Route::post('star', [StarController::class, 'store']);
