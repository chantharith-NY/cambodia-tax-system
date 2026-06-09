<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Edit Expense
            </h2>

            <form
                action="{{ route('business.expenses.update', $expense) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label>Supplier Name</label>

                        <input
                            type="text"
                            name="supplier_name"
                            value="{{ old('supplier_name', $expense->supplier_name) }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>

                        <label>Supplier Type</label>

                        <select
                            name="supplier_type"
                            class="w-full border rounded p-2">

                            <option
                                value="resident"
                                {{ old('supplier_type', $expense->supplier_type) == 'resident' ? 'selected' : '' }}>
                                Resident
                            </option>

                            <option
                                value="non_resident"
                                {{ old('supplier_type', $expense->supplier_type) == 'non_resident' ? 'selected' : '' }}>
                                Non Resident
                            </option>

                        </select>

                    </div>

                    <div>

                        <label>Category</label>

                        <select
                            name="category"
                            class="w-full border rounded p-2"
                            required>

                            <option value="rental"
                                {{ $expense->category == 'rental' ? 'selected' : '' }}>
                                Rental
                            </option>

                            <option value="service"
                                {{ $expense->category == 'service' ? 'selected' : '' }}>
                                Service
                            </option>

                            <option value="interest"
                                {{ $expense->category == 'interest' ? 'selected' : '' }}>
                                Interest
                            </option>

                            <option value="royalty"
                                {{ $expense->category == 'royalty' ? 'selected' : '' }}>
                                Royalty
                            </option>

                            <option value="utility"
                                {{ $expense->category == 'utility' ? 'selected' : '' }}>
                                Utility
                            </option>

                            <option value="fuel"
                                {{ $expense->category == 'fuel' ? 'selected' : '' }}>
                                Fuel
                            </option>

                            <option value="salary"
                                {{ $expense->category == 'salary' ? 'selected' : '' }}>
                                Salary
                            </option>

                            <option value="other"
                                {{ $expense->category == 'other' ? 'selected' : '' }}>
                                Other
                            </option>

                        </select>

                    </div>

                    <div>
                        <label>Amount</label>

                        <input
                            type="number"
                            step="0.01"
                            name="amount"
                            value="{{ old('amount', $expense->amount) }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label>Currency</label>

                        <select
                            name="currency"
                            class="w-full border rounded p-2">

                            <option
                                value="KHR"
                                {{ old('currency', $expense->currency) == 'KHR' ? 'selected' : '' }}>
                                KHR
                            </option>

                            <option
                                value="USD"
                                {{ old('currency', $expense->currency) == 'USD' ? 'selected' : '' }}>
                                USD
                            </option>

                        </select>
                    </div>

                    <div>
                        <label>Exchange Rate</label>

                        <input
                            type="number"
                            step="0.01"
                            name="exchange_rate"
                            value="{{ old('exchange_rate', $expense->exchange_rate ?? 4100) }}"
                            class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label>Expense Date</label>

                        <input
                            type="date"
                            name="expense_date"
                            value="{{ $expense->expense_date->format('Y-m-d') }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                </div>

                <div class="mt-4">

                    <label>Description</label>

                    <textarea
                        name="description"
                        rows="3"
                        class="w-full border rounded p-2">{{ old('description', $expense->description) }}</textarea>

                </div>

                <select
                    name="has_vat_invoice"
                    class="w-full border rounded p-2">

                    <option
                        value="1"
                        {{ old('has_vat_invoice', $expense->has_vat_invoice) ? 'selected' : '' }}>
                        Has VAT Invoice
                    </option>

                    <option
                        value="0"
                        {{ !old('has_vat_invoice', $expense->has_vat_invoice) ? 'selected' : '' }}>
                        No VAT Invoice
                    </option>

                </select>

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
                            class="mr-2"
                            {{ old('vat_included', $expense->vat_included) ? 'checked' : '' }}>

                        VAT Included In Amount

                    </label>

                </div>

                <div class="mt-6">

                    <button
                        type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded">
                        Update Expense
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>