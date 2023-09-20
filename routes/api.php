<?php

use App\Http\Controllers\API\v1\AuthController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'api/v1'], function () {
    Route::group(['prefix' => 'auth'], function (){
        Route::post('login', [AuthController::class, 'login']);
        Route::post('registration', [AuthController::class, 'registration']);
        Route::get('updateToken', [AuthController::class, 'updateToken']);
    });
    Route::post('saveLocation', []);
    Route::get('getLocationByTime', []);
    Route::get('getLocations', []);
});
