<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Create Withholding Tax
            </h2>

            <form
                action="{{ route('business.withholding-taxes.store') }}"
                method="POST">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label>Vendor Name</label>

                        <input
                            type="text"
                            name="vendor_name"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label>Payment Type</label>

                        <select
                            name="payment_type"
                            class="w-full border rounded p-2"
                            required>

                            <option value="rental">
                                Rental (10%)
                            </option>

                            <option value="services">
                                Services (15%)
                            </option>

                            <option value="royalties_interest">
                                Royalties / Interest (15%)
                            </option>

                            <option value="non_resident">
                                Non Resident (14%)
                            </option>

                        </select>
                    </div>

                    <div>
                        <label>Gross Amount</label>

                        <input
                            type="number"
                            step="0.01"
                            name="gross_amount"
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
                        <label>Payment Date</label>

                        <input
                            type="date"
                            name="payment_date"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div class="md:col-span-2">

                        <label>Description</label>

                        <textarea
                            name="description"
                            rows="3"
                            class="w-full border rounded p-2"></textarea>

                    </div>

                </div>

                <div class="mt-6">

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded">

                        Save

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>