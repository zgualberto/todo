<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todos', [App\Http\Controllers\TodoController::class, 'index']);
Route::get('/todos/{id}', [App\Http\Controllers\TodoController::class, 'show']);
Route::post('/todos', [App\Http\Controllers\TodoController::class, 'store']);
Route::put('/todos/{id}', [App\Http\Controllers\TodoController::class, 'update']);
Route::delete('/todos/{id}', [App\Http\Controllers\TodoController::class, 'destroy']);