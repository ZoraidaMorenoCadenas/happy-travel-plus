<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('destinations', DestinationController::class);
 






//Route::apiResource('happy_travel', TravelController::class);

// // GET All destination http://localhost:8000/api/happy_travel
// GEL One destination http://localhost:8000/api/happy_travel/{id}
//PUT edit http://localhost:8000/api/happy_travel/{id} OJO lleva body y headers
// DELETE delete http://localhost:8000/api/happy_travel/{id} (requires headers)
