<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaxSetting;

class TaxSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $effectiveDate = now()->toDateString();

        TaxSetting::insert([
            [
                'tax_code' => 'VAT',
                'tax_name' => 'Value Added Tax',
                'tax_rate' => 10,
                'description' => 'Cambodia VAT',
                'effective_date' => $effectiveDate,
            ],
            [
                'tax_code' => 'PTOI',
                'tax_name' => 'Prepayment Tax on Income',
                'tax_rate' => 1,
                'description' => 'Monthly prepayment tax',
                'effective_date' => $effectiveDate,
            ],
            [
                'tax_code' => 'FBT',
                'tax_name' => 'Fringe Benefit Tax',
                'tax_rate' => 20,
                'description' => 'Fringe benefit tax',
                'effective_date' => $effectiveDate,
            ],
            [
                'tax_code' => 'WHT_RENT',
                'tax_name' => 'Withholding Tax - Rent',
                'tax_rate' => 10,
                'description' => 'Resident rental payment',
                'effective_date' => $effectiveDate,
            ],
            [
                'tax_code' => 'WHT_SERVICE',
                'tax_name' => 'Withholding Tax - Service',
                'tax_rate' => 15,
                'description' => 'Resident service payment',
                'effective_date' => $effectiveDate,
            ],
            [
                'tax_code' => 'WHT_ROYALTY',
                'tax_name' => 'Withholding Tax - Royalty',
                'tax_rate' => 15,
                'description' => 'Resident royalty payment',
                'effective_date' => $effectiveDate,
            ],
            [
                'tax_code' => 'WHT_INTEREST',
                'tax_name' => 'Withholding Tax - Interest',
                'tax_rate' => 15,
                'description' => 'Resident interest payment',
                'effective_date' => $effectiveDate,
            ],
            [
                'tax_code' => 'WHT_FIXED_DEPOSIT',
                'tax_name' => 'Fixed Deposit Interest',
                'tax_rate' => 6,
                'description' => 'Fixed-term deposit interest',
                'effective_date' => $effectiveDate,
            ],
            [
                'tax_code' => 'WHT_SAVINGS',
                'tax_name' => 'Savings Interest',
                'tax_rate' => 4,
                'description' => 'Non-fixed savings interest',
                'effective_date' => $effectiveDate,
            ],
            [
                'tax_code' => 'WHT_NON_RESIDENT',
                'tax_name' => 'Non Resident Withholding Tax',
                'tax_rate' => 14,
                'description' => 'Non-resident payment',
                'effective_date' => $effectiveDate,
            ],
            [
                'tax_code' => 'STAMP_TAX',
                'tax_name' => 'Stamp Tax',
                'tax_rate' => 4,
                'effective_date' => now(),
                'description' => 'Property transfer tax',
            ],
            [
                'tax_code' => 'RENTAL_TAX',
                'tax_name' => 'Property Rental Tax',
                'tax_rate' => 10,
                'effective_date' => now(),
                'description' => 'Tax on property rental income',
            ],
        ]);
    }
}
