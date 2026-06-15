<?php

namespace Database\Seeders;

use App\Models\SalaryTaxBracket;
use Illuminate\Database\Seeder;

class SalaryTaxBracketSeeder extends Seeder
{
    public function run(): void
    {
        $date = now()->toDateString();

        SalaryTaxBracket::truncate();

        SalaryTaxBracket::insert([

            [
                'resident_type' => 'resident',
                'min_salary' => 0,
                'max_salary' => 1500000,
                'tax_rate' => 0,
                'deduction_amount' => 0,
                'effective_date' => $date,
            ],

            [
                'resident_type' => 'resident',
                'min_salary' => 1500000.01,
                'max_salary' => 2000000,
                'tax_rate' => 5,
                'deduction_amount' => 75000,
                'effective_date' => $date,
            ],

            [
                'resident_type' => 'resident',
                'min_salary' => 2000000.01,
                'max_salary' => 8500000,
                'tax_rate' => 10,
                'deduction_amount' => 175000,
                'effective_date' => $date,
            ],

            [
                'resident_type' => 'resident',
                'min_salary' => 8500000.01,
                'max_salary' => 12500000,
                'tax_rate' => 15,
                'deduction_amount' => 600000,
                'effective_date' => $date,
            ],

            [
                'resident_type' => 'resident',
                'min_salary' => 12500000.01,
                'max_salary' => null,
                'tax_rate' => 20,
                'deduction_amount' => 1225000,
                'effective_date' => $date,
            ],

            [
                'resident_type' => 'non_resident',
                'min_salary' => 0,
                'max_salary' => null,
                'tax_rate' => 20,
                'deduction_amount' => 0,
                'effective_date' => $date,
            ],

        ]);
    }
}
