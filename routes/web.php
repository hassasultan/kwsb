<?php

use App\Http\Controllers\MobileAgentController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\PrioritiesController;
use App\Http\Controllers\ComplaintTypeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\SubTownController;
use App\Http\Controllers\SubTypeController;
use App\Http\Controllers\DistrictController;
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

Route::get('/',function()
{
    return view('tab');
})->name('web.home');
Route::get('/track/complaint',[FrontendController::class, 'track_complaint'])->name('track.complaint');
Route::get('/add/complaint',[FrontendController::class, 'create_compalint'])->name('front.home');
Route::get('/add/new/connection',[FrontendController::class, 'create_connection_request'])->name('front.home.connection');
Route::get('/update/connection/data',[FrontendController::class, 'create_connection_request'])->name('update.home.connection');
Route::post('/complaint/store',[FrontendController::class, 'store'])->name('front.compalaint.store');
Route::get('/subtown/by/town', [SubTownController::class, 'get_subtown'])->name('subtown.by.town');
Route::get('/subtype/by/type', [SubTypeController::class, 'get_subtype'])->name('subtype.by.type');

Auth::routes();

//users
Route::prefix('/admin')->group(function (){
    Route::middleware(['IsAdmin'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('/user-management', UserController::class);
        Route::resource('/agent-management', MobileAgentController::class);
        Route::get('/agent-management/details/{id}',[MobileAgentController::class,'detail'])->name('agent-management.details');
        Route::get('/assign-complaints/{agentId}/{complaintId}',[ComplaintController::class,'assign_complaint'])->name('complaints.assign');
        Route::resource('/town-management', TownController::class);
        Route::resource('/subtown-management', SubTownController::class);
        Route::resource('/compaints-management', ComplaintController::class);
        Route::resource('/priorities-management', PrioritiesController::class);
        Route::resource('/subtype-management', SubTypeController::class);
        Route::resource('/source-management', SourceController::class);
        Route::resource('/compaints-type-management', ComplaintTypeController::class);
        Route::get('/compaints-management/details/{id}',[ComplaintController::class,'detail'])->name('compaints-management.details');
        Route::resource('/customer-management', CustomerController::class);

        Route::get('/compaints-reports/reports',[ComplaintController::class,'generate_report'])->name('compaints-reports.reports');
        Route::get('/reports',[ComplaintController::class,'report'])->name('admin.reports');
        Route::resource('districts', DistrictController::class);


    });
});

Route::prefix('/system')->group(function (){
    Route::middleware(['IsSystemUser'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('/town-management', TownController::class);
        Route::resource('/subtown-management', SubTownController::class);
        Route::resource('/compaints-management', ComplaintController::class);
        Route::resource('/compaints-type-management', ComplaintTypeController::class);
        Route::get('/compaints-reports/reports',[ComplaintController::class,'generate_report'])->name('compaints-reports.reports');
        Route::get('/reports',[ComplaintController::class,'report'])->name('reports');

        Route::resource('/subtype-management', SubTypeController::class);
        Route::resource('/source-management', SourceController::class);

        Route::resource('/customer-management', CustomerController::class);
        Route::resource('/priorities-management', PrioritiesController::class);

        Route::get('/compaints-management/details/{id}',[ComplaintController::class,'detail'])->name('compaints-management.details');
    });
});
