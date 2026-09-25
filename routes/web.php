<?php

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\ProductionLineController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LeaveApplicationController;

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// routes/web.php
Route::get('/', fn () => redirect()->route('dashboard'));
// routes/web.php
Route::middleware(['auth', 'permission:view-dashboard'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:Super Admin|Factory Admin'])->group(function () {
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('roles', App\Http\Controllers\RoleController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('buyers', BuyerController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('floors', FloorController::class);
    Route::resource('production-lines', ProductionLineController::class);
    Route::resource('machines', MachineController::class);
});// routes/web.php


Route::middleware(['auth'])->group(function () {
    Route::resource('employees', EmployeeController::class);

    Route::get('attendance/import', [AttendanceController::class, 'import'])->name('attendance.import');
    Route::post('attendance/import', [AttendanceController::class, 'processImport'])->name('attendance.import.process');
    Route::resource('attendance', AttendanceController::class)->except(['show', 'edit', 'update', 'destroy']);

    Route::resource('leave-types', LeaveTypeController::class);
    Route::resource('production-lines', ProductionLineController::class);
    Route::resource('leave-applications', LeaveApplicationController::class)->except(['edit', 'update']);
    Route::patch('leave-applications/{leave_application}/status', [LeaveApplicationController::class, 'updateStatus'])
        ->name('leave-applications.update-status');
});
