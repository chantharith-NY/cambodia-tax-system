<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-gray-900">
                    Edit Income Tax Bracket
                </h1>

                <p class="text-gray-500 mt-1">
                    Update income tax bracket configuration.
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
                action="{{ route('admin.income-tax-brackets.update', $incomeTaxBracket) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block mb-2 font-medium">
                            Taxpayer Type
                        </label>

                        <select
                            name="taxpayer_type"
                            class="w-full border rounded-lg p-3">

                            <option value="sole_proprietor"
                                {{ old('taxpayer_type', $incomeTaxBracket->taxpayer_type) == 'sole_proprietor' ? 'selected' : '' }}>
                                Sole Proprietor
                            </option>

                            <option value="legal_entity"
                                {{ old('taxpayer_type', $incomeTaxBracket->taxpayer_type) == 'legal_entity' ? 'selected' : '' }}>
                                Legal Entity
                            </option>

                            <option value="qip"
                                {{ old('taxpayer_type', $incomeTaxBracket->taxpayer_type) == 'qip' ? 'selected' : '' }}>
                                QIP
                            </option>

                            <option value="natural_resource"
                                {{ old('taxpayer_type', $incomeTaxBracket->taxpayer_type) == 'natural_resource' ? 'selected' : '' }}>
                                Natural Resource
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
                            value="{{ old('tax_rate', $incomeTaxBracket->tax_rate) }}"
                            class="w-full border rounded-lg p-3"
                            required>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Minimum Profit
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="min_profit"
                            value="{{ old('min_profit', $incomeTaxBracket->min_profit) }}"
                            class="w-full border rounded-lg p-3"
                            required>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Maximum Profit
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="max_profit"
                            value="{{ old('max_profit', $incomeTaxBracket->max_profit) }}"
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
                            value="{{ old('deduction_amount', $incomeTaxBracket->deduction_amount) }}"
                            class="w-full border rounded-lg p-3">

                    </div>

                </div>

                <div class="mt-8 flex gap-3">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">

                        Update Bracket

                    </button>

                    <a
                        href="{{ route('admin.income-tax-brackets.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-xl">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>