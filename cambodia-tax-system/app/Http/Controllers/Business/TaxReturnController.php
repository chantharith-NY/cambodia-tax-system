<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\TaxReturn;
use Illuminate\Http\Request;
use App\Services\TaxCalculationService;

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
        TaxCalculationService $service
    ) {
        $request->validate([
            'tax_month' => [
                'required',
                'date'
            ]
        ]);

        $company = $request->user()
            ->getCurrentCompany();

        if (!$company) {

            return back()->with(
                'error',
                'Please create a company first.'
            );
        }

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

        $summary =
            $service->generateMonthlyTaxReturn(
                $company->id,
                $taxMonth->format('Y-m-d')
            );

        TaxReturn::create([

            'company_id' =>
            $company->id,

            'tax_month' =>
            $taxMonth,

            'total_revenue' =>
            $summary['total_revenue'],

            'total_expense' =>
            $summary['total_expense'],

            'profit' =>
            $summary['profit'],

            'output_vat' =>
            $summary['output_vat'],

            'input_vat' =>
            $summary['input_vat'],

            'vat_payable' =>
            $summary['vat_payable'],

            'salary_tax' =>
            $summary['salary_tax'],

            'withholding_tax' =>
            $summary['withholding_tax'],

            'prepayment_tax' =>
            $summary['prepayment_tax'],

            'total_tax_due' =>
            $summary['total_tax_due'],

            'total_payroll' =>
            $summary['total_payroll'] ?? 0,

            'status' =>
            'draft',
        ]);

        return redirect()
            ->route(
                'business.tax-returns.index'
            )
            ->with(
                'success',
                'Tax Return generated successfully.'
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
