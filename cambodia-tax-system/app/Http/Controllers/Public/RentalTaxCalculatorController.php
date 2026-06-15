<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\TaxCalculationService;
use Illuminate\Http\Request;

class RentalTaxCalculatorController extends Controller
{
    public function index()
    {
        return view(
            'public.rental_tax.index'
        );
    }

    public function calculate(
        Request $request,
        TaxCalculationService $taxService
    ) {

        $validated =
            $request->validate([

                'rental_income' => [
                    'required',
                    'numeric',
                    'min:0'
                ]
            ]);

        $result =
            $taxService
            ->calculateRentalTax(
                $validated['rental_income']
            );

        return view(
            'public.rental_tax.index',
            compact('result')
        );
    }
}
