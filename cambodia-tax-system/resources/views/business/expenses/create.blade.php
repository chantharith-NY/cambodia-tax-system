<x-app-layout>

    <div class="max-w-5xl mx-auto py-8">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-red-700">
                    Add Expense
                </h1>

                <p class="text-gray-500 mt-2">
                    Record supplier expenses, VAT credits and withholding tax transactions.
                </p>

            </div>

            <form
                action="{{ route('business.expenses.store') }}"
                method="POST">

                @csrf

                {{-- Supplier Information --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Supplier Information
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Supplier Name
                            </label>

                            <input
                                type="text"
                                name="supplier_name"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Supplier Type
                            </label>

                            <select
                                name="supplier_type"
                                class="w-full border rounded-lg p-3">

                                <option value="resident">
                                    Resident
                                </option>

                                <option value="non_resident">
                                    Non Resident
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                {{-- Expense Information --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Expense Information
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Category
                            </label>

                            <select
                                name="category"
                                class="w-full border rounded-lg p-3"
                                required>

                                <option value="">
                                    Select Category
                                </option>

                                <option value="rental">Rental</option>
                                <option value="service">Service</option>
                                <option value="interest">Interest</option>
                                <option value="royalty">Royalty</option>
                                <option value="utility">Utility</option>
                                <option value="fuel">Fuel</option>
                                <option value="salary">Salary</option>
                                <option value="other">Other</option>

                            </select>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Amount
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="amount"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                    </div>

                </div>

                {{-- Currency --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Currency Information
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Currency
                            </label>

                            <select
                                name="currency"
                                class="w-full border rounded-lg p-3">

                                <option value="USD">
                                    USD ($)
                                </option>

                                <option value="KHR">
                                    KHR (៛)
                                </option>

                            </select>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Exchange Rate
                            </label>

                            <input
                                type="number"
                                name="exchange_rate"
                                value="4100"
                                class="w-full border rounded-lg p-3">

                        </div>

                    </div>

                </div>

                {{-- Tax Information --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Tax Information
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                VAT Invoice
                            </label>

                            <select
                                name="has_vat_invoice"
                                class="w-full border rounded-lg p-3">

                                <option value="1">
                                    Has VAT Invoice
                                </option>

                                <option value="0">
                                    No VAT Invoice
                                </option>

                            </select>

                        </div>

                        <div class="flex items-center pt-8">

                            <input
                                type="hidden"
                                name="vat_included"
                                value="0">

                            <input
                                type="checkbox"
                                name="vat_included"
                                value="1"
                                class="mr-2">

                            <span>
                                VAT Included In Amount
                            </span>

                        </div>

                    </div>

                </div>

                {{-- Date & Description --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Additional Information
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Expense Date
                            </label>

                            <input
                                type="date"
                                name="expense_date"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                    </div>

                    <div class="mt-4">

                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="w-full border rounded-lg p-3"></textarea>

                    </div>

                </div>

                <div class="flex justify-end gap-3">

                    <a
                        href="{{ route('business.expenses.index') }}"
                        class="px-5 py-3 bg-gray-100 rounded-xl">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow">

                        Save Expense

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>