<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'owner_id',
        'company_name',
        'tax_number',
        'industry',
        'phone',
        'address',
    ];
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
