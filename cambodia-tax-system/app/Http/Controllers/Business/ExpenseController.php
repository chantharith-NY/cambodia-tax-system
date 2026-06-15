<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    private const CATEGORIES = [

        'rental',
        'service',
        'interest',
        'royalty',

        'utility',
        'internet',
        'fuel',

        'salary',

        'office_supply',
        'equipment',

        'transportation',

        'other',
    ];
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
            'supplier_type' => ['required'],
            'category' => [
                'required',
                'in:' . implode(',', self::CATEGORIES)
            ],
            'amount' => ['required', 'numeric'],
            'expense_date' => ['required', 'date'],
        ]);

        $currency =
            $request->currency
            ?? 'KHR';

        $exchangeRate =
            $request->exchange_rate
            ?? 4100;

        $amountKHR =
            $currency === 'USD'
            ? $request->amount * $exchangeRate
            : $request->amount;

        /*
        |--------------------------------------------------------------------------
        | Withholding Tax
        |--------------------------------------------------------------------------
        */

        $withholdingRate = 0;

        if (
            $request->supplier_type === 'resident'
        ) {
            switch ($request->category) {

                case 'rental':
                    $withholdingRate = 10;
                    break;

                case 'service':
                case 'interest':
                case 'royalty':
                    $withholdingRate = 15;
                    break;

                default:
                    $withholdingRate = 0;
            }
        }

        if (
            $request->supplier_type === 'non_resident'
        ) {
            $withholdingRate = 14;
        }

        $withholdingTax = round($amountKHR * ($withholdingRate / 100), 2);
        $netPayment = $amountKHR - $withholdingTax;

        /*
        |--------------------------------------------------------------------------
        | VAT
        |--------------------------------------------------------------------------
        */

        $vatIncluded = $request->boolean('vat_included');
        $hasVatInvoice =
            $request->boolean('has_vat_invoice');

        if (!$hasVatInvoice) {

            $baseAmount = $amountKHR;

            $vatAmount = 0;
        } else {

            if ($vatIncluded) {

                $baseAmount = round(
                    $amountKHR / 1.10,
                    2
                );

                $vatAmount = round(
                    $amountKHR - $baseAmount,
                    2
                );
            } else {

                $baseAmount = $amountKHR;

                $vatAmount = round(
                    $amountKHR * 0.10,
                    2
                );
            }
        }

        $company = $request->user()
            ->getCurrentCompany();

        Expense::create([
            'company_id' => $company->id,
            'supplier_name' => $request->supplier_name,
            'supplier_type' => $request->supplier_type,
            'category' => $request->category,
            'amount' => $request->amount,
            'currency' => $currency,
            'exchange_rate' => $exchangeRate,
            'amount_khr' => $amountKHR,
            'withholding_rate' => $withholdingRate,
            'withholding_tax' => $withholdingTax,
            'net_payment' => $netPayment,
            'has_vat_invoice' => $hasVatInvoice,
            'vat_included' => $vatIncluded,
            'base_amount' => $baseAmount,
            'vat_amount' => $vatAmount,
            'description' => $request->description,
            'expense_date' => $request->expense_date,
        ]);

        return redirect()
            ->route(
                'business.expenses.index'
            )
            ->with(
                'success',
                'Expense created successfully.'
            );
    }

    public function show(
        Expense $expense
    ) {
        return view(
            'business.expenses.show',
            compact('expense')
        );
    }

    public function edit(
        Expense $expense
    ) {
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
            'supplier_type' => ['required'],
            'category' => [
                'required',
                'in:' . implode(',', self::CATEGORIES)
            ],
            'amount' => ['required', 'numeric'],
            'expense_date' => ['required', 'date'],
        ]);

        $currency =
            $request->currency
            ?? $expense->currency
            ?? 'KHR';

        $exchangeRate =
            $request->exchange_rate
            ?? $expense->exchange_rate
            ?? 4100;

        $amountKHR =
            $currency === 'USD'
            ? $request->amount * $exchangeRate
            : $request->amount;

        /*
        |--------------------------------------------------------------------------
        | Withholding Tax
        |--------------------------------------------------------------------------
        */

        $withholdingRate = 0;

        if (
            $request->supplier_type === 'resident'
        ) {
            switch ($request->category) {

                case 'rental':
                    $withholdingRate = 10;
                    break;

                case 'service':
                case 'interest':
                case 'royalty':
                    $withholdingRate = 15;
                    break;

                default:
                    $withholdingRate = 0;
            }
        }
        if (
            $request->supplier_type === 'non_resident'
        ) {
            $withholdingRate = 14;
        }
        $withholdingTax = round($amountKHR * ($withholdingRate / 100), 2);
        $netPayment = $amountKHR - $withholdingTax;

        /*
        |--------------------------------------------------------------------------
        | VAT
        |--------------------------------------------------------------------------
        */

        $vatIncluded =
            $request->boolean('vat_included');

        $hasVatInvoice =
            $request->boolean('has_vat_invoice');

        if (!$hasVatInvoice) {

            $baseAmount = $amountKHR;

            $vatAmount = 0;
        } else {

            if ($vatIncluded) {

                $baseAmount = round(
                    $amountKHR / 1.10,
                    2
                );

                $vatAmount = round(
                    $amountKHR - $baseAmount,
                    2
                );
            } else {

                $baseAmount = $amountKHR;

                $vatAmount = round(
                    $amountKHR * 0.10,
                    2
                );
            }
        }

        $expense->update([
            'supplier_name' => $request->supplier_name,
            'supplier_type' => $request->supplier_type,
            'category' => $request->category,
            'amount' => $request->amount,
            'currency' => $currency,
            'exchange_rate' => $exchangeRate,
            'amount_khr' => $amountKHR,
            'withholding_rate' => $withholdingRate,
            'withholding_tax' => $withholdingTax,
            'net_payment' => $netPayment,
            'has_vat_invoice' => $request->boolean('has_vat_invoice'),
            'vat_included' => $vatIncluded,
            'base_amount' => $baseAmount,
            'vat_amount' => $vatAmount,
            'description' => $request->description,
            'expense_date' => $request->expense_date,
        ]);

        return redirect()
            ->route(
                'business.expenses.index'
            )
            ->with(
                'success',
                'Expense updated successfully.'
            );
    }

    public function destroy(
        Expense $expense
    ) {
        $expense->delete();

        return redirect()
            ->route(
                'business.expenses.index'
            )
            ->with(
                'success',
                'Expense deleted successfully.'
            );
    }
}
