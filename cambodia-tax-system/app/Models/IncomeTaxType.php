<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeTaxType extends Model
{
    protected $fillable = [
        'business_type',
        'tax_rate',
        'description',
        'effective_date',
    ];

    protected function casts(): array
    {
        return [
            'effective_date' => 'date',
        ];
    }
}
