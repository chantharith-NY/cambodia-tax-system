<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Payroll;
use App\Services\TaxCalculationService;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of payrolls.
     */
    public function index()
    {
        $payrolls = Payroll::with('employee')
            ->latest()
            ->paginate(10);

        return view(
            'business.payrolls.index',
            compact('payrolls')
        );
    }

    /**
     * Show create payroll form.
     */
    public function create()
    {
        $employees = Employee::orderBy('name')
            ->get();

        return view(
            'business.payrolls.create',
            compact('employees')
        );
    }

    /**
     * Store payroll.
     */
    public function store(
        Request $request,
        TaxCalculationService $taxService
    ) {
        $request->validate([
            'employee_id' => [
                'required',
                'exists:employees,id'
            ],

            'payroll_month' => [
                'required',
                'date'
            ],
        ]);

        $employee = Employee::findOrFail(
            $request->employee_id
        );

        $salaryResult =
            $taxService->calculateEmployeeSalaryTax(
                $employee
            );

        $grossSalary =
            $employee->currency === 'USD'
            ? $employee->salary * 4100
            : $employee->salary;

        Payroll::create([

            'employee_id' =>
            $employee->id,

            'payroll_month' =>
            $request->payroll_month,

            'gross_salary' =>
            $grossSalary,

            'salary_tax' =>
            $salaryResult['salary_tax'],

            'net_salary' =>
            $grossSalary
                -
                $salaryResult['salary_tax'],
        ]);

        return redirect()
            ->route('business.payrolls.index')
            ->with(
                'success',
                'Payroll created successfully.'
            );
    }

    /**
     * Show payroll details.
     */
    public function show(Payroll $payroll)
    {
        $payroll->load('employee');

        return view(
            'business.payrolls.show',
            compact('payroll')
        );
    }

    /**
     * Show edit form.
     */
    public function edit(
        Payroll $payroll
    ) {
        $employees = Employee::orderBy('name')
            ->get();

        return view(
            'business.payrolls.edit',
            compact(
                'payroll',
                'employees'
            )
        );
    }

    /**
     * Update payroll.
     */
    public function update(
        Request $request,
        Payroll $payroll,
        TaxCalculationService $taxService
    ) {
        $request->validate([
            'employee_id' => [
                'required',
                'exists:employees,id'
            ],

            'payroll_month' => [
                'required',
                'date'
            ],
        ]);

        $employee = Employee::findOrFail(
            $request->employee_id
        );

        $salaryResult =
            $taxService->calculateEmployeeSalaryTax(
                $employee
            );

        $grossSalary =
            $employee->currency === 'USD'
            ? $employee->salary * 4100
            : $employee->salary;

        $payroll->update([

            'employee_id' =>
            $employee->id,

            'payroll_month' =>
            $request->payroll_month,

            'gross_salary' =>
            $grossSalary,

            'salary_tax' =>
            $salaryResult['salary_tax'],

            'net_salary' =>
            $grossSalary
                -
                $salaryResult['salary_tax'],
        ]);

        return redirect()
            ->route('business.payrolls.index')
            ->with(
                'success',
                'Payroll updated successfully.'
            );
    }

    /**
     * Delete payroll.
     */
    public function destroy(
        Payroll $payroll
    ) {
        $payroll->delete();

        return redirect()
            ->route('business.payrolls.index')
            ->with(
                'success',
                'Payroll deleted successfully.'
            );
    }
}
