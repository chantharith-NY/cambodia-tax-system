<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'company_id',
        'supplier_name',
        'category',
        'amount',
        'currency',
        'exchange_rate',
        'amount_khr',
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
            'base_amount' => 'decimal:2',
            'vat_amount' => 'decimal:2',
            'vat_included' => 'boolean',
            'expense_date' => 'date',
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
