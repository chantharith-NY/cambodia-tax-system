<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::latest()
            ->paginate(10);

        return view(
            'business.expenses.index',
            compact('expenses')
        );
    }

    public function create()
    {
        return view(
            'business.expenses.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => ['required'],
            'category' => ['required'],
            'amount' => ['required', 'numeric'],
            'expense_date' => ['required', 'date'],
        ]);

        $vatIncluded = $request->boolean('vat_included');

        if ($vatIncluded) {

            $baseAmount = round(
                $request->amount / 1.10,
                2
            );

            $vatAmount = round(
                $request->amount - $baseAmount,
                2
            );
        } else {

            $baseAmount = $request->amount;

            $vatAmount = round(
                $request->amount * 0.10,
                2
            );
        }

        $company = $request->user()
            ->getCurrentCompany();

        Expense::create([
            'company_id' => $company->id,

            'supplier_name' => $request->supplier_name,

            'category' => $request->category,

            'amount' => $request->amount,

            'vat_included' => $vatIncluded,

            'base_amount' => $baseAmount,

            'vat_amount' => $vatAmount,

            'description' => $request->description,

            'expense_date' => $request->expense_date,
        ]);

        return redirect()
            ->route('business.expenses.index')
            ->with(
                'success',
                'Expense created successfully.'
            );
    }

    public function show(Expense $expense)
    {
        return view(
            'business.expenses.show',
            compact('expense')
        );
    }

    public function edit(Expense $expense)
    {
        return view(
            'business.expenses.edit',
            compact('expense')
        );
    }

    public function update(
        Request $request,
        Expense $expense
    ) {

        $request->validate([
            'supplier_name' => ['required'],
            'category' => ['required'],
            'amount' => ['required', 'numeric'],
            'expense_date' => ['required', 'date'],
        ]);

        $vatIncluded = $request->boolean('vat_included');

        if ($vatIncluded) {

            $baseAmount = round(
                $request->amount / 1.10,
                2
            );

            $vatAmount = round(
                $request->amount - $baseAmount,
                2
            );
        } else {

            $baseAmount = $request->amount;

            $vatAmount = round(
                $request->amount * 0.10,
                2
            );
        }

        $expense->update([
            'supplier_name' => $request->supplier_name,

            'category' => $request->category,

            'amount' => $request->amount,

            'vat_included' => $vatIncluded,

            'base_amount' => $baseAmount,

            'vat_amount' => $vatAmount,

            'description' => $request->description,

            'expense_date' => $request->expense_date,
        ]);

        return redirect()
            ->route('business.expenses.index')
            ->with(
                'success',
                'Expense updated successfully.'
            );
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()
            ->route('business.expenses.index')
            ->with(
                'success',
                'Expense deleted successfully.'
            );
    }
}
