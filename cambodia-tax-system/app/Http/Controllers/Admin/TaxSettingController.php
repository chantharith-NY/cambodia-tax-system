<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\TaxSetting;

class TaxSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taxSettings = TaxSetting::orderBy('tax_code')->get();

        return view(
            'admin.tax-settings.index',
            compact('taxSettings')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'admin.tax-settings.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tax_code' => ['required', 'unique:tax_settings,tax_code'],
            'tax_name' => ['required'],
            'tax_rate' => ['required', 'numeric', 'min:0'],
            'effective_date' => ['required', 'date'],
            'description' => ['nullable'],
        ]);

        TaxSetting::create($validated);

        return redirect()
            ->route('admin.tax-settings.index')
            ->with(
                'success',
                'Tax setting created successfully.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $taxSetting = TaxSetting::findOrFail($id);

        return view(
            'admin.tax-settings.edit',
            compact('taxSetting')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        string $id
    ) {
        $taxSetting = TaxSetting::findOrFail($id);

        $validated = $request->validate([
            'tax_code' => [
                'required',
                'unique:tax_settings,tax_code,' . $taxSetting->id,
            ],
            'tax_name' => ['required'],
            'tax_rate' => ['required', 'numeric', 'min:0'],
            'effective_date' => ['required', 'date'],
            'description' => ['nullable'],
        ]);

        $taxSetting->update($validated);

        return redirect()
            ->route('admin.tax-settings.index')
            ->with(
                'success',
                'Tax setting updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $taxSetting = TaxSetting::findOrFail($id);

        $taxSetting->delete();

        return redirect()
            ->route('admin.tax-settings.index')
            ->with(
                'success',
                'Tax setting deleted successfully.'
            );
    }
}
