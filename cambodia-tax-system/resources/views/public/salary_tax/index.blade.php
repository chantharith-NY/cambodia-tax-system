<x-public-layout>

    <div class="max-w-6xl mx-auto py-10 px-6">

        {{-- Header --}}
        <div class="text-center mb-10">

            <h1 class="text-5xl font-bold text-gray-900">
                Salary Tax Calculator
            </h1>

            <p class="text-lg text-gray-600 mt-4">
                Calculate monthly salary tax according to Cambodia Tax Regulations.
            </p>

        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            {{-- Calculator --}}
            <div class="lg:col-span-2">

                <div class="bg-white rounded-3xl shadow-xl p-8">

                    <h2 class="text-2xl font-bold mb-6">
                        Employee Information
                    </h2>

                    <form
                        method="POST"
                        action="{{ route('public.salary-tax.calculate') }}">

                        @csrf

                        <div class="grid md:grid-cols-2 gap-6">

                            <div>

                                <label class="block mb-2 font-medium">
                                    Monthly Salary
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    name="salary"
                                    value="{{ old('salary') }}"
                                    class="w-full rounded-xl border-gray-300"
                                    required>

                            </div>

                            <div>

                                <label class="block mb-2 font-medium">
                                    Currency
                                </label>

                                <select
                                    name="currency"
                                    class="w-full rounded-xl border-gray-300">

                                    <option value="KHR">
                                        KHR
                                    </option>

                                    <option value="USD">
                                        USD
                                    </option>

                                </select>

                            </div>

                            <div>

                                <label class="block mb-2 font-medium">
                                    Residency Status
                                </label>

                                <select
                                    name="residency_status"
                                    class="w-full rounded-xl border-gray-300">

                                    <option value="resident">
                                        Resident
                                    </option>

                                    <option value="non_resident">
                                        Non Resident
                                    </option>

                                </select>

                            </div>

                            <div>

                                <label class="block mb-2 font-medium">
                                    Spouse Count
                                </label>

                                <input
                                    type="number"
                                    min="0"
                                    name="spouse_count"
                                    value="0"
                                    class="w-full rounded-xl border-gray-300">

                            </div>

                            <div>

                                <label class="block mb-2 font-medium">
                                    Dependents
                                </label>

                                <input
                                    type="number"
                                    min="0"
                                    name="dependents"
                                    value="0"
                                    class="w-full rounded-xl border-gray-300">

                            </div>

                        </div>

                        <div class="mt-8 flex gap-4">

                            <button
                                type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold shadow">

                                Calculate Tax

                            </button>

                            <a
                                href="{{ url('/') }}"
                                class="border border-gray-300 hover:border-gray-400 bg-white px-8 py-3 rounded-xl font-semibold text-gray-700 shadow-sm">

                                Back to Homepage

                            </a>

                        </div>

                    </form>

                </div>

            </div>

            {{-- Information Card --}}
            <div>

                <div class="bg-gradient-to-br from-blue-600 to-indigo-700 text-white rounded-3xl shadow-xl p-8">

                    <h3 class="text-2xl font-bold mb-4">
                        About Salary Tax
                    </h3>

                    <p class="leading-relaxed">

                        Salary tax in Cambodia is calculated monthly based on the employee's taxable salary and residency status.

                    </p>

                    <div class="mt-6">

                        <ul class="space-y-3">

                            <li>✓ Resident Tax Rates</li>

                            <li>✓ Non-Resident Flat Rate</li>

                            <li>✓ Family Allowance Support</li>

                            <li>✓ Automatic Calculation</li>

                            <li>✓ Latest Tax Brackets</li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

        {{-- Results --}}
        @isset($result)

        <div class="mt-10">

            <h2 class="text-3xl font-bold mb-6">
                Tax Calculation Result
            </h2>

            <div class="grid md:grid-cols-4 gap-6">

                <div class="bg-white shadow-xl rounded-2xl p-6 border-l-4 border-blue-500">

                    <p class="text-gray-500">
                        Gross Salary
                    </p>

                    <h3 class="text-2xl font-bold text-blue-600 mt-2">
                        {{ number_format($grossSalary,2) }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        KHR
                    </p>

                </div>

                <div class="bg-white shadow-xl rounded-2xl p-6 border-l-4 border-purple-500">

                    <p class="text-gray-500">
                        Taxable Salary
                    </p>

                    <h3 class="text-2xl font-bold text-purple-600 mt-2">
                        {{ number_format($result['taxable_salary'],2) }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        KHR
                    </p>

                </div>

                <div class="bg-white shadow-xl rounded-2xl p-6 border-l-4 border-red-500">

                    <p class="text-gray-500">
                        Salary Tax
                    </p>

                    <h3 class="text-2xl font-bold text-red-600 mt-2">
                        {{ number_format($result['salary_tax'],2) }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        KHR
                    </p>

                </div>

                <div class="bg-white shadow-xl rounded-2xl p-6 border-l-4 border-green-500">

                    <p class="text-gray-500">
                        Net Salary
                    </p>

                    <h3 class="text-2xl font-bold text-green-600 mt-2">
                        {{ number_format($grossSalary - $result['salary_tax'],2) }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        KHR
                    </p>

                </div>

            </div>

            <div class="bg-white shadow-xl rounded-2xl p-8 mt-10">

                <h2 class="text-2xl font-bold mb-4">
                    Salary Tax Formula
                </h2>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">

                    <p class="text-lg">

                        Taxable Salary
                        =
                        Gross Salary
                        -
                        Family Allowance

                    </p>

                    <p class="text-lg mt-3">

                        Salary Tax
                        =
                        (Taxable Salary × Tax Rate)
                        -
                        Deduction Amount

                    </p>

                    <p class="text-lg mt-3">

                        Net Salary
                        =
                        Gross Salary
                        -
                        Salary Tax

                    </p>

                </div>

            </div>



        </div>

        @endisset

        <div class="bg-white shadow-xl rounded-2xl p-8 mt-10">

            <h2 class="text-2xl font-bold mb-6">
                Cambodia Salary Tax Rates
            </h2>

            {{-- Resident Tax Table --}}
            <div class="mb-10">

                <h3 class="text-lg font-semibold text-blue-700 mb-4">
                    Resident Tax Rates
                </h3>

                <table class="w-full">

                    <thead>

                        <tr class="border-b bg-gray-50">

                            <th class="text-left py-3 px-2">
                                Monthly Salary (KHR)
                            </th>

                            <th class="text-left py-3 px-2">
                                Tax Rate
                            </th>

                            <th class="text-left py-3 px-2">
                                Deduction
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($residentBrackets as $bracket)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="py-3 px-2">

                                {{ number_format($bracket->min_salary) }}
                                -

                                {{ $bracket->max_salary
                            ? number_format($bracket->max_salary)
                            : 'Above'
                        }}

                            </td>

                            <td class="px-2">

                                {{ number_format($bracket->tax_rate, 2) }}%

                            </td>

                            <td class="px-2">

                                {{ number_format($bracket->deduction_amount, 0) }}

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{-- Non Resident Tax Table --}}
            <div>

                <h3 class="text-lg font-semibold text-red-700 mb-4">
                    Non-Resident Tax Rates
                </h3>

                <table class="w-full">

                    <thead>

                        <tr class="border-b bg-gray-50">

                            <th class="text-left py-3 px-2">
                                Description
                            </th>

                            <th class="text-left py-3 px-2">
                                Tax Rate
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($nonResidentBrackets as $bracket)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="py-3 px-2">
                                All Salary Levels
                            </td>

                            <td class="px-2 font-semibold text-red-600">
                                {{ number_format($bracket->tax_rate, 2) }}%
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-public-layout>