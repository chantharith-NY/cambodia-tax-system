<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Edit Revenue
            </h2>

            <form
                action="{{ route('business.revenues.update', $revenue) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label>Invoice Number</label>

                        <input
                            type="text"
                            name="invoice_no"
                            value="{{ $revenue->invoice_no }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label>Customer Name</label>

                        <input
                            type="text"
                            name="customer_name"
                            value="{{ $revenue->customer_name }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label>Amount</label>

                        <input
                            type="number"
                            step="0.01"
                            name="amount"
                            value="{{ $revenue->amount }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label>Currency</label>

                        <select
                            name="currency"
                            class="w-full border rounded p-2">

                            <option
                                value="USD"
                                {{ $revenue->currency == 'USD' ? 'selected' : '' }}>
                                USD ($)
                            </option>

                            <option
                                value="KHR"
                                {{ $revenue->currency == 'KHR' ? 'selected' : '' }}>
                                KHR (៛)
                            </option>

                        </select>
                    </div>

                    <div>
                        <label>Exchange Rate</label>

                        <input
                            type="number"
                            name="exchange_rate"
                            value="{{ $revenue->exchange_rate ?? 4100 }}"
                            class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label>Invoice Date</label>

                        <input
                            type="date"
                            name="invoice_date"
                            value="{{ $revenue->invoice_date->format('Y-m-d') }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>
                </div>

                <select
                    name="has_vat_invoice"
                    class="w-full border rounded p-2 mt-4">

                    <option
                        value="1"
                        {{ old('has_vat_invoice', $revenue->has_vat_invoice) ? 'selected' : '' }}>
                        Has VAT Invoice
                    </option>

                    <option
                        value="0"
                        {{ !old('has_vat_invoice', $revenue->has_vat_invoice) ? 'selected' : '' }}>
                        No VAT Invoice
                    </option>

                </select>

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
                            {{ old('vat_included', $revenue->vat_included) ? 'checked' : '' }}>


                        <span class="font-bold"> VAT Included</span>

                    </label>

                </div>

                <div class="mt-6">

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded">
                        Update Revenue
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>