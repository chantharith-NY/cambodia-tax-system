<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxReturn extends Model
{
    protected $fillable = [

        'company_id',
        'tax_month',
        'total_revenue',
        'total_expense',
        'output_vat',
        'input_vat',
        'vat_payable',
        'salary_tax',
        'withholding_tax',
        'prepayment_tax',
        'total_tax_due',
        'total_payroll',
        'profit_before_tax',
        'profit_tax',
        'profit_after_tax',
        'status',
    ];

    protected function casts(): array
    {
        return [

            'tax_month' => 'date',
        ];
    }

    public function company()
    {
        return $this->belongsTo(
            Company::class
        );
    }
}
