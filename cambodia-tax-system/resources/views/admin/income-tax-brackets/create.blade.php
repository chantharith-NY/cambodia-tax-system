<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-gray-900">
                    Create Income Tax Bracket
                </h1>

                <p class="text-gray-500 mt-1">
                    Configure income tax rates for different taxpayer categories.
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
                action="{{ route('admin.income-tax-brackets.store') }}"
                method="POST">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block mb-2 font-medium">
                            Taxpayer Type
                        </label>

                        <select
                            name="taxpayer_type"
                            class="w-full border rounded-lg p-3"
                            required>

                            <option value="">
                                Select Taxpayer Type
                            </option>

                            <option value="sole_proprietor">
                                Sole Proprietor
                            </option>

                            <option value="legal_entity">
                                Legal Entity
                            </option>

                            <option value="qip">
                                Qualified Investment Project (QIP)
                            </option>

                            <option value="natural_resource">
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
                            class="w-full border rounded-lg p-3"
                            required>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Minimum Profit (KHR)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="min_profit"
                            class="w-full border rounded-lg p-3"
                            required>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Maximum Profit (KHR)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="max_profit"
                            class="w-full border rounded-lg p-3">

                        <small class="text-gray-500">
                            Leave blank for No Limit
                        </small>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Deduction Amount (KHR)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="deduction_amount"
                            value="0"
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
                            class="w-full border rounded-lg p-3"
                            required>

                    </div>

                </div>

                <div class="mt-8 flex gap-3">

                    <button
                        type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl">

                        Save Tax Bracket

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