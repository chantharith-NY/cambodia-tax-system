<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncomeTaxBracket;
use Illuminate\Http\Request;

class IncomeTaxBracketController extends Controller
{
    public function index()
    {
        $incomeTaxBrackets = IncomeTaxBracket::orderBy('taxpayer_type')
            ->orderBy('min_profit')
            ->get();

        return view(
            'admin.income-tax-brackets.index',
            compact('incomeTaxBrackets')
        );
    }

    public function create()
    {
        return view(
            'admin.income-tax-brackets.create'
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'taxpayer_type' => ['required'],
            'min_profit' => ['required', 'numeric'],
            'max_profit' => ['nullable', 'numeric'],
            'tax_rate' => ['required', 'numeric'],
            'deduction_amount' => ['required', 'numeric'],
            'effective_date' => ['required', 'date'],
        ]);

        IncomeTaxBracket::create($validated);

        return redirect()
            ->route('admin.income-tax-brackets.index')
            ->with(
                'success',
                'Income tax bracket created successfully.'
            );
    }

    public function edit(string $id)
    {
        $incomeTaxBracket = IncomeTaxBracket::findOrFail($id);

        return view(
            'admin.income-tax-brackets.edit',
            compact('incomeTaxBracket')
        );
    }

    public function update(Request $request, string $id)
    {
        $incomeTaxBracket = IncomeTaxBracket::findOrFail($id);

        $validated = $request->validate([
            'taxpayer_type' => ['required'],
            'min_profit' => ['required', 'numeric'],
            'max_profit' => ['nullable', 'numeric'],
            'tax_rate' => ['required', 'numeric'],
            'deduction_amount' => ['required', 'numeric'],
            'effective_date' => ['required', 'date'],
        ]);

        $incomeTaxBracket->update($validated);

        return redirect()
            ->route('admin.income-tax-brackets.index')
            ->with(
                'success',
                'Income tax bracket updated successfully.'
            );
    }

    public function destroy(string $id)
    {
        IncomeTaxBracket::findOrFail($id)->delete();

        return redirect()
            ->route('admin.income-tax-brackets.index')
            ->with(
                'success',
                'Income tax bracket deleted successfully.'
            );
    }
}
