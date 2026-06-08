<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    protected $fillable = [
        'company_id',
        'invoice_no',
        'customer_name',
        'amount',
        'vat_included',
        'base_amount',
        'vat_amount',
        'invoice_date',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'base_amount' => 'decimal:2',
            'vat_amount' => 'decimal:2',
            'vat_included' => 'boolean',
            'invoice_date' => 'date',
        ];
    }

    public function company()
    {
        return $this->belongsTo(
            Company::class
        );
    }
}
