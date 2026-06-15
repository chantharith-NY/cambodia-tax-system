<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\IncomeTaxBracket;
use App\Models\Payroll;
use App\Models\Revenue;
use App\Models\SalaryTaxBracket;
use App\Models\TaxSetting;
use Carbon\Carbon;

class TaxCalculationService
{
    const SPOUSE_DEDUCTION_KHR = 150000;
    const DEPENDENT_DEDUCTION_KHR = 150000;


    /*
    |--------------------------------------------------------------------------
    | Stamp Tax
    |--------------------------------------------------------------------------
    */
    public function calculateStampTax(
        float $propertyValue
    ): array {

        $rate = TaxSetting::getRate(
            'STAMP_TAX'
        );

        $stampTax =
            $propertyValue *
            ($rate / 100);

        return [

            'property_value' =>
            $propertyValue,

            'tax_rate' =>
            $rate,

            'stamp_tax' =>
            $stampTax,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Rental Tax
    |--------------------------------------------------------------------------
    */

    public function calculateRentalTax(
        float $rentalIncome
    ): array {

        $rate = TaxSetting::getRate(
            'RENTAL_TAX'
        );

        $tax =
            $rentalIncome *
            ($rate / 100);

        return [

            'rental_income' =>
            $rentalIncome,

            'tax_rate' =>
            $rate,

            'rental_tax' =>
            $tax,

            'net_income' =>
            $rentalIncome - $tax,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Salary Tax
    |--------------------------------------------------------------------------
    */

    public function calculateEmployeeSalaryTax(
        Employee $employee
    ): array {

        $salaryKHR =
            $employee->currency === 'USD'
            ? ((float) $employee->salary * 4100)
            : (float) $employee->salary;

        /*
        |--------------------------------------------------------------------------
        | Non Resident
        |--------------------------------------------------------------------------
        */

        if ($employee->residency_status === 'non_resident') {

            $bracket = SalaryTaxBracket::where(
                'resident_type',
                'non_resident'
            )->first();

            $rate = $bracket?->tax_rate ?? 20;

            $tax = $salaryKHR * ($rate / 100);

            return [
                'taxable_salary' => $salaryKHR,
                'salary_tax' => $tax,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Resident
        |--------------------------------------------------------------------------
        */

        $deduction =
            ($employee->spouse_count * self::SPOUSE_DEDUCTION_KHR)
            +
            ($employee->dependents * self::DEPENDENT_DEDUCTION_KHR);

        $taxableSalary = max(
            $salaryKHR - $deduction,
            0
        );

        $bracket = SalaryTaxBracket::where(
            'resident_type',
            'resident'
        )
            ->where(
                'min_salary',
                '<=',
                $taxableSalary
            )
            ->where(function ($query) use ($taxableSalary) {

                $query->where(
                    'max_salary',
                    '>=',
                    $taxableSalary
                )
                    ->orWhereNull(
                        'max_salary'
                    );
            })
            ->first();

        if (!$bracket) {

            return [
                'taxable_salary' => $taxableSalary,
                'salary_tax' => 0,
            ];
        }

        $salaryTax =
            (
                $taxableSalary *
                ($bracket->tax_rate / 100)
            )
            -
            $bracket->deduction_amount;

        return [

            'taxable_salary' => $taxableSalary,

            'salary_tax' => max(
                $salaryTax,
                0
            ),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | FBT
    |--------------------------------------------------------------------------
    */

    public function calculateEmployeeFBT(
        Employee $employee
    ): float {

        $rate = TaxSetting::getRate(
            'FBT'
        );

        return
            $employee->fringe_benefit_khr
            *
            ($rate / 100);
    }

    /*
    |--------------------------------------------------------------------------
    | VAT
    |--------------------------------------------------------------------------
    */

    public function calculateVAT(
        float $outputVat,
        float $inputVat
    ): array {

        return [

            'output_vat' => $outputVat,

            'input_vat' => $inputVat,

            'vat_payable' =>
            $outputVat - $inputVat,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | PTOI
    |--------------------------------------------------------------------------
    */

    public function calculatePTOI(
        float $revenue
    ): float {

        $rate = TaxSetting::getRate(
            'PTOI'
        );

        return
            $revenue *
            ($rate / 100);
    }

    /*
    |--------------------------------------------------------------------------
    | Income Tax
    |--------------------------------------------------------------------------
    */

    public function calculateIncomeTax(
        Company $company,
        float $profit
    ): float {

        $businessType =
            $company->business_type;

        /*
        |--------------------------------------------------------------------------
        | Sole Proprietor
        |--------------------------------------------------------------------------
        */

        if (
            $businessType ===
            'sole_proprietor'
        ) {

            $bracket =
                IncomeTaxBracket::where(
                    'taxpayer_type',
                    'sole_proprietor'
                )
                ->where(
                    'min_profit',
                    '<=',
                    $profit
                )
                ->where(function ($query) use ($profit) {

                    $query->where(
                        'max_profit',
                        '>=',
                        $profit
                    )
                        ->orWhereNull(
                            'max_profit'
                        );
                })
                ->first();

            if (!$bracket) {
                return 0;
            }

            return max(
                (
                    $profit *
                    (
                        $bracket->tax_rate
                        / 100
                    )
                )
                    -
                    $bracket->deduction_amount,
                0
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Other Types
        |--------------------------------------------------------------------------
        */

        $config =
            IncomeTaxBracket::where(
                'taxpayer_type',
                $businessType
            )->first();

        if (!$config) {
            return 0;
        }

        return
            $profit *
            (
                $config->tax_rate
                / 100
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Monthly Tax Return
    |--------------------------------------------------------------------------
    */

    public function generateMonthlyTaxReturn(
        int $companyId,
        string $month
    ): array {

        $startDate = Carbon::parse(
            $month
        )->startOfMonth();

        $endDate = Carbon::parse(
            $month
        )->endOfMonth();

        $company =
            Company::findOrFail(
                $companyId
            );

        /*
        |--------------------------------------------------------------------------
        | Revenue
        |--------------------------------------------------------------------------
        */

        $totalRevenue =
            Revenue::where(
                'company_id',
                $companyId
            )
            ->whereBetween(
                'invoice_date',
                [$startDate, $endDate]
            )
            ->sum(
                'amount_khr'
            );

        $outputVat =
            Revenue::where(
                'company_id',
                $companyId
            )
            ->whereBetween(
                'invoice_date',
                [$startDate, $endDate]
            )
            ->sum(
                'vat_amount'
            );

        /*
        |--------------------------------------------------------------------------
        | Expense
        |--------------------------------------------------------------------------
        */

        $totalExpense =
            Expense::where(
                'company_id',
                $companyId
            )
            ->whereBetween(
                'expense_date',
                [$startDate, $endDate]
            )
            ->sum(
                'amount_khr'
            );

        $inputVat =
            Expense::where(
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
            ->sum(
                'vat_amount'
            );

        /*
        |--------------------------------------------------------------------------
        | Payroll
        |--------------------------------------------------------------------------
        */

        $salaryTax =
            Payroll::whereHas(
                'employee',
                fn($query) =>
                $query->where(
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
            ->sum(
                'salary_tax'
            );

        $totalPayroll =
            Payroll::whereHas(
                'employee',
                fn($query) =>
                $query->where(
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
            ->sum(
                'gross_salary'
            );

        /*
        |--------------------------------------------------------------------------
        | WHT
        |--------------------------------------------------------------------------
        */

        $withholdingTax =
            Expense::where(
                'company_id',
                $companyId
            )
            ->whereBetween(
                'expense_date',
                [$startDate, $endDate]
            )
            ->sum(
                'withholding_tax'
            );

        /*
        |--------------------------------------------------------------------------
        | Profit
        |--------------------------------------------------------------------------
        */

        $profit =
            $totalRevenue -
            $totalExpense;

        /*
        |--------------------------------------------------------------------------
        | FBT
        |--------------------------------------------------------------------------
        */

        $totalFringeBenefit =
            Employee::where(
                'company_id',
                $companyId
            )
            ->sum(
                'fringe_benefit_khr'
            );

        $fbtRate =
            TaxSetting::getRate(
                'FBT'
            );

        $fbtTax =
            $totalFringeBenefit
            *
            ($fbtRate / 100);

        /*
        |--------------------------------------------------------------------------
        | Income Tax
        |--------------------------------------------------------------------------
        */

        $incomeTax =
            $this->calculateIncomeTax(
                $company,
                $profit
            );

        /*
        |--------------------------------------------------------------------------
        | VAT
        |--------------------------------------------------------------------------
        */

        $vat =
            $this->calculateVAT(
                $outputVat,
                $inputVat
            );




        /*
        |--------------------------------------------------------------------------
        | PTOI
        |--------------------------------------------------------------------------
        */

        $prepaymentTax =
            $this->calculatePTOI(
                $totalRevenue
            );

        /*
        |--------------------------------------------------------------------------
        | Total Tax
        |--------------------------------------------------------------------------
        */
        $totalTaxDue =
            $vat['vat_payable']
            +
            $salaryTax
            +
            $withholdingTax
            +
            $prepaymentTax
            +
            $fbtTax;

        return [

            'total_revenue' => $totalRevenue,

            'total_expense' => $totalExpense,

            'profit' => $profit,

            'output_vat' => $vat['output_vat'],

            'input_vat' => $vat['input_vat'],

            'vat_payable' => $vat['vat_payable'],

            'salary_tax' => $salaryTax,

            'withholding_tax' => $withholdingTax,

            'prepayment_tax' => $prepaymentTax,

            // 'profit_tax' => $incomeTax,

            'fbt_tax' => $fbtTax,

            'total_payroll' => $totalPayroll,

            'total_tax_due' => $totalTaxDue,
        ];
    }
}
