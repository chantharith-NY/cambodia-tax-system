<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()
            ->paginate(10);

        return view(
            'business.employees.index',
            compact('employees')
        );
    }

    public function create()
    {
        return view(
            'business.employees.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_code' => ['required'],
            'name' => ['required'],
            'position' => ['required'],
            'salary' => ['required', 'numeric'],
        ]);

        $company = $request->user()
            ->getCurrentCompany();

        Employee::create([
            'company_id' => $company->id,
            'employee_code' => $request->employee_code,
            'name' => $request->name,
            'position' => $request->position,
            'salary' => $request->salary,
        ]);

        return redirect()
            ->route('business.employees.index')
            ->with(
                'success',
                'Employee created successfully.'
            );
    }

    public function show(Employee $employee)
    {
        return view(
            'business.employees.show',
            compact('employee')
        );
    }

    public function edit(Employee $employee)
    {
        return view(
            'business.employees.edit',
            compact('employee')
        );
    }

    public function update(
        Request $request,
        Employee $employee
    ) {
        $request->validate([
            'employee_code' => ['required'],
            'name' => ['required'],
            'position' => ['required'],
            'salary' => ['required', 'numeric'],
        ]);

        $employee->update([
            'employee_code' => $request->employee_code,
            'name' => $request->name,
            'position' => $request->position,
            'salary' => $request->salary,
        ]);

        return redirect()
            ->route('business.employees.index')
            ->with(
                'success',
                'Employee updated successfully.'
            );
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('business.employees.index')
            ->with(
                'success',
                'Employee deleted successfully.'
            );
    }
}
