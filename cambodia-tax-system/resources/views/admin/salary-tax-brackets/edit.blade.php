<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-gray-900">
                    Edit Salary Tax Bracket
                </h1>

                <p class="text-gray-500 mt-1">
                    Update salary tax rates and thresholds for payroll calculations.
                </p>

            </div>

            @if ($errors->any())

            <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded">

                <ul class="list-disc list-inside">

                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif

            <form
                action="{{ route('admin.salary-tax-brackets.update', $salaryTaxBracket) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block mb-2 font-medium">
                            Resident Type
                        </label>

                        <select
                            name="resident_type"
                            class="w-full border rounded-lg p-3"
                            required>

                            <option
                                value="resident"
                                {{ $salaryTaxBracket->resident_type == 'resident' ? 'selected' : '' }}>
                                Resident
                            </option>

                            <option
                                value="non_resident"
                                {{ $salaryTaxBracket->resident_type == 'non_resident' ? 'selected' : '' }}>
                                Non Resident
                            </option>

                        </select>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Tax Rate (%)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="tax_rate"
                            value="{{ old('tax_rate', $salaryTaxBracket->tax_rate) }}"
                            class="w-full border rounded-lg p-3"
                            required>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Minimum Salary
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="min_salary"
                            value="{{ old('min_salary', $salaryTaxBracket->min_salary) }}"
                            class="w-full border rounded-lg p-3"
                            required>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Maximum Salary
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="max_salary"
                            value="{{ old('max_salary', $salaryTaxBracket->max_salary) }}"
                            class="w-full border rounded-lg p-3">

                        <small class="text-gray-500">
                            Leave blank for No Limit
                        </small>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Deduction Amount
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="deduction_amount"
                            value="{{ old('deduction_amount', $salaryTaxBracket->deduction_amount) }}"
                            class="w-full border rounded-lg p-3"
                            required>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Effective Date
                        </label>

                        <input
                            type="date"
                            name="effective_date"
                            value="{{ $salaryTaxBracket->effective_date?->format('Y-m-d') }}"
                            class="w-full border rounded-lg p-3"
                            required>

                    </div>

                </div>

                <div class="mt-8 flex gap-3">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">

                        Update Salary Tax Bracket

                    </button>

                    <a
                        href="{{ route('admin.salary-tax-brackets.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-xl">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>