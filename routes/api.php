<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BacklogItemController;
use App\Http\Controllers\boardsController;
use App\Http\Controllers\cardController;
use App\Http\Controllers\itemController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('data', [BacklogItemController::class, 'getData']);
Route::get('board', [boardsController::class, 'getBoard']);
Route::get('card', [cardController::class, 'getCard']);
Route::get('list', [itemController::class, 'getList']);