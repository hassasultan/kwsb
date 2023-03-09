<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['IsMobileAgent'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::get('/agent-complaints', [ComplaintController::class, 'agent_wise_complaints']);
    Route::get('/agent-complaints/counts', [ComplaintController::class, 'agent_wise_complaints_count']);
    Route::post('/agent-complaints/update', [ComplaintController::class, 'agent_complaints_update']);

});
