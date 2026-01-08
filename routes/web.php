<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TimeEntryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\CompanyRequestController;
use App\Http\Controllers\TimeEntryExportController;
use App\Http\Controllers\BreakController;
use App\Http\Controllers\AuditController;

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
    
    // Breaks routes
    Route::post('/time-entries/{timeEntry}/breaks/start', [BreakController::class, 'start'])->name('breaks.start');
    Route::post('/time-entries/{timeEntry}/breaks/end', [BreakController::class, 'end'])->name('breaks.end');
    Route::delete('/breaks/{break}', [BreakController::class, 'destroy'])->name('breaks.destroy');
    
    // Exportación de registros (conforme a normativa)
    Route::post('/time-entries/export', [TimeEntryExportController::class, 'export'])->name('time-entries.export');

    Route::middleware('adminOrManager')->group(function () {
        Route::resource('companies', CompanyController::class);
        Route::resource('users', UserController::class);
        Route::get('/audits', [AuditController::class, 'index'])->name('audits.index');
    });

    Route::middleware('admin')->group(function () {
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
