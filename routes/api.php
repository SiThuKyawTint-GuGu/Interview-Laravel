<?php

use App\Http\Controllers\InfoController;
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


Route::post('createinfo',[InfoController::class,'createinfo']);
Route::get('sentdata',[InfoController::class, 'sentdata']);
Route::post('updatedata',[InfoController::class,'updatedata']);
Route::post('updatefinal',[InfoController::class,'updatefinal']);
Route::post('deleteitem',[InfoController::class,'deleteitem']);
Route::post('searchkey',[InfoController::class, 'searchkey']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});