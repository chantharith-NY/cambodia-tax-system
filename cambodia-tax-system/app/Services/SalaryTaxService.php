<?php

namespace App\Services;

class SalaryTaxService
{
    const DEPENDENT_DEDUCTION_KHR = 150000;
    const USD_TO_KHR_DEFAULT = 4100;

    private function convertToKHR(
        float $amount,
        string $currency
    ): float {

        if ($currency === 'USD') {
            return $amount * self::USD_TO_KHR_DEFAULT;
        }

        return $amount;
    }

    public function calculate(
        float $grossSalaryKHR,
        int $dependents = 0,
        float $fringeBenefitKHR = 0
    ): array {

        $taxableSalary = max(
            $grossSalaryKHR - (
                $dependents * self::DEPENDENT_DEDUCTION_KHR
            ),
            0
        );

        $salaryTax = $this->calculateMonthlyBracketTax(
            $taxableSalary
        );

        $fringeBenefitTax = $fringeBenefitKHR * 0.20;

        return [
            'gross_salary_khr' => $grossSalaryKHR,

            'taxable_salary_khr' => $taxableSalary,

            'salary_tax_khr' => $salaryTax,

            'fringe_benefit_tax_khr' => $fringeBenefitTax,

            'total_tax_khr' => (
                $salaryTax +
                $fringeBenefitTax
            ),
        ];
    }

    private function calculateMonthlyBracketTax(
        float $taxableSalaryKHR
    ): float {

        if ($taxableSalaryKHR <= 1500000) {
            return 0;
        }

        if ($taxableSalaryKHR <= 2000000) {
            return max(
                ($taxableSalaryKHR * 0.05) - 75000,
                0
            );
        }

        if ($taxableSalaryKHR <= 8500000) {
            return ($taxableSalaryKHR * 0.10)
                - 175000;
        }

        if ($taxableSalaryKHR <= 12500000) {
            return ($taxableSalaryKHR * 0.15)
                - 600000;
        }

        return ($taxableSalaryKHR * 0.20)
            - 1225000;
    }
}
