<?php

namespace Database\Seeders;

use App\Models\IncomeTaxBracket;
use Illuminate\Database\Seeder;

class IncomeTaxBracketSeeder extends Seeder
{
    public function run(): void
    {
        $date = now()->toDateString();

        IncomeTaxBracket::insert([

            // Sole Proprietorship
            [
                'taxpayer_type' => 'sole_proprietor',
                'min_profit' => 0,
                'max_profit' => 18000000,
                'tax_rate' => 0,
                'deduction_amount' => 0,
                'effective_date' => $date,
            ],
            [
                'taxpayer_type' => 'sole_proprietor',
                'min_profit' => 18000000.01,
                'max_profit' => 24000000,
                'tax_rate' => 5,
                'deduction_amount' => 900000,
                'effective_date' => $date,
            ],
            [
                'taxpayer_type' => 'sole_proprietor',
                'min_profit' => 24000000.01,
                'max_profit' => 102000000,
                'tax_rate' => 10,
                'deduction_amount' => 2100000,
                'effective_date' => $date,
            ],
            [
                'taxpayer_type' => 'sole_proprietor',
                'min_profit' => 102000000.01,
                'max_profit' => 150000000,
                'tax_rate' => 15,
                'deduction_amount' => 7200000,
                'effective_date' => $date,
            ],
            [
                'taxpayer_type' => 'sole_proprietor',
                'min_profit' => 150000000.01,
                'max_profit' => null,
                'tax_rate' => 20,
                'deduction_amount' => 14200000,
                'effective_date' => $date,
            ],

            // Legal Entity
            [
                'taxpayer_type' => 'legal_entity',
                'min_profit' => 0,
                'max_profit' => null,
                'tax_rate' => 20,
                'deduction_amount' => 0,
                'effective_date' => $date,
            ],

            // Natural Resource
            [
                'taxpayer_type' => 'natural_resource',
                'min_profit' => 0,
                'max_profit' => null,
                'tax_rate' => 30,
                'deduction_amount' => 0,
                'effective_date' => $date,
            ],

            // QIP
            [
                'taxpayer_type' => 'qip',
                'min_profit' => 0,
                'max_profit' => null,
                'tax_rate' => 0,
                'deduction_amount' => 0,
                'effective_date' => $date,
            ],
        ]);
    }
}
