<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Edit Withholding Tax
            </h2>

            <form
                action="{{ route('business.withholding-taxes.update', $withholdingTax) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>

                        <label>
                            Vendor Name
                        </label>

                        <input
                            type="text"
                            name="vendor_name"
                            value="{{ old('vendor_name', $withholdingTax->vendor_name) }}"
                            class="w-full border rounded p-2"
                            required>

                    </div>

                    <div>

                        <label>
                            Payment Type
                        </label>

                        <select
                            name="payment_type"
                            class="w-full border rounded p-2"
                            required>

                            <option
                                value="rental"
                                {{ old('payment_type', $withholdingTax->payment_type) == 'rental' ? 'selected' : '' }}>

                                Rental (10%)

                            </option>

                            <option
                                value="services"
                                {{ old('payment_type', $withholdingTax->payment_type) == 'services' ? 'selected' : '' }}>

                                Services (15%)

                            </option>

                            <option
                                value="royalties_interest"
                                {{ old('payment_type', $withholdingTax->payment_type) == 'royalties_interest' ? 'selected' : '' }}>

                                Royalties / Interest (15%)

                            </option>

                            <option
                                value="non_resident"
                                {{ old('payment_type', $withholdingTax->payment_type) == 'non_resident' ? 'selected' : '' }}>

                                Non Resident (14%)

                            </option>

                        </select>

                    </div>

                    <div>

                        <label>
                            Gross Amount
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="gross_amount"
                            value="{{ old('gross_amount', $withholdingTax->gross_amount) }}"
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

                            <option
                                value="USD"
                                {{ old('currency', $withholdingTax->currency) == 'USD' ? 'selected' : '' }}>

                                USD ($)

                            </option>

                            <option
                                value="KHR"
                                {{ old('currency', $withholdingTax->currency) == 'KHR' ? 'selected' : '' }}>

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
                            step="0.01"
                            name="exchange_rate"
                            value="{{ old('exchange_rate', $withholdingTax->exchange_rate ?? 4100) }}"
                            class="w-full border rounded p-2">

                    </div>

                    <div>

                        <label>
                            Payment Date
                        </label>

                        <input
                            type="date"
                            name="payment_date"
                            value="{{ old('payment_date', $withholdingTax->payment_date->format('Y-m-d')) }}"
                            class="w-full border rounded p-2"
                            required>

                    </div>

                    <div class="md:col-span-2">

                        <label>
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="w-full border rounded p-2">{{ old('description', $withholdingTax->description) }}</textarea>

                    </div>

                </div>

                <div class="mt-6 flex gap-3">

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded">

                        Update

                    </button>

                    <a
                        href="{{ route('business.withholding-taxes.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>