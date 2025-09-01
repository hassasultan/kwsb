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
use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentHomeController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\BounceBackController;

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

Route::get('/', function () {
    return view('tab');
})->name('web.home');
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'redirect_page'])->name('auth.home');
});
Route::get('/track/complaint', [FrontendController::class, 'track_complaint'])->name('track.complaint');
Route::get('/add/complaint', [FrontendController::class, 'create_compalint'])->name('front.home');
Route::get('/add/new/connection', [FrontendController::class, 'create_connection_request'])->name('front.home.connection');
Route::get('/generate/bill', [FrontendController::class, 'generate_bill'])->name('front.generate.bill');
Route::get('/update/connection/data', [FrontendController::class, 'update_connection_request'])->name('update.home.connection');
Route::post('/complaint/store', [FrontendController::class, 'store'])->name('front.compalaint.store');
Route::get('/subtown/by/town', [SubTownController::class, 'get_subtown'])->name('subtown.by.town');
Route::get('/subtype/by/type', [SubTypeController::class, 'get_subtype'])->name('subtype.by.type');

Auth::routes();

//users
Route::prefix('/department')->group(function () {
    Route::middleware(['IsDepartment'])->group(function () {
        //users
        Route::get('/home', [DepartmentHomeController::class,'home'])->name('department.home');
        Route::get('/compaints-management', [ComplaintController::class,'index'])->name('deparment.complaint.index');
        Route::get('/compaints-management/{id}/edit', [ComplaintController::class,'edit'])->name('deparment.complaint.edit');
        Route::put('/compaints-management/{id}/update', [ComplaintController::class,'update'])->name('deparment.complaint.update');
        Route::get('/compaints/details/{id}', [ComplaintController::class,'detail'])->name('deparment.complaint.detail');
        Route::post('/compaints/solved/{id}', [ComplaintController::class,'solved_by_department'])->name('deparment.complaint.solved');

    });
});
Route::prefix('/admin')->group(function () {
    Route::middleware(['IsAdmin', 'auth', 'permission'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('/user-management', UserController::class);
        Route::put('/user/update-password', [UserController::class, 'reset_password'])->name('user.update.password');
        Route::get('/user/reset-password', [UserController::class, 'profile'])->name('user.profile');
        Route::resource('/agent-management', MobileAgentController::class);
        Route::get('/agent-management/details/{id}', [MobileAgentController::class, 'detail'])->name('agent-management.details');
        Route::get('/assign-complaints/{agentId}/{complaintId}', [ComplaintController::class, 'assign_complaint'])->name('complaints.assign');
        Route::get('/assign-complaint-department/{userId}/{complaintId}', [ComplaintController::class, 'assign_complaint_department'])->name('complaints.assign.department');
        Route::resource('/town-management', TownController::class);
        Route::resource('/subtown-management', SubTownController::class);
        Route::resource('/compaints-management', ComplaintController::class);
        Route::resource('/priorities-management', PrioritiesController::class);
        Route::resource('/subtype-management', SubTypeController::class);
        Route::resource('/source-management', SourceController::class);
        Route::resource('/compaints-type-management', ComplaintTypeController::class);
        Route::get('/compaints-management/details/{id}', [ComplaintController::class, 'detail'])->name('compaints-management.details');
        Route::get('/compaints-management/logs/{id}', [ComplaintController::class, 'logs'])->name('compaints-management.logs');
        Route::resource('/customer-management', CustomerController::class);
        Route::resource('departments', DepartmentController::class);
        Route::get('/department/details/{id}', [DepartmentController::class, 'detail'])->name('departments.details');

        Route::get('/compaints-reports/reports', [ComplaintController::class, 'generate_report'])->name('compaints-reports.reports');
        Route::get('/compaints-reports/reports2', [ComplaintController::class, 'generate_report2'])->name('compaints-reports.reports2');
        Route::get('/compaints-reports/reports3', [ComplaintController::class, 'generate_report3'])->name('compaints-reports.reports3');
        Route::get('/compaints-reports/reports4', [ComplaintController::class, 'generate_report4'])->name('compaints-reports.reports4');
        Route::get('/compaints-reports/reports5', [ComplaintController::class, 'generate_report5'])->name('compaints-reports.reports5');
        Route::get('/compaints-reports/reports6', [ComplaintController::class, 'generate_report6'])->name('compaints-reports.reports6');
        Route::get('/compaints-reports/reports7', [ComplaintController::class, 'generate_report7'])->name('compaints-reports.reports7');
        Route::get('/compaints-reports/reports8', [ComplaintController::class, 'generate_report8'])->name('compaints-reports.reports8');
        Route::get('/compaints-reports/reports9', [ComplaintController::class, 'generate_report9'])->name('compaints-reports.reports9');
        Route::get('/compaints-reports/reports10', [ComplaintController::class, 'generate_report10'])->name('compaints-reports.reports10');
        Route::get('/compaints-reports/reports11', [ComplaintController::class, 'generate_report11'])->name('compaints-reports.reports11');
        Route::get('/compaints-reports/reports12', [ComplaintController::class, 'generate_report12'])->name('compaints-reports.reports12');
        Route::get('/compaints-reports/reports14', [ComplaintController::class, 'generate_report14'])->name('compaints-reports.reports14');
        Route::get('/compaints-reports/reports15', [ComplaintController::class, 'generate_report15'])->name('compaints-reports.reports15');
        Route::get('/compaints-reports/reports16', [ComplaintController::class, 'generate_billing_data'])->name('compaints-reports.reports16');

        // Bounce Back Routes
        Route::get('/bounce-back', [BounceBackController::class, 'index'])->name('bounce-back.index');
        Route::get('/bounce-back/detail/{id}', [BounceBackController::class, 'detail'])->name('bounce-back.detail');
        Route::get('/bounce-back/get-agents', [BounceBackController::class, 'getAgents'])->name('bounce-back.get-agents');
        Route::get('/bounce-back/get-departments', [BounceBackController::class, 'getDepartments'])->name('bounce-back.get-departments');
        Route::post('/bounce-back/assign', [BounceBackController::class, 'assign'])->name('bounce-back.assign');
        Route::get('/compaints-reports/reports13', [ComplaintController::class, 'generate_report13'])->name('compaints-reports.reports13');
        Route::get('/reports', [ComplaintController::class, 'report'])->name('admin.reports');
        Route::resource('districts', DistrictController::class);

        Route::resource('announcements', AnnouncementController::class)->except(['destroy']);
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
        Route::get('get/role/to/assign/{id}', [App\Http\Controllers\UserController::class, 'get_role_assign'])->name('get.assign.role.users');
        Route::post('assign/role/{id}', [App\Http\Controllers\UserController::class, 'role_assign'])->name('assign.role.users');
        Route::post('complaints/update-status', [App\Http\Controllers\ComplaintController::class, 'updateStatus'])->name('complaints.update-status');
        Route::post('/agent-management/report/{id}', [MobileAgentController::class, 'report'])->name('agent-management.report');

        // Notification Management Routes
        Route::resource('notification', NotificationController::class)->names([
            'index' => 'admin.notification.index',
            'create' => 'admin.notification.create',
            'store' => 'admin.notification.store',
            'show' => 'admin.notification.show',
            'edit' => 'admin.notification.edit',
            'update' => 'admin.notification.update',
            'destroy' => 'admin.notification.destroy',
        ]);
        Route::post('notification/send-test', [NotificationController::class, 'sendTest'])->name('admin.notification.send-test');
        Route::get('notification/statistics', [NotificationController::class, 'statistics'])->name('admin.notification.statistics');

        // Logs Management Routes
        Route::get('/logs-management', [App\Http\Controllers\LogController::class, 'index'])->name('admin.logs.index');
        Route::get('/logs-management/{id}/detail', [App\Http\Controllers\LogController::class, 'detail'])->name('admin.logs.detail');
    });
});

