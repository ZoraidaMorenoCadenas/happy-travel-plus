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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/destinations', [DestinationController::class, 'index']);
Route::get('/destinations/{id}', [DestinationController::class, 'show']);
Route::get('/destinations/search/{name}', [DestinationController::class, 'search']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/destinations', [DestinationController::class, 'store']);
    Route::post('/destinations/{id}', [DestinationController::class, 'update']);
    Route::delete('/destinations/{id}', [DestinationController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});

Route::apiResource('destinos', DestinationController::class);




