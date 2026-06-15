<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index()
    {
        $revenues = Revenue::latest()
            ->paginate(10);

        return view(
            'business.revenues.index',
            compact('revenues')
        );
    }

    public function create()
    {
        return view(
            'business.revenues.create'
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_no' => ['required'],
            'customer_name' => ['required'],
            'amount' => ['required', 'numeric'],
            'vat_included' => ['required'],
            'invoice_date' => ['required', 'date'],
        ]);

        $exchangeRate = $request->exchange_rate ?? 4100;

        $amountKHR = $request->currency === 'USD'
            ? $request->amount * $exchangeRate
            : $request->amount;

        $hasVatInvoice =
            $request->boolean('has_vat_invoice');

        $vatIncluded =
            $request->boolean('vat_included');

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

        $company = $request->user()->getCurrentCompany();

        if (!$company) {
            return redirect()
                ->route('business.company.create')
                ->with(
                    'error',
                    'Please create your company profile first.'
                );
        }

        Revenue::create([

            'company_id' => $company->id,

            'invoice_no' => $request->invoice_no,

            'customer_name' => $request->customer_name,

            'amount' => $request->amount,
            'currency' => $request->currency,
            'exchange_rate' => $exchangeRate,
            'amount_khr' => $amountKHR,

            'has_vat_invoice' => $hasVatInvoice,

            'vat_included' => $vatIncluded,

            'base_amount' => $baseAmount,

            'vat_amount' => $vatAmount,

            'invoice_date' => $request->invoice_date,
        ]);

        return redirect()
            ->route('business.revenues.index')
            ->with(
                'success',
                'Revenue created successfully.'
            );
    }

    public function show(Revenue $revenue)
    {
        return view(
            'business.revenues.show',
            compact('revenue')
        );
    }

    public function edit(Revenue $revenue)
    {
        return view(
            'business.revenues.edit',
            compact('revenue')
        );
    }

    public function update(
        Request $request,
        Revenue $revenue
    ) {

        $validated = $request->validate([
            'invoice_no' => ['required'],
            'customer_name' => ['required'],
            'amount' => ['required', 'numeric'],
            'vat_included' => ['required'],
            'invoice_date' => ['required', 'date'],
        ]);

        $exchangeRate = $request->exchange_rate ?? 4100;

        $amountKHR = $request->currency === 'USD'
            ? $request->amount * $exchangeRate
            : $request->amount;

        $hasVatInvoice =
            $request->boolean('has_vat_invoice');

        $vatIncluded =
            $request->boolean('vat_included');

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

        $revenue->update([
            'invoice_no' => $request->invoice_no,
            'customer_name' => $request->customer_name,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'exchange_rate' => $exchangeRate,
            'amount_khr' => $amountKHR,
            'has_vat_invoice' => $hasVatInvoice,
            'vat_included' => $vatIncluded,
            'base_amount' => $baseAmount,
            'vat_amount' => $vatAmount,
            'invoice_date' => $request->invoice_date,
        ]);

        return redirect()
            ->route('business.revenues.index')
            ->with(
                'success',
                'Revenue updated successfully.'
            );
    }

    public function destroy(Revenue $revenue)
    {
        $revenue->delete();

        return redirect()
            ->route('business.revenues.index')
            ->with(
                'success',
                'Revenue deleted successfully.'
            );
    }
}
