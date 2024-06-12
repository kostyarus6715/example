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
use App\Http\Controllers\Api\CallApiController;

Route::get('/calls', [CallApiController::class, 'index']);
Route::get('/calls/{call}', [CallApiController::class, 'show']);
Route::post('/calls', [CallApiController::class, 'store']);
Route::put('/calls/{call}', [CallApiController::class, 'update']);
Route::delete('/calls/{call}', [CallApiController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
