<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithholdingTax extends Model
{
    protected $fillable = [
        'company_id',
        'vendor_name',
        'payment_type',
        'gross_amount',
        'tax_rate',
        'withholding_tax',
        'net_amount',
        'payment_date',
        'description',
        'currency',
        'exchange_rate',
    ];

    protected function casts(): array
    {
        return [

            'gross_amount' => 'decimal:2',

            'tax_rate' => 'decimal:2',

            'withholding_tax' => 'decimal:2',

            'net_amount' => 'decimal:2',

            'payment_date' => 'date',
        ];
    }

    public function company()
    {
        return $this->belongsTo(
            Company::class
        );
    }
}
