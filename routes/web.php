<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TimeEntryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\CompanyRequestController;

Route::get('/', function () {
    return view('landing');
});

// Company Request Routes (Public)
Route::get('/solicitar-acceso', [CompanyRequestController::class, 'create'])->name('company-request.create');
Route::post('/solicitar-acceso', [CompanyRequestController::class, 'store'])->name('company-request.store');
Route::get('/solicitud-exitosa', [CompanyRequestController::class, 'success'])->name('company-request.success');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('time-entries', TimeEntryController::class);
    Route::post('/check-in-out', [TimeEntryController::class, 'store'])->name('check-in-out');

    Route::middleware('adminOrManager')->group(function () {
        Route::resource('companies', CompanyController::class);
    });

    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/solicitudes', [CompanyRequestController::class, 'index'])->name('company-requests.index');
        Route::patch('/solicitudes/{companyRequest}/status', [CompanyRequestController::class, 'updateStatus'])->name('company-requests.update-status');
    });

    Route::middleware('role:manager')->group(function () {
        Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
