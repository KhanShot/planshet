<?php

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

Route::post('tablets/mode', [\App\Http\Controllers\Api\TabletController::class, 'mode']);

//ad video
Route::get('video/get-list', [\App\Http\Controllers\Api\AdVideoController::class, 'getList']);
Route::post('video/end', [\App\Http\Controllers\Api\AdVideoController::class, 'videoEnd']);
