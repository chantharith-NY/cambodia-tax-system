<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalaryTaxBracket;
use Illuminate\Http\Request;

class SalaryTaxBracketController extends Controller
{
    public function index()
    {
        $salaryTaxBrackets = SalaryTaxBracket::orderBy('resident_type')
            ->orderBy('min_salary')
            ->get();

        return view(
            'admin.salary-tax-brackets.index',
            compact('salaryTaxBrackets')
        );
    }

    public function create()
    {
        return view(
            'admin.salary-tax-brackets.create'
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'resident_type' => ['required'],
            'min_salary' => ['required', 'numeric'],
            'max_salary' => ['nullable', 'numeric'],
            'tax_rate' => ['required', 'numeric'],
            'effective_date' => ['required', 'date'],
            'deduction_amount' => ['required', 'numeric', 'min:0'],
        ]);

        SalaryTaxBracket::create($validated);

        return redirect()
            ->route('admin.salary-tax-brackets.index')
            ->with(
                'success',
                'Salary tax bracket created successfully.'
            );
    }

    public function edit(string $id)
    {
        $salaryTaxBracket = SalaryTaxBracket::findOrFail($id);

        return view(
            'admin.salary-tax-brackets.edit',
            compact('salaryTaxBracket')
        );
    }

    public function update(Request $request, string $id)
    {
        $salaryTaxBracket = SalaryTaxBracket::findOrFail($id);

        $validated = $request->validate([
            'resident_type' => ['required'],
            'min_salary' => ['required', 'numeric'],
            'max_salary' => ['nullable', 'numeric'],
            'tax_rate' => ['required', 'numeric'],
            'effective_date' => ['required', 'date'],
            'deduction_amount' => ['required', 'numeric', 'min:0'],
        ]);

        $salaryTaxBracket->update($validated);

        return redirect()
            ->route('admin.salary-tax-brackets.index')
            ->with(
                'success',
                'Salary tax bracket updated successfully.'
            );
    }

    public function destroy(string $id)
    {
        $salaryTaxBracket = SalaryTaxBracket::findOrFail($id);

        $salaryTaxBracket->delete();

        return redirect()
            ->route('admin.salary-tax-brackets.index')
            ->with(
                'success',
                'Salary tax bracket deleted successfully.'
            );
    }
}
