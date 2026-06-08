<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

use App\Http\Controllers\Individual\DashboardController as IndividualDashboardController;
use App\Http\Controllers\Business\DashboardController as BusinessDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Business\CompanyController;

use App\Http\Controllers\Business\RevenueController;
use App\Http\Controllers\Business\ExpenseController;
use App\Http\Controllers\Business\EmployeeController;
use App\Http\Controllers\Business\PayrollController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function (Request $request) {

    return match ($request->user()->role) {

        'admin' =>
        redirect()->route('admin.dashboard'),

        'business' =>
        redirect()->route('business.dashboard'),

        default =>
        redirect()->route('individual.dashboard'),
    };
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware([
    'auth',
    'role:individual'
])->group(function () {

    Route::get(
        '/individual/dashboard',
        [IndividualDashboardController::class, 'index']
    )->name('individual.dashboard');
});

Route::middleware([
    'auth',
    'role:business'
])->group(function () {

    Route::get(
        '/business/dashboard',
        [BusinessDashboardController::class, 'index']
    )->name('business.dashboard');
});

Route::middleware([
    'auth',
    'role:admin'
])->group(function () {

    Route::get(
        '/admin/dashboard',
        [AdminDashboardController::class, 'index']
    )->name('admin.dashboard');
});

Route::middleware([
    'auth',
    'role:business'
])->prefix('business')
    ->name('business.')
    ->group(function () {

        // Company
        Route::get(
            '/company/create',
            [CompanyController::class, 'create']
        )->name('company.create');

        Route::post(
            '/company',
            [CompanyController::class, 'store']
        )->name('company.store');

        // Revenue
        Route::resource(
            'revenues',
            RevenueController::class
        );

        // Expense
        Route::resource(
            'expenses',
            ExpenseController::class
        );

        // Employee
        Route::resource(
            'employees',
            EmployeeController::class
        );

        // Payroll
        Route::resource(
            'payrolls',
            PayrollController::class
        );
    });

require __DIR__ . '/auth.php';
