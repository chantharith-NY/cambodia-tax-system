<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxSetting extends Model
{
    protected $fillable = [
        'tax_code',
        'tax_name',
        'tax_rate',
        'description',
        'effective_date',
    ];

    protected function casts(): array
    {
        return [
            'tax_rate' => 'decimal:2',
            'effective_date' => 'date',
        ];
    }

    public static function getRate(string $taxCode): float
    {
        return (float) static::where(
            'tax_code',
            $taxCode
        )->value('tax_rate');
    }
}
