<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        )->sum('amount');

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
        )->sum('amount');

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
                'profit'
            )
        );
    }
}