Route::prefix('/system')->group(function () {
    Route::middleware(['IsSystemUser'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('/town-management', TownController::class);
        Route::resource('/subtown-management', SubTownController::class);
        Route::resource('/compaints-management', ComplaintController::class);
        Route::resource('/compaints-type-management', ComplaintTypeController::class);
        Route::get('/compaints-reports/reports', [ComplaintController::class, 'generate_report'])->name('compaints-reports.reports');
        Route::get('/reports', [ComplaintController::class, 'report'])->name('reports');

        Route::resource('/subtype-management', SubTypeController::class);
        Route::resource('/source-management', SourceController::class);

        Route::resource('/customer-management', CustomerController::class);
        Route::resource('/priorities-management', PrioritiesController::class);
        Route::resource('districts', DistrictController::class);

        Route::get('/compaints-management/details/{id}', [ComplaintController::class, 'detail'])->name('compaints-management.details');

        // Logs Management Routes for System Users
        Route::get('/logs-management', [LogController::class, 'index'])->name('system.logs.index');
        Route::get('/logs-management/{id}/detail', [LogController::class, 'detail'])->name('system.logs.detail');
        
        Route::post('/compaints-management/get-consumer-details', [ComplaintController::class, 'getConsumerDetails'])->name('compaints-management.get-consumer-details');
    });
});
