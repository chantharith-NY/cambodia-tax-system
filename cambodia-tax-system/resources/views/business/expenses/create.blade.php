<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Create Expense
            </h2>

            <form
                action="{{ route('business.expenses.store') }}"
                method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label>Supplier Name</label>

                        <input
                            type="text"
                            name="supplier_name"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label>Category</label>

                        <select
                            name="category"
                            class="w-full border rounded p-2"
                            required>
                            <option value="">Select Category</option>

                            <option>Office Rent</option>
                            <option>Salary</option>
                            <option>Utilities</option>
                            <option>Internet</option>
                            <option>Transportation</option>
                            <option>Fuel</option>
                            <option>Equipment</option>
                            <option>Marketing</option>
                            <option>Maintenance</option>
                            <option>Tax Payment</option>
                            <option>Other</option>

                        </select>
                    </div>

                    <div>
                        <label>Amount</label>

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
                        <label>Expense Date</label>

                        <input
                            type="date"
                            name="expense_date"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                </div>

                <div class="mt-4">

                    <label>Description</label>

                    <textarea
                        name="description"
                        rows="3"
                        class="w-full border rounded p-2"></textarea>

                </div>

                <div class="mt-4">

                    <input
                        type="hidden"
                        name="vat_included"
                        value="0">

                    <label class="flex items-center">

                        <input
                            type="checkbox"
                            name="vat_included"
                            value="1"
                            class="mr-2">

                        VAT Included

                    </label>

                </div>

                <div class="mt-6">

                    <button
                        type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded">
                        Save Expense
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>