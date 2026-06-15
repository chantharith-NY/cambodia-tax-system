<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanyBusinessTypeSeeder extends Seeder
{
    public function run(): void
    {
        // Default all companies to legal_entity
        Company::query()->update([
            'business_type' => 'legal_entity'
        ]);

        // Example specific companies
        Company::where('name', 'ABC Trading')->update([
            'business_type' => 'sole_proprietorship'
        ]);

        Company::where('name', 'XYZ Mining')->update([
            'business_type' => 'natural_resource'
        ]);

        Company::where('name', 'QIP Manufacturing')->update([
            'business_type' => 'qip'
        ]);
    }
}
