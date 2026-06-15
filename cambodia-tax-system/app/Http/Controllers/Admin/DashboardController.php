<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Company;
use App\Models\Revenue;
use App\Models\Expense;
use App\Models\Payroll;
use App\Models\TaxReturn;

class DashboardController extends Controller
{

    public function index()
    {
        return view('admin.dashboard', [

            'totalUsers' => User::count(),

            'totalCompanies' => Company::count(),

            'totalRevenues' => Revenue::count(),

            'totalExpenses' => Expense::count(),

            'totalPayrolls' => Payroll::count(),

            'totalTaxReturns' => TaxReturn::count(),

            'latestCompanies' => Company::latest()
                ->take(5)
                ->get(),

            'latestUsers' => User::latest()
                ->take(5)
                ->get(),
        ]);
    }
}
