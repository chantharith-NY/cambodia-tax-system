<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'company_id',

        'supplier_name',
        'supplier_type',

        'category',

        'amount',
        'currency',
        'exchange_rate',
        'amount_khr',

        'withholding_rate',
        'withholding_tax',
        'net_payment',

        'has_vat_invoice',
        'vat_included',
        'base_amount',
        'vat_amount',

        'description',
        'expense_date',
    ];

    protected function casts(): array
    {
        return [

            'amount' => 'decimal:2',

            'amount_khr' => 'decimal:2',

            'withholding_rate' => 'decimal:2',

            'withholding_tax' => 'decimal:2',

            'net_payment' => 'decimal:2',

            'base_amount' => 'decimal:2',

            'vat_amount' => 'decimal:2',

            'vat_included' => 'boolean',

            'has_vat_invoice' => 'boolean',

            'expense_date' => 'date',
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
