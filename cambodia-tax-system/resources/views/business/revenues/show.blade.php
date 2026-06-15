<x-app-layout>

    <div class="max-w-5xl mx-auto py-6">

        <div class="bg-white rounded-2xl shadow p-8">

            <div class="flex justify-between items-center mb-8">

                <div>

                    <h1 class="text-3xl font-bold">

                        Revenue Details

                    </h1>

                    <p class="text-gray-500">

                        Invoice {{ $revenue->invoice_no }}

                    </p>

                </div>

                <a
                    href="{{ route('business.revenues.index') }}"
                    class="bg-gray-100 px-4 py-2 rounded-lg">

                    Back

                </a>

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div class="bg-gray-50 rounded-xl p-5">
                    <p class="text-gray-500">Invoice Number</p>
                    <h3 class="text-lg font-semibold">
                        {{ $revenue->invoice_no }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-xl p-5">
                    <p class="text-gray-500">Customer</p>
                    <h3 class="text-lg font-semibold">
                        {{ $revenue->customer_name }}
                    </h3>
                </div>

                <div class="bg-green-50 rounded-xl p-5">
                    <p class="text-gray-500">Revenue Amount</p>
                    <h3 class="text-2xl font-bold text-green-600">
                        {{ number_format($revenue->amount,2) }}
                    </h3>
                </div>

                <div class="bg-blue-50 rounded-xl p-5">
                    <p class="text-gray-500">VAT Amount</p>
                    <h3 class="text-2xl font-bold text-blue-600">
                        {{ number_format($revenue->vat_amount,2) }}
                    </h3>
                </div>

                <div class="bg-purple-50 rounded-xl p-5">
                    <p class="text-gray-500">Base Amount</p>
                    <h3 class="text-2xl font-bold text-purple-600">
                        {{ number_format($revenue->base_amount,2) }}
                    </h3>
                </div>

                <div class="bg-yellow-50 rounded-xl p-5">
                    <p class="text-gray-500">Invoice Date</p>
                    <h3 class="text-lg font-semibold">
                        {{ $revenue->invoice_date->format('d M Y') }}
                    </h3>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>