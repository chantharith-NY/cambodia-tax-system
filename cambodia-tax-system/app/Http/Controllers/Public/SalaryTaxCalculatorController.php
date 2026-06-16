<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Services\TaxCalculationService;
use Illuminate\Http\Request;
use App\Models\SalaryTaxBracket;

class SalaryTaxCalculatorController extends Controller
{
    public function index()
    {
        $residentBrackets = SalaryTaxBracket::where(
            'resident_type',
            'resident'
        )
            ->orderBy('min_salary')
            ->get();

        $nonResidentBrackets = SalaryTaxBracket::where(
            'resident_type',
            'non_resident'
        )
            ->orderBy('min_salary')
            ->get();

        return view(
            'public.salary_tax.index',
            compact(
                'residentBrackets',
                'nonResidentBrackets'
            )
        );
    }

    public function calculate(
        Request $request,
        TaxCalculationService $taxService
    ) {

        $request->validate([

            'salary' => [
                'required',
                'numeric',
                'min:0'
            ],

            'currency' => [
                'required',
                'in:KHR,USD'
            ],

            'residency_status' => [
                'required',
                'in:resident,non_resident'
            ],

            'spouse_count' => [
                'required',
                'integer',
                'min:0'
            ],

            'dependents' => [
                'required',
                'integer',
                'min:0'
            ],
        ]);

        $employee = new Employee([

            'salary' =>
            $request->salary,

            'currency' =>
            $request->currency,

            'residency_status' =>
            $request->residency_status,

            'spouse_count' =>
            $request->spouse_count,

            'dependents' =>
            $request->dependents,

            'fringe_benefit_khr' =>
            0,
        ]);

        $result =
            $taxService
            ->calculateEmployeeSalaryTax(
                $employee
            );

        $grossSalary =
            $request->currency === 'USD'
            ? $request->salary * 4100
            : $request->salary;

        /*
|--------------------------------------------------------------------------
| Tax Tables
|--------------------------------------------------------------------------
*/

        $residentBrackets = SalaryTaxBracket::where(
            'resident_type',
            'resident'
        )
            ->orderBy('min_salary')
            ->get();

        $nonResidentBrackets = SalaryTaxBracket::where(
            'resident_type',
            'non_resident'
        )
            ->orderBy('min_salary')
            ->get();

        return view(
            'public.salary_tax.index',
            compact(
                'result',
                'grossSalary',
                'residentBrackets',
                'nonResidentBrackets'
            )
        );
    }
}
