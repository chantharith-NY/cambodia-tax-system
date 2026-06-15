<x-app-layout>

    <div class="max-w-5xl mx-auto py-8">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-indigo-700">
                    Generate Tax Return
                </h1>

                <p class="text-gray-500 mt-2">
                    Generate monthly tax declarations and calculate all applicable taxes automatically.
                </p>

            </div>

            <form
                action="{{ route('business.tax-returns.store') }}"
                method="POST">

                @csrf

                {{-- Tax Period --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Tax Period
                    </h3>

                    <div class="max-w-md">

                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Tax Month
                        </label>

                        <input
                            type="month"
                            name="tax_month"
                            class="w-full border rounded-lg p-3"
                            required>

                    </div>

                </div>

                {{-- Tax Components --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Taxes Included
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div class="bg-blue-50 p-4 rounded-lg">

                            <h4 class="font-semibold text-blue-700">
                                VAT
                            </h4>

                            <p class="text-sm text-gray-600 mt-1">
                                Output VAT - Input VAT
                            </p>

                        </div>

                        <div class="bg-green-50 p-4 rounded-lg">

                            <h4 class="font-semibold text-green-700">
                                Salary Tax
                            </h4>

                            <p class="text-sm text-gray-600 mt-1">
                                Employee payroll tax
                            </p>

                        </div>

                        <div class="bg-yellow-50 p-4 rounded-lg">

                            <h4 class="font-semibold text-yellow-700">
                                Withholding Tax
                            </h4>

                            <p class="text-sm text-gray-600 mt-1">
                                Supplier withholding tax
                            </p>

                        </div>

                        <div class="bg-purple-50 p-4 rounded-lg">

                            <h4 class="font-semibold text-purple-700">
                                Prepayment Tax
                            </h4>

                            <p class="text-sm text-gray-600 mt-1">
                                Monthly tax prepayment
                            </p>

                        </div>

                        <div class="bg-red-50 p-4 rounded-lg">

                            <h4 class="font-semibold text-red-700">
                                Profit Tax
                            </h4>

                            <p class="text-sm text-gray-600 mt-1">
                                Annual profit tax calculation
                            </p>

                        </div>

                        <div class="bg-pink-50 p-4 rounded-lg">

                            <h4 class="font-semibold text-pink-700">
                                Fringe Benefit Tax
                            </h4>

                            <p class="text-sm text-gray-600 mt-1">
                                Employee benefits taxation
                            </p>

                        </div>

                    </div>

                </div>

                {{-- Tax Return Process --}}
                <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-5 mb-6">

                    <h4 class="font-semibold text-indigo-700 mb-3">
                        Automatic Tax Return Process
                    </h4>

                    <div class="grid md:grid-cols-5 gap-4 text-center">

                        <div>
                            <div class="bg-indigo-100 rounded-full w-10 h-10 flex items-center justify-center mx-auto mb-2">
                                1
                            </div>
                            <p class="text-sm">Load Revenue</p>
                        </div>

                        <div>
                            <div class="bg-indigo-100 rounded-full w-10 h-10 flex items-center justify-center mx-auto mb-2">
                                2
                            </div>
                            <p class="text-sm">Load Expenses</p>
                        </div>

                        <div>
                            <div class="bg-indigo-100 rounded-full w-10 h-10 flex items-center justify-center mx-auto mb-2">
                                3
                            </div>
                            <p class="text-sm">Load Payroll</p>
                        </div>

                        <div>
                            <div class="bg-indigo-100 rounded-full w-10 h-10 flex items-center justify-center mx-auto mb-2">
                                4
                            </div>
                            <p class="text-sm">Calculate Taxes</p>
                        </div>

                        <div>
                            <div class="bg-indigo-100 rounded-full w-10 h-10 flex items-center justify-center mx-auto mb-2">
                                5
                            </div>
                            <p class="text-sm">Generate Return</p>
                        </div>

                    </div>

                </div>

                {{-- Information Notice --}}
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">

                    <p class="text-sm text-yellow-700">

                        The system will automatically retrieve all revenue,
                        expense, payroll and tax information for the selected
                        month and generate a complete tax return summary.

                    </p>

                </div>

                <div class="flex justify-end gap-3">

                    <a
                        href="{{ route('business.tax-returns.index') }}"
                        class="px-5 py-3 bg-gray-100 rounded-xl">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl shadow">

                        Generate Tax Return

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>