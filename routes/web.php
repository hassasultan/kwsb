<?php

use App\Http\Controllers\MobileAgentController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\PrioritiesController;
use App\Http\Controllers\ComplaintTypeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubTownController;
use App\Http\Controllers\SubTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class, 'index'])->name('home');


Auth::routes();

//users
Route::prefix('/admin')->group(function (){
    Route::middleware(['IsAdmin'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('/user-management', UserController::class);
        Route::resource('/agent-management', MobileAgentController::class);
        Route::get('/agent-management/details/{id}',[MobileAgentController::class,'detail'])->name('agent-management.details');
        Route::resource('/town-management', TownController::class);
        Route::resource('/subtown-management', SubTownController::class);
        Route::resource('/compaints-management', ComplaintController::class);
        Route::resource('/priorities-management', PrioritiesController::class);
        Route::resource('/subtype-management', SubTypeController::class);
        Route::resource('/compaints-type-management', ComplaintTypeController::class);
        Route::get('/compaints-management/details/{id}',[ComplaintController::class,'detail'])->name('compaints-management.details');
        Route::resource('/customer-management', CustomerController::class);

    });
});

Route::prefix('/system')->group(function (){
    Route::middleware(['IsSystemUser'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('/town-management', TownController::class);
        Route::resource('/subtown-management', SubTownController::class);
        Route::resource('/compaints-management', ComplaintController::class);
        Route::resource('/compaints-type-management', ComplaintTypeController::class);
        Route::resource('/subtype-management', SubTypeController::class);

        Route::resource('/customer-management', CustomerController::class);
        Route::resource('/priorities-management', PrioritiesController::class);

        Route::get('/compaints-management/details/{id}',[ComplaintController::class,'detail'])->name('compaints-management.details');
    });
});
