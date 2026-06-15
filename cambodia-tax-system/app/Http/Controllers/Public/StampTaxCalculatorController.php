<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\TaxCalculationService;
use Illuminate\Http\Request;

class StampTaxCalculatorController extends Controller
{
    public function index()
    {
        return view(
            'public.stamp_tax.index'
        );
    }

    public function calculate(
        Request $request,
        TaxCalculationService $taxService
    ) {

        $validated =
            $request->validate([

                'property_value' => [
                    'required',
                    'numeric',
                    'min:0'
                ]
            ]);

        $result =
            $taxService
            ->calculateStampTax(
                $validated['property_value']
            );

        return view(
            'public.stamp_tax.index',
            compact('result')
        );
    }
}
