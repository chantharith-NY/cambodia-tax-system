<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create()
    {
        return view('business.company.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'tax_number' => ['nullable', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
        ]);

        Company::create([
            'owner_id' => $request->user()->id,
            'company_name' => $request->company_name,
            'tax_number' => $request->tax_number,
            'industry' => $request->industry,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()
            ->route('business.dashboard')
            ->with('success', 'Company profile created successfully.');
    }
}
