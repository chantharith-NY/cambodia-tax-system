<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-gray-900">
                    Create Tax Setting
                </h1>

                <p class="text-gray-500 mt-1">
                    Configure tax rates, deductions, and system tax parameters.
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
                action="{{ route('admin.tax-settings.store') }}"
                method="POST">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block mb-2 font-medium">
                            Tax Code
                        </label>

                        <input
                            type="text"
                            name="tax_code"
                            value="{{ old('tax_code') }}"
                            class="w-full border rounded-lg p-3"
                            placeholder="VAT, WHT, PT, ST..."
                            required>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Tax Name
                        </label>

                        <input
                            type="text"
                            name="tax_name"
                            value="{{ old('tax_name') }}"
                            class="w-full border rounded-lg p-3"
                            placeholder="Value Added Tax"
                            required>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Tax Rate (%)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="tax_rate"
                            value="{{ old('tax_rate') }}"
                            class="w-full border rounded-lg p-3"
                            required>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Deduction Amount
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="deduction"
                            value="{{ old('deduction', 0) }}"
                            class="w-full border rounded-lg p-3">

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Effective Date
                        </label>

                        <input
                            type="date"
                            name="effective_date"
                            value="{{ old('effective_date') }}"
                            class="w-full border rounded-lg p-3"
                            required>

                    </div>

                </div>

                <div class="mt-6">

                    <label class="block mb-2 font-medium">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="4"
                        class="w-full border rounded-lg p-3"
                        placeholder="Optional description of this tax setting...">{{ old('description') }}</textarea>

                </div>

                <div class="mt-8 flex gap-3">

                    <button
                        type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl">

                        Save Tax Setting

                    </button>

                    <a
                        href="{{ route('admin.tax-settings.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-xl">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>