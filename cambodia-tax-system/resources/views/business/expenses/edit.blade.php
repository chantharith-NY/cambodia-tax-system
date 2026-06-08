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
                        <label>Category</label>

                        <select
                            name="category"
                            class="w-full border rounded p-2"
                            required>
                            <option value="Office Rent" {{ $expense->category == 'Office Rent' ? 'selected' : '' }}>
                                Office Rent
                            </option>

                            <option value="Salary" {{ $expense->category == 'Salary' ? 'selected' : '' }}>
                                Salary
                            </option>

                            <option value="Utilities" {{ $expense->category == 'Utilities' ? 'selected' : '' }}>
                                Utilities
                            </option>

                            <option value="Internet" {{ $expense->category == 'Internet' ? 'selected' : '' }}>
                                Internet
                            </option>

                            <option value="Transportation" {{ $expense->category == 'Transportation' ? 'selected' : '' }}>
                                Transportation
                            </option>

                            <option value="Fuel" {{ $expense->category == 'Fuel' ? 'selected' : '' }}>
                                Fuel
                            </option>

                            <option value="Equipment" {{ $expense->category == 'Equipment' ? 'selected' : '' }}>
                                Equipment
                            </option>

                            <option value="Marketing" {{ $expense->category == 'Marketing' ? 'selected' : '' }}>
                                Marketing
                            </option>

                            <option value="Maintenance" {{ $expense->category == 'Maintenance' ? 'selected' : '' }}>
                                Maintenance
                            </option>

                            <option value="Tax Payment" {{ $expense->category == 'Tax Payment' ? 'selected' : '' }}>
                                Tax Payment
                            </option>

                            <option value="Other" {{ $expense->category == 'Other' ? 'selected' : '' }}>
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

                        <span class="font-bold">
                            VAT Included
                        </span>

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