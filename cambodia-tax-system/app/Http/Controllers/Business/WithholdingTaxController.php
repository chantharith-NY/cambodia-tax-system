<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\WithholdingTax;
use App\Services\WithholdingTaxService;
use Illuminate\Http\Request;

class WithholdingTaxController extends Controller
{
    public function index()
    {
        $withholdingTaxes =
            WithholdingTax::latest()
            ->paginate(10);

        return view(
            'business.withholding_taxes.index',
            compact('withholdingTaxes')
        );
    }

    public function create()
    {
        return view(
            'business.withholding_taxes.create'
        );
    }

    public function store(
        Request $request,
        WithholdingTaxService $service
    ) {

        $request->validate([

            'vendor_name' => [
                'required'
            ],

            'payment_type' => [
                'required'
            ],

            'gross_amount' => [
                'required',
                'numeric'
            ],

            'payment_date' => [
                'required',
                'date'
            ],
        ]);

        $exchangeRate =
            $request->exchange_rate ?? 4100;

        $grossAmountKHR =
            $request->currency === 'USD'
            ? $request->gross_amount * $exchangeRate
            : $request->gross_amount;

        $result = $service->calculate(
            $grossAmountKHR,
            $request->payment_type
        );

        $company =
            $request->user()
            ->getCurrentCompany();

        WithholdingTax::create([

            'company_id' =>
            $company->id,

            'vendor_name' =>
            $request->vendor_name,

            'payment_type' =>
            $request->payment_type,

            'gross_amount' =>
            $result['gross_amount_khr'],

            'tax_rate' =>
            $result['rate'] * 100,

            'withholding_tax' =>
            $result['withholding_tax_khr'],

            'net_amount' =>
            $result['net_amount_khr'],

            'payment_date' =>
            $request->payment_date,

            'currency' =>
            $request->currency,

            'exchange_rate' =>
            $exchangeRate,

            'description' =>
            $request->description,
        ]);

        return redirect()
            ->route(
                'business.withholding-taxes.index'
            )
            ->with(
                'success',
                'Withholding tax created successfully.'
            );
    }

    public function show(
        WithholdingTax $withholdingTax
    ) {
        return view(
            'business.withholding_taxes.show',
            compact('withholdingTax')
        );
    }

    public function edit(
        WithholdingTax $withholdingTax
    ) {
        return view(
            'business.withholding_taxes.edit',
            compact('withholdingTax')
        );
    }

    public function update(
        Request $request,
        WithholdingTax $withholdingTax,
        WithholdingTaxService $service
    ) {

        $exchangeRate =
            $request->exchange_rate ?? 4100;

        $grossAmountKHR =
            $request->currency === 'USD'
            ? $request->gross_amount * $exchangeRate
            : $request->gross_amount;

        $result =
            $service->calculate(
                $grossAmountKHR,
                $request->payment_type
            );

        $withholdingTax->update([

            'vendor_name' =>
            $request->vendor_name,

            'payment_type' =>
            $request->payment_type,

            'gross_amount' =>
            $result['gross_amount_khr'],

            'tax_rate' =>
            $result['rate'] * 100,

            'withholding_tax' =>
            $result['withholding_tax_khr'],

            'net_amount' =>
            $result['net_amount_khr'],

            'payment_date' =>
            $request->payment_date,

            'currency' =>
            $request->currency,

            'exchange_rate' =>
            $exchangeRate,

            'description' =>
            $request->description,
        ]);

        return redirect()
            ->route(
                'business.withholding-taxes.index'
            )
            ->with(
                'success',
                'Withholding tax updated successfully.'
            );
    }

    public function destroy(
        WithholdingTax $withholdingTax
    ) {
        $withholdingTax->delete();

        return redirect()
            ->route(
                'business.withholding-taxes.index'
            )
            ->with(
                'success',
                'Withholding tax deleted successfully.'
            );
    }
}
