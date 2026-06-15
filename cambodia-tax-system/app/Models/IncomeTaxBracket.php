<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeTaxBracket extends Model
{
    protected $fillable = [
        'taxpayer_type',
        'min_profit',
        'max_profit',
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
