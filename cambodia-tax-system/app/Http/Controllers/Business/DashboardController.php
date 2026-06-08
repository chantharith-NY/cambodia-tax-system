<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Revenue;
use App\Models\Expense;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $company = $request->user()->getCurrentCompany();

        if (!$company) {
            return redirect()
                ->route('business.company.create');
        }

        $totalRevenue = Revenue::where(
            'company_id',
            $company->id
        )->sum('amount');

        $totalExpense = Expense::where(
            'company_id',
            $company->id
        )->sum('amount');

        $profit = $totalRevenue - $totalExpense;

        $outputVat = Revenue::where(
            'company_id',
            $company->id
        )->sum('vat_amount');

        $inputVat = Expense::where(
            'company_id',
            $company->id
        )->sum('vat_amount');

        $vatPayable = $outputVat - $inputVat;

        return view(
            'business.dashboard',
            compact(
                'totalRevenue',
                'totalExpense',
                'profit',
                'vatPayable'
            )
        );
    }
}
