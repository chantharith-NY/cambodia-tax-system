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
                        <label>Invoice Date</label>

                        <input
                            type="date"
                            name="invoice_date"
                            value="{{ $revenue->invoice_date->format('Y-m-d') }}"
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