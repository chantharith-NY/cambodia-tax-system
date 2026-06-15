<x-app-layout>

    <div class="max-w-5xl mx-auto py-6">

        <div class="bg-white rounded-2xl shadow p-8">

            <div class="flex justify-between items-center mb-8">

                <div>

                    <h1 class="text-3xl font-bold">

                        Expense Details

                    </h1>

                    <p class="text-gray-500">

                        {{ $expense->supplier_name }}

                    </p>

                </div>

                <a
                    href="{{ route('business.expenses.index') }}"
                    class="bg-gray-100 px-4 py-2 rounded-lg">

                    Back

                </a>

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div class="bg-gray-50 rounded-xl p-5">
                    <p class="text-gray-500">Supplier</p>
                    <h3 class="font-semibold">
                        {{ $expense->supplier_name }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-xl p-5">
                    <p class="text-gray-500">Supplier Type</p>
                    <h3 class="font-semibold">
                        {{ ucfirst($expense->supplier_type) }}
                    </h3>
                </div>

                <div class="bg-red-50 rounded-xl p-5">
                    <p class="text-gray-500">Expense Amount</p>
                    <h3 class="text-2xl font-bold text-red-600">
                        {{ number_format($expense->amount,2) }}
                    </h3>
                </div>

                <div class="bg-blue-50 rounded-xl p-5">
                    <p class="text-gray-500">VAT Amount</p>
                    <h3 class="text-2xl font-bold text-blue-600">
                        {{ number_format($expense->vat_amount,2) }}
                    </h3>
                </div>

                <div class="bg-yellow-50 rounded-xl p-5">
                    <p class="text-gray-500">Withholding Tax</p>
                    <h3 class="text-2xl font-bold text-yellow-600">
                        {{ number_format($expense->withholding_tax,2) }}
                    </h3>
                </div>

                <div class="bg-green-50 rounded-xl p-5">
                    <p class="text-gray-500">Net Payment</p>
                    <h3 class="text-2xl font-bold text-green-600">
                        {{ number_format($expense->net_payment,2) }}
                    </h3>
                </div>

                <div class="bg-purple-50 rounded-xl p-5">
                    <p class="text-gray-500">Category</p>
                    <h3 class="font-semibold">
                        {{ $expense->category }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-xl p-5">
                    <p class="text-gray-500">Expense Date</p>
                    <h3 class="font-semibold">
                        {{ $expense->expense_date->format('d M Y') }}
                    </h3>
                </div>

            </div>

            @if($expense->description)

            <div class="mt-6 bg-gray-50 rounded-xl p-5">

                <p class="text-gray-500 mb-2">
                    Description
                </p>

                <p>
                    {{ $expense->description }}
                </p>

            </div>

            @endif

        </div>

    </div>

</x-app-layout>