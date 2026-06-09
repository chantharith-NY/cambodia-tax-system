<?php

namespace App\Services;

use App\Models\Revenue;
use App\Models\Expense;
use App\Models\Payroll;
// use App\Models\WithholdingTax;
use Carbon\Carbon;

class TaxReturnService
{
    public function generate(
        int $companyId,
        string $month
    ): array {

        $startDate = Carbon::parse($month)
            ->startOfMonth();

        $endDate = Carbon::parse($month)
            ->endOfMonth();

        /*
        |--------------------------------------------------------------------------
        | Revenue
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Revenue::where(
            'company_id',
            $companyId
        )
            ->whereBetween(
                'invoice_date',
                [$startDate, $endDate]
            )
            ->sum('amount_khr');

        $outputVat = Revenue::where(
            'company_id',
            $companyId
        )
            ->whereBetween(
                'invoice_date',
                [$startDate, $endDate]
            )
            ->sum('vat_amount');

        /*
        |--------------------------------------------------------------------------
        | Expense
        |--------------------------------------------------------------------------
        */

        $totalExpense = Expense::where(
            'company_id',
            $companyId
        )
            ->whereBetween(
                'expense_date',
                [$startDate, $endDate]
            )
            ->sum('amount_khr');

        // $inputVat = Expense::where(
        //     'company_id',
        //     $companyId
        // )
        //     ->whereBetween(
        //         'expense_date',
        //         [$startDate, $endDate]
        //     )
        //     ->sum('vat_amount');

        $inputVat = Expense::where(
            'company_id',
            $companyId
        )
            ->where(
                'has_vat_invoice',
                true
            )
            ->whereBetween(
                'expense_date',
                [$startDate, $endDate]
            )
            ->sum('vat_amount');

        /*
        |--------------------------------------------------------------------------
        | Payroll
        |--------------------------------------------------------------------------
        */

        $totalPayroll = Payroll::whereHas(
            'employee',
            fn($q) => $q->where(
                'company_id',
                $companyId
            )
        )
            ->whereMonth(
                'payroll_month',
                $startDate->month
            )
            ->whereYear(
                'payroll_month',
                $startDate->year
            )
            ->sum('gross_salary');

        $salaryTax = Payroll::whereHas(
            'employee',
            fn($q) => $q->where(
                'company_id',
                $companyId
            )
        )
            ->whereMonth(
                'payroll_month',
                $startDate->month
            )
            ->whereYear(
                'payroll_month',
                $startDate->year
            )
            ->sum('salary_tax');


        /*
        |--------------------------------------------------------------------------
        | Profit Before Tax
        |--------------------------------------------------------------------------
        */

        $profitBeforeTax =
            $totalRevenue
            -
            $totalExpense
            -
            $totalPayroll;

        /*
        |--------------------------------------------------------------------------
        | Profit Tax (20%)
        |--------------------------------------------------------------------------
        */

        $profitTax = $profitBeforeTax > 0
            ? round($profitBeforeTax * 0.20, 2)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Profit After Tax
        |--------------------------------------------------------------------------
        */

        $profitAfterTax =
            $profitBeforeTax
            -
            $profitTax;

        /*
        |--------------------------------------------------------------------------
        | Withholding Tax
        |--------------------------------------------------------------------------
        */

        // $withholdingTax = WithholdingTax::where(
        //     'company_id',
        //     $companyId
        // )
        //     ->whereBetween(
        //         'payment_date',
        //         [$startDate, $endDate]
        //     )
        //     ->sum('withholding_tax');

        $withholdingTax = Expense::where(
            'company_id',
            $companyId
        )
            ->whereBetween(
                'expense_date',
                [$startDate, $endDate]
            )
            ->sum('withholding_tax');

        /*
        |--------------------------------------------------------------------------
        | VAT
        |--------------------------------------------------------------------------
        */

        $vatPayable =
            $outputVat -
            $inputVat;

        /*
        |--------------------------------------------------------------------------
        | Prepayment Tax
        |--------------------------------------------------------------------------
        */

        $prepaymentTax = round(
            $totalRevenue * 0.01,
            2
        );

        /*
        |--------------------------------------------------------------------------
        | Total Tax Due
        |--------------------------------------------------------------------------
        */

        $totalTaxDue =
            $vatPayable
            +
            $salaryTax
            +
            $withholdingTax
            +
            $prepaymentTax;
        // +
        // $profitTax;

        return [

            'total_revenue' => $totalRevenue,

            'total_expense' => $totalExpense,

            'output_vat' => $outputVat,

            'input_vat' => $inputVat,

            'vat_payable' => $vatPayable,

            'salary_tax' => $salaryTax,

            'withholding_tax' => $withholdingTax,

            'prepayment_tax' => $prepaymentTax,

            'total_tax_due' => $totalTaxDue,

            'total_payroll' => $totalPayroll,

            'profit_before_tax' => $profitBeforeTax,

            'profit_tax' => $profitTax,

            'profit_after_tax' => $profitAfterTax,
        ];
    }
}
