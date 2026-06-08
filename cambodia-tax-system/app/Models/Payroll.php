<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'payroll_month',
        'gross_salary',
        'salary_tax',
        'net_salary',
    ];

    protected function casts(): array
    {
        return [
            'payroll_month' => 'date',
        ];
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
