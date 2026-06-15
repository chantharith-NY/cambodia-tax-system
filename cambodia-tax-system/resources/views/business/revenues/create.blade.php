<x-app-layout>

    <div class="max-w-5xl mx-auto py-8">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-blue-700">
                    Add Revenue
                </h1>

                <p class="text-gray-500 mt-2">
                    Record customer invoices, revenue transactions and VAT outputs.
                </p>

            </div>

            <form
                action="{{ route('business.revenues.store') }}"
                method="POST">

                @csrf

                {{-- Customer Information --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Customer Information
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Invoice Number
                            </label>

                            <input
                                type="text"
                                name="invoice_no"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Customer Name
                            </label>

                            <input
                                type="text"
                                name="customer_name"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                    </div>

                </div>

                {{-- Revenue Information --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Revenue Information
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Revenue Amount
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="amount"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Invoice Date
                            </label>

                            <input
                                type="date"
                                name="invoice_date"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                    </div>

                </div>

                {{-- Currency Information --}}
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

                {{-- Information Notice --}}
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">

                    <p class="text-sm text-blue-700">

                        The system will automatically calculate:
                        VAT Amount, Base Amount and Revenue in KHR
                        based on the entered values.

                    </p>

                </div>

                <div class="flex justify-end gap-3">

                    <a
                        href="{{ route('business.revenues.index') }}"
                        class="px-5 py-3 bg-gray-100 rounded-xl">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow">

                        Save Revenue

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>