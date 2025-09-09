<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CustomerFeedbackController;
use App\Http\Controllers\SubTownController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\ComplaintTypeController;
use App\Http\Controllers\SubTypeController;
use App\Http\Controllers\AnnouncementController;
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
Route::post('/test/img', [ComplaintController::class, 'testFileUpload']);
Route::post('/customer/register', [AuthController::class, 'customer_register']);
Route::get('/customer/profile', [AuthController::class, 'customer_profile']);
Route::get('/customer/feedback/list', [CustomerFeedbackController::class, 'api_index']);
Route::post('/customer/complaint/registration', [FrontendController::class, 'api_store']);
Route::post('/customer/feedback/store', [CustomerFeedbackController::class, 'store']);
Route::get('/get-subtown', [SubTownController::class, 'get_subtown']);
Route::get('/get-town', [TownController::class, 'alltown']);
Route::get('/get-types', [ComplaintTypeController::class, 'allTypes']);
Route::get('/get-subtypes', [SubTypeController::class, 'get_subtype']);
Route::get('/delete-user', [AuthController::class, 'delete_user']);
Route::get('/get-customer-complaint', [ComplaintController::class, 'customer_wise_complaints']);
Route::get('/get-customer-complaint/paginate', [ComplaintController::class, 'customer_wise_complaints_paginate']);
Route::get('/announcement', [AnnouncementController::class, 'index']);
Route::middleware(['IsMobileAgent'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::get('/agent-complaints', [ComplaintController::class, 'agent_wise_complaints']);
    Route::get('/agent-complaints/paginate', [ComplaintController::class, 'agent_wise_complaints_paginate']);
    Route::get('/agent-complaints/counts', [ComplaintController::class, 'agent_wise_complaints_count']);
    Route::get('/agent-complaints/counts/by/complaint-type', [ComplaintController::class, 'type_wise_complaints']);
    Route::get('/agent-complaints/counts/by/subtype', [ComplaintController::class, 'subtype_wise_complaints']);
    Route::post('/agent-complaints/update', [ComplaintController::class, 'agent_complaints_update']);

    // Bounce Back Functionality
    Route::post('/complaints/bounce-back', [ComplaintController::class, 'bounceBackComplaint']);
    Route::get('/complaints/bounce-back', [ComplaintController::class, 'getBounceBackComplaints']);

    // Device Token Management
    Route::post('/device-token', [App\Http\Controllers\Api\DeviceTokenController::class, 'store']);
    Route::delete('/device-token', [App\Http\Controllers\Api\DeviceTokenController::class, 'destroy']);
    Route::get('/device-token', [App\Http\Controllers\Api\DeviceTokenController::class, 'show']);

});
