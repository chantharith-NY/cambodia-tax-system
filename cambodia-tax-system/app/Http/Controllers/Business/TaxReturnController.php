<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\TaxReturn;
use App\Services\TaxReturnService;
use Illuminate\Http\Request;

use Carbon\Carbon;

class TaxReturnController extends Controller
{
    public function index()
    {
        $taxReturns = TaxReturn::latest()
            ->paginate(10);

        return view(
            'business.tax_returns.index',
            compact('taxReturns')
        );
    }

    public function create()
    {
        return view(
            'business.tax_returns.create'
        );
    }

    public function store(
        Request $request,
        TaxReturnService $service
    ) {

        $request->validate([
            'tax_month' => [
                'required',
                'date'
            ]
        ]);

        $company = $request->user()
            ->getCurrentCompany();


        $taxMonth = Carbon::parse(
            $request->tax_month . '-01'
        )->startOfMonth();

        $exists = TaxReturn::where(
            'company_id',
            $company->id
        )
            ->whereDate(
                'tax_month',
                $taxMonth
            )
            ->exists();

        if ($exists) {

            return back()->with(
                'error',
                'Tax return already generated.'
            );
        }

        $summary = $service->generate(
            $company->id,
            $taxMonth->format('Y-m-d')
        );

        TaxReturn::create([
            'company_id' => $company->id,
            'tax_month' => $taxMonth,
            ...$summary
        ]);

        return redirect()
            ->route(
                'business.tax-returns.index'
            )
            ->with(
                'success',
                'Tax Return generated.'
            );
    }

    public function show(
        TaxReturn $taxReturn
    ) {
        return view(
            'business.tax_returns.show',
            compact('taxReturn')
        );
    }

    public function submit(TaxReturn $taxReturn)
    {
        $taxReturn->update([
            'status' => 'submitted'
        ]);

        return back()->with(
            'success',
            'Tax return submitted.'
        );
    }

    public function markPaid(TaxReturn $taxReturn)
    {
        $taxReturn->update([
            'status' => 'paid'
        ]);

        return back()->with(
            'success',
            'Tax return marked as paid.'
        );
    }
}
