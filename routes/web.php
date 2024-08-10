<?php

use App\Http\Controllers\Admin\AccountManager;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmployeeManagementController;
use App\Http\Controllers\Admin\EmployeeScheduleController;
use App\Http\Controllers\Admin\WorkScheduleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth:admin', 'verified'])->name('admin.index');
Route::middleware('auth:admin')->group(function () {


    Route::resource('account', AccountManager::class);
    Route::resource('employee', EmployeeManagementController::class);
    Route::resource('schedule', WorkScheduleController::class);
    Route::resource('employee-schedule', EmployeeScheduleController::class);


    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
