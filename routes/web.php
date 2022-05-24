<?php

use App\Http\Controllers\Admin\InstalmentController as AdminInstalmentController;
use App\Http\Controllers\Admin\LoanController as AdminLoanController;
use App\Http\Controllers\Admin\LoanRecommendationController as AdminLoanRecommendationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanHistoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SettingController;
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

Route::get('/', [LoginController::class, 'view'])->name('login');
Route::get('/daftar', [RegistrationController::class, 'view'])->name('registration');
Route::get('/lupa-password', [ForgetPasswordController::class, 'view'])->name('forget_password');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'view'])->name('reset_password');

Route::post('/', LoginController::class)->name('login.process');
Route::post('/daftar', RegistrationController::class)->name('registration.process');
Route::post('/lupa-password', ForgetPasswordController::class)->name('forget_password.process');
Route::post('/reset-password/{token}', ResetPasswordController::class)->name('reset_password.process');

Route::group(['middleware' => ['auth:user']], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('pengajuan-pinjaman', [LoanController::class, 'index'])->name('loan');
    Route::get('riwayat-pinjaman', [LoanHistoryController::class, 'index'])->name('loan_history');
    Route::get('riwayat-pinjaman/{id}', [LoanHistoryController::class, 'detail'])->name('loan_history.detail');
    Route::get('pengaturan', [SettingController::class, 'index'])->name('setting');
    Route::get('logout', [DashboardController::class, 'logout'])->name('logout');

    Route::post('pengajuan-pinjaman', [LoanController::class, 'store'])->name('loan.process');
    Route::post('pengaturan', [SettingController::class, 'update'])->name('setting.process');
});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'], function(){
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => 'karyawan'], function(){
        Route::get('/', [AdminUserController::class, 'employee'])->name('admin.employee');
        Route::get('tambah', [AdminUserController::class, 'employee_add'])->name('admin.employee.add');
        Route::get('edit/{id}', [AdminUserController::class, 'employee_edit'])->name('admin.employee.edit');
        Route::get('delete/{id}', [AdminUserController::class, 'employee_delete'])->name('admin.employee.delete');
        Route::get('{id}', [AdminUserController::class, 'employee_detail'])->name('admin.employee.detail');
        
        Route::post('tambah', [AdminUserController::class, 'employee_add_process'])->name('admin.employee.add.process');
        Route::post('edit/{id}', [AdminUserController::class, 'employee_edit_process'])->name('admin.employee.edit.process');
    });
    
    Route::group(['prefix' => 'pengajuan-pinjaman'], function(){
        Route::get('/', [AdminLoanController::class, 'loan'])->name('admin.loan');
        Route::get('/detail/{id}', [AdminLoanController::class, 'loan_detail'])->name('admin.loan.detail');
        Route::get('/action/{id}/{status}', [AdminLoanController::class, 'loan_action'])->name('admin.loan.action');
        Route::get('/delete/{id}', [AdminLoanController::class, 'loan_delete'])->name('admin.loan.delete');

        Route::post('/detail/{id}', [AdminInstalmentController::class, 'instalment_add'])->name('admin.instalment.add');
        Route::post('/instalment/edit/{id}', [AdminInstalmentController::class, 'instalment_edit'])->name('admin.instalment.edit');
        Route::get('/instalment/delete/{id}', [AdminInstalmentController::class, 'instalment_delete'])->name('admin.instalment.delete');
    });

    Route::group(['prefix' => 'rekomendasi-pinjaman'], function(){
        Route::get('/', [AdminLoanRecommendationController::class, 'recommendations'])->name('admin.recommendation');
        Route::get('/tambah', [AdminLoanRecommendationController::class, 'recommendation_add'])->name('admin.recommendation.add');
        Route::post('/tambah', [AdminLoanRecommendationController::class, 'recommendation_add_process'])->name('admin.recommendation.add.process');
        Route::get('/edit/{id}', [AdminLoanRecommendationController::class, 'recommendation_edit'])->name('admin.recommendation.edit');
        Route::post('/edit/{id}', [AdminLoanRecommendationController::class, 'recommendation_edit_process'])->name('admin.recommendation.edit.process');
        Route::get('/delete/{id}', [AdminLoanRecommendationController::class, 'recommendation_delete'])->name('admin.recommendation.delete');
    });

    Route::get('pengaturan-pinjaman', [AdminLoanController::class, 'loan_setting'])->name('admin.loan_setting');
    Route::post('pengaturan-pinjaman', [AdminLoanController::class, 'loan_setting_process'])->name('admin.loan_setting.process');

    Route::get('pengaturan', [AdminUserController::class, 'setting_account'])->name('admin.setting_account');
    Route::post('pengaturan', [AdminUserController::class, 'setting_account_process'])->name('admin.setting_account.process');

    Route::get('keluar', [AdminController::class, 'logout'])->name('admin.logout');
});