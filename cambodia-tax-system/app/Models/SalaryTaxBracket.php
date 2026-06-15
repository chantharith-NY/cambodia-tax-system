<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryTaxBracket extends Model
{
    protected $fillable = [
        'resident_type',
        'min_salary',
        'max_salary',
        'tax_rate',
        'deduction_amount',
        'effective_date',
    ];

    protected function casts(): array
    {
        return [
            'effective_date' => 'date',
        ];
    }
}
