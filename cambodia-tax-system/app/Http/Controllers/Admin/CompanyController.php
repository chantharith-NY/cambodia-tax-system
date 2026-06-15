<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with(
            'owner'
        )
            ->latest()
            ->paginate(10);

        return view(
            'admin.companies.index',
            compact('companies')
        );
    }

    public function show(
        Company $company
    ) {
        $company->load('owner');

        return view(
            'admin.companies.show',
            compact('company')
        );
    }

    public function destroy(
        Company $company
    ) {
        $company->delete();

        return redirect()
            ->route(
                'admin.companies.index'
            )
            ->with(
                'success',
                'Company deleted successfully.'
            );
    }
}
