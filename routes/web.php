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
use App\Http\Controllers\VacationRequestController;
use App\Http\Controllers\StatisticsController;

Route::get('/', function () {
    return view('landing');
});

// Legal Pages (Public)
Route::get('/terminos-y-condiciones', function () {
    return view('legal.terms');
})->name('terms');

Route::get('/politica-de-privacidad', function () {
    return view('legal.privacy');
})->name('privacy');

Route::get('/politica-de-cookies', function () {
    return view('legal.cookies');
})->name('cookies');

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
    
    // Vacation requests routes
    Route::resource('vacation-requests', VacationRequestController::class);
    Route::post('/vacation-requests/{vacationRequest}/approve', [VacationRequestController::class, 'approve'])->name('vacation-requests.approve');
    Route::post('/vacation-requests/{vacationRequest}/reject', [VacationRequestController::class, 'reject'])->name('vacation-requests.reject');
    Route::post('/vacation-requests/calculate-days', [VacationRequestController::class, 'calculateDays'])->name('vacation-requests.calculate-days');
    
    // Exportación de registros (conforme a normativa)
    Route::post('/time-entries/export', [TimeEntryExportController::class, 'export'])->name('time-entries.export');

    Route::middleware('adminOrManager')->group(function () {
        Route::resource('companies', CompanyController::class);
        Route::patch('/companies/{company}/vacation-settings', [CompanyController::class, 'updateVacationSettings'])->name('companies.update-vacation-settings');
        Route::resource('users', UserController::class);
        Route::get('/audits', [AuditController::class, 'index'])->name('audits.index');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/solicitudes', [CompanyRequestController::class, 'index'])->name('company-requests.index');
        Route::patch('/solicitudes/{companyRequest}/status', [CompanyRequestController::class, 'updateStatus'])->name('company-requests.update-status');
    });

    Route::middleware('role:manager')->group(function () {
        Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
        Route::get('/reports/create', [ReportsController::class, 'create'])->name('reports.create')->middleware('admin');
        Route::post('/reports', [ReportsController::class, 'store'])->name('reports.store')->middleware('admin');
        Route::delete('/reports/{timeEntry}', [ReportsController::class, 'destroy'])->name('reports.destroy')->middleware('admin');
        
        Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
