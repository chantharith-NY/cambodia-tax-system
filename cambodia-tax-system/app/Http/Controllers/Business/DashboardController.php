<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Revenue;
use App\Models\Expense;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\WithholdingTax;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->user()
            ->getCurrentCompany();

        if (!$company) {

            return redirect()
                ->route(
                    'business.company.create'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Revenue
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Revenue::where(
            'company_id',
            $company->id
        )->sum('base_amount');

        $totalRevenueBase = Revenue::where(
            'company_id',
            $company->id
        )->sum('base_amount');

        $outputVat = Revenue::where(
            'company_id',
            $company->id
        )->sum('vat_amount');

        /*
        |--------------------------------------------------------------------------
        | Expense
        |--------------------------------------------------------------------------
        */

        $totalExpense = Expense::where(
            'company_id',
            $company->id
        )->sum('base_amount');

        $totalExpenseBase = Expense::where(
            'company_id',
            $company->id
        )->sum('base_amount');

        $inputVat = Expense::where(
            'company_id',
            $company->id
        )->sum('vat_amount');

        /*
        |--------------------------------------------------------------------------
        | Payroll
        |--------------------------------------------------------------------------
        */

        $totalPayroll = Payroll::whereHas(
            'employee',
            fn($q) =>
            $q->where(
                'company_id',
                $company->id
            )
        )->sum('gross_salary');

        $totalSalaryTax = Payroll::whereHas(
            'employee',
            fn($q) =>
            $q->where(
                'company_id',
                $company->id
            )
        )->sum('salary_tax');

        /*
        |--------------------------------------------------------------------------
        | Employees
        |--------------------------------------------------------------------------
        */

        $totalEmployees = Employee::where(
            'company_id',
            $company->id
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Withholding Tax
        |--------------------------------------------------------------------------
        */

        $totalWHT = WithholdingTax::where(
            'company_id',
            $company->id
        )->sum('withholding_tax');

        /*
        |--------------------------------------------------------------------------
        | VAT
        |--------------------------------------------------------------------------
        */

        $vatPayable =
            $outputVat
            -
            $inputVat;

        /*
        |--------------------------------------------------------------------------
        | Profit
        |--------------------------------------------------------------------------
        */

        $profit =
            $totalRevenue
            -
            $totalExpense
            -
            $totalPayroll;

        /*
        |--------------------------------------------------------------------------
        | Total Tax Due
        |--------------------------------------------------------------------------
        */

        $totalTaxDue =
            $vatPayable
            +
            $totalSalaryTax
            +
            $totalWHT;

        /*
        |--------------------------------------------------------------------------
        | Recent Transactions
        |--------------------------------------------------------------------------
        */

        $recentRevenues = Revenue::where(
            'company_id',
            $company->id
        )
            ->latest()
            ->take(5)
            ->get();

        $recentExpenses = Expense::where(
            'company_id',
            $company->id
        )
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Chart Data (Last 6 Months)
        |--------------------------------------------------------------------------
        */

        $months = [];
        $monthlyRevenue = [];
        $monthlyExpense = [];

        for ($i = 5; $i >= 0; $i--) {

            $date = Carbon::now()->subMonths($i);

            $months[] = $date->format('M');

            $monthlyRevenue[] = Revenue::where(
                'company_id',
                $company->id
            )
                ->whereYear(
                    'invoice_date',
                    $date->year
                )
                ->whereMonth(
                    'invoice_date',
                    $date->month
                )
                ->sum('amount');

            $monthlyExpense[] = Expense::where(
                'company_id',
                $company->id
            )
                ->whereYear(
                    'expense_date',
                    $date->year
                )
                ->whereMonth(
                    'expense_date',
                    $date->month
                )
                ->sum('amount');
        }

        return view(
            'business.dashboard',
            compact(
                'totalRevenue',
                'totalRevenueBase',
                'totalExpense',
                'totalExpenseBase',
                'outputVat',
                'inputVat',
                'vatPayable',
                'totalPayroll',
                'totalSalaryTax',
                'totalEmployees',
                'totalWHT',
                'totalTaxDue',
                'profit',
                'recentRevenues',
                'recentExpenses',
                'months',
                'monthlyRevenue',
                'monthlyExpense',
            )
        );
    }
}
