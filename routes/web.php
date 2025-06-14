<?php

use App\Http\Controllers\ArchivedRegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationApplicationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pendaftaran/{slug}/{tahunAjaran}', [HomeController::class, 'registration'])->name('registration');
Route::post('/pendaftaran/{slug}/{tahunAjaran}', [RegistrationApplicationController::class, 'store'])->name('registration.store');

Route::get('/pendaftaran-berhasil', [RegistrationApplicationController::class, 'showSuccess'])->name('registration.success');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.handle');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('users', UserController::class)->parameters([
        'users' => 'id'
    ])->except(['show'])->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy'
    ]);
    
    Route::resource('registrations', RegistrationController::class)
        ->parameters(['registrations' => 'id'])
        ->names([
            'index' => 'registrations.index',
            'show' => 'registrations.show',
            'create' => 'registrations.create',
            'store' => 'registrations.store',
            'edit' => 'registrations.edit',
            'update' => 'registrations.update',
            'destroy' => 'registrations.destroy',
        ]);
    
    Route::put('/registrations/{id}/archive', [RegistrationController::class, 'archive'])->name('registrations.archive');
    Route::put('/registrations/{id}/unarchive', [RegistrationController::class, 'unarchive'])->name('registrations.unarchive');
    Route::get('/registrations/{id}/applications', [RegistrationController::class, 'showApplication'])->name('registrations.application');
    Route::get('/registrations/applications/{id}/edit', [RegistrationController::class, 'editApplication'])->name('registrations.applications.edit');
    Route::put('/registrations/applications/{id}', [RegistrationController::class, 'updateApplication'])->name('registrations.applications.update');

    Route::get('/archived-registrations', [ArchivedRegistrationController::class, 'index'])->name('registrations.archived.index');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/fees', [FeeController::class, 'index'])->name('fees.index');
    Route::post('/fees', [FeeController::class, 'update'])->name('fees.update');

});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.handle');

    // Password Reset Routes
    Route::get('/lupa-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/tetapkan-ulang-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/tetapkan-ulang-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
});