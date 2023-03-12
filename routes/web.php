<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Models\User;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ChiefController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeamleadController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\CompanyMainPageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ContuctUsController;

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

Route::get('/', [WelcomeController::class, 'welcome'])->middleware('welcome');

Route::get('/company/{email}', [CompanyMainPageController::class, 'companyPage'])->name('companyPage');

Auth::routes();

Route::get('/error_page', function() {
    return "Error! You havn't access to this dashboard!";
});

Route::get('/reset_password_response', function() {
    return "Successfully! Link for reset your old password sent to your email!";
});

Route::get('/error_login', function() {
    return "Error! Your login data is invalid! <a href='/login'>Back to Login page!</a>";
});

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::post('/home/updatePassword/{email}', [HomeController::class, 'updatePassword'])->middleware('auth');

Route::post('/users/import', [AdminController::class, 'uploaded_users']);

Route::get('/export', [ExportController::class, 'export']);

Route::get('/users', [ApiController::class, 'users'])->name('users');

Route::get('/auth/google', [SocialController::class, 'googleRedirect'])->name('auth.google');

Route::get('/auth/google/callback', [SocialController::class, 'loginWithGoogle']);

Route::get('/import-error', function()
{
   return view('roles.import-error');
});

Route::get('/auth/facebook', [FacebookController::class, 'facebookRedirect'])->name('auth.facebook');

Route::get('/auth/facebook/callback', [FacebookController::class, 'facebookLogin']);

Route::get('/admin/{email}/users', [AdminController::class, 'usersPagination']);

Route::get('/manager/{email}', [ManagerController::class, 'manager'])->middleware('manager');

Route::get('/chief/{email}', [ChiefController::class, 'chief'])->middleware('chief');

Route::get('/teamlead/{email}', [TeamleadController::class, 'teamlead'])->middleware('teamlead');

Route::get('/users/delete/{email}', [AdminController::class, 'delete'])->middleware('admin');

Route::put('/users/{email}', [AdminController::class, 'updateUser']);

Route::get('/payment', [PaymentController::class, 'payment']);

Route::get('/contuctUs', [ContuctUsController::class, 'index']);

Route::post('/contuctUs', [ContuctUsController::class, 'sendForm']);

Route::get('/contuctUs/response', [ContuctUsController::class, 'response']);

Route::get('/payment/payment-success', [PaymentController::class, 'stripe'])->name('payment-success');

Route::get('/home/response', [PaymentController::class, 'responses'])->middleware('auth');

Route::get('/home/response_error', [PaymentController::class, 'responses_error']);

Route::get('/users', [AdminController::class, 'update_coworkers'])->middleware('admin');

Route::post('/users/manager_status/{email}', [AdminController::class, 'manager_status']);

Route::post('/users/teamlead_status/{email}', [AdminController::class, 'teamlead_status']);

Route::post('/users/chief_status/{email}', [AdminController::class, 'chief_status']);

Route::post('/users/employee_status/{email}', [AdminController::class, 'employee_status']);

Route::get('/users/list', [AdminController::class, 'usersPagination'])->middleware('admin');

Route::post('/users', [AdminController::class, 'add_worker']);

Route::get('/companies', [AdminController::class, 'companies'])->middleware('admin');

Route::post('/companies', [AdminController::class, 'addCompanies'])->middleware('admin')->name('add-company');

Route::get('/profile', [UserController::class, 'profile'])->name('profile');

Route::post("/profile/edit_password", [UserController::class, 'editPassword'])->name("edit-password");

Route::get('/add/avatar', [UserController::class, 'addAvatar'])->name('add.avatar');

Route::post('/store/avatar', [UserController::class, 'storeAvatar'])->name('store.avatar');

Route::get('/delete/avatar/{id}', [UserController::class, 'deleteAvatar'])->name('delete.avatar');

Route::get('/departments', [AdminController::class, 'departments'])->name("departments")->middleware("admin");

Route::get('/departments/delete/{title}', [AdminController::class, 'deleteDepartment']);

Route::post('/departments', [AdminController::class, 'addDepartment']);

Route::post('/departments/update/{title}', [AdminController::class, 'updateDepartment']);

Route::post("/companies/update/{title}", [AdminController::class, 'updateCompanyTitle']);

Route::post("/companies/update-manager/{manager}", [AdminController::class, 'updateCompanyManager']);

Route::post("/companies/update-managerEmail/{manager_email}", [AdminController::class, 'updateCompanyManagerEmail']);

Route::get("/companies/delete/{title}", [AdminController::class, 'deleteCompany']);

Route::post("/users/changeName_chief/{name}", [AdminController::class, "changeName_chief"]);

Route::post("/users/changeEmail_chief/{email}", [AdminController::class, "changeEmail_chief"]);

Route::get("/companies/delete/manager/{email}", [AdminController::class, "deleteCompanyManager"]);

# Route::get('/test/{email}', [AdminController::class, 'test']);
