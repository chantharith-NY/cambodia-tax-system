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
        'vat_included',
        'base_amount',
        'vat_amount',
        'description',
        'expense_date',
    ];

    protected function casts(): array
    {
        return [
            'vat_included' => 'boolean',
            'expense_date' => 'date',
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
