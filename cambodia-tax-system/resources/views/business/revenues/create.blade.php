<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Create Revenue
            </h2>

            <form
                action="{{ route('business.revenues.store') }}"
                method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block mb-1">
                            Invoice Number
                        </label>

                        <input
                            type="text"
                            name="invoice_no"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label class="block mb-1">
                            Customer Name
                        </label>

                        <input
                            type="text"
                            name="customer_name"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label class="block mb-1">
                            Amount
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="amount"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label>
                            Currency
                        </label>

                        <select
                            name="currency"
                            class="w-full border rounded p-2">

                            <option value="USD">
                                USD ($)
                            </option>

                            <option value="KHR">
                                KHR (៛)
                            </option>

                        </select>
                    </div>

                    <div>
                        <label>
                            Exchange Rate
                        </label>

                        <input
                            type="number"
                            name="exchange_rate"
                            value="4100"
                            class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block mb-1">
                            Invoice Date
                        </label>

                        <input
                            type="date"
                            name="invoice_date"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                </div>

                <div class="mt-4">

                    <label class="flex items-center">

                        <input
                            type="hidden"
                            name="vat_included"
                            value="0">

                        <input
                            type="checkbox"
                            name="vat_included"
                            value="1"
                            {{ old('vat_included', $revenue->vat_included ?? false) ? 'checked' : '' }}>

                        VAT Included
                    </label>

                </div>

                <div class="mt-6">

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded">
                        Save Revenue
                    </button>

                </div>

            </form>

        </div>

    </div>
</x-app-layout>