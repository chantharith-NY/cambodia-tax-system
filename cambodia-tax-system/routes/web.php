<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\IncomeTaxBracketController;
use App\Http\Controllers\Admin\SalaryTaxBracketController;
use App\Http\Controllers\Admin\TaxSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;


use App\Http\Controllers\Business\CompanyController;
use App\Http\Controllers\Business\DashboardController as BusinessDashboardController;
use App\Http\Controllers\Business\RevenueController;
use App\Http\Controllers\Business\ExpenseController;
use App\Http\Controllers\Business\EmployeeController;
use App\Http\Controllers\Business\PayrollController;
use App\Http\Controllers\Business\WithholdingTaxController;
use App\Http\Controllers\Business\TaxReturnController;

use App\Http\Controllers\Public\SalaryTaxCalculatorController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\StampTaxCalculatorController;
use App\Http\Controllers\Public\RentalTaxCalculatorController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get(
    '/salary-tax-calculator',
    [SalaryTaxCalculatorController::class, 'index']
)->name('public.salary-tax');

Route::post(
    '/salary-tax-calculator',
    [SalaryTaxCalculatorController::class, 'calculate']
)->name('public.salary-tax.calculate');

Route::get(
    '/stamp-tax-calculator',
    [StampTaxCalculatorController::class, 'index']
)->name('public.stamp-tax');

Route::post(
    '/stamp-tax-calculator',
    [StampTaxCalculatorController::class, 'calculate']
)->name('public.stamp-tax.calculate');

Route::get(
    '/rental-tax-calculator',
    [RentalTaxCalculatorController::class, 'index']
)->name('public.rental-tax');

Route::post(
    '/rental-tax-calculator',
    [RentalTaxCalculatorController::class, 'calculate']
)->name('public.rental-tax.calculate');

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
    'role:business'
])->group(function () {

    Route::get(
        '/business/dashboard',
        [BusinessDashboardController::class, 'index']
    )->name('business.dashboard');
});

// ADMIN ROUTES

Route::middleware([
    'auth',
    'role:admin'
])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [AdminDashboardController::class, 'index']
        )->name('dashboard');

        Route::resource(
            'income-tax-brackets',
            IncomeTaxBracketController::class
        );

        Route::resource(
            'tax-settings',
            TaxSettingController::class
        );

        Route::resource(
            'salary-tax-brackets',
            SalaryTaxBracketController::class
        );

        Route::resource(
            'users',
            UserController::class
        );

        Route::resource(
            'companies',
            AdminCompanyController::class
        )->only([
            'index',
            'show',
            'destroy'
        ]);
    });

// BUSINESS ROUTES

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

        // Withholding Tax
        Route::resource(
            'withholding-taxes',
            WithholdingTaxController::class
        );

        // Tax Return
        Route::resource(
            'tax-returns',
            TaxReturnController::class
        )->only([
            'index',
            'create',
            'store',
            'show'
        ]);

        Route::patch(
            'tax-returns/{taxReturn}/submit',
            [TaxReturnController::class, 'submit']
        )->name('tax-returns.submit');

        Route::patch(
            'tax-returns/{taxReturn}/paid',
            [TaxReturnController::class, 'markPaid']
        )->name('tax-returns.paid');
        Route::resource(
            'tax-settings',
            TaxSettingController::class
        );

        Route::resource(
            'salary-tax-brackets',
            SalaryTaxBracketController::class
        );
    });


require __DIR__ . '/auth.php';
