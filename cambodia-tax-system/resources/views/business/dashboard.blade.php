<x-app-layout>

    <div class="p-8">

        {{-- Header --}}

        <div class="mb-8">

            <h1 class="text-4xl font-bold text-gray-900">
                {{ auth()->user()->company?->company_name }}
            </h1>

            <p class="text-gray-500 mt-2">
                Welcome back, {{ auth()->user()->name }}
            </p>

        </div>

        {{-- KPI Cards --}}

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

            <div class="bg-white shadow-xl rounded-2xl p-6 border-l-4 border-green-500">
                <p class="text-gray-500">Revenue</p>
                <h2 class="text-3xl font-bold text-green-600 mt-2">
                    {{ number_format($totalRevenue,2) }}
                </h2>
                <p class="text-sm text-gray-500">KHR</p>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-6 border-l-4 border-red-500">
                <p class="text-gray-500">Expense</p>
                <h2 class="text-3xl font-bold text-red-600 mt-2">
                    {{ number_format($totalExpense,2) }}
                </h2>
                <p class="text-sm text-gray-500">KHR</p>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-6 border-l-4 border-blue-500">
                <p class="text-gray-500">Net Profit</p>
                <h2 class="text-3xl font-bold text-blue-600 mt-2">
                    {{ number_format($profit,2) }}
                </h2>
                <p class="text-sm text-gray-500">KHR</p>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-6 border-l-4 border-yellow-500">
                <p class="text-gray-500">VAT Payable</p>
                <h2 class="text-3xl font-bold text-yellow-600 mt-2">
                    {{ number_format($vatPayable,2) }}
                </h2>
                <p class="text-sm text-gray-500">KHR</p>
            </div>

        </div>

        {{-- Second KPI Row --}}

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white shadow-xl rounded-2xl p-6">
                <p class="text-gray-500">Employees</p>
                <h2 class="text-3xl font-bold text-indigo-600 mt-2">
                    {{ $totalEmployees }}
                </h2>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-6">
                <p class="text-gray-500">Salary Tax</p>
                <h2 class="text-3xl font-bold text-purple-600 mt-2">
                    {{ number_format($totalSalaryTax,2) }}
                </h2>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-6">
                <p class="text-gray-500">Total Tax Due</p>
                <h2 class="text-3xl font-bold text-red-600 mt-2">
                    {{ number_format($totalTaxDue,2) }}
                </h2>
            </div>

        </div>

        {{-- Chart --}}

        <div class="bg-white shadow-xl rounded-2xl p-6 mb-8">

            <h2 class="text-xl font-bold mb-6">
                Revenue vs Expense Trend
            </h2>

            <canvas id="financeChart"></canvas>

        </div>

        {{-- Tax Summary + Quick Actions --}}

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

            <div class="bg-white shadow-xl rounded-2xl p-6">

                <h2 class="text-xl font-bold mb-4">
                    Tax Summary
                </h2>

                <div class="space-y-4">

                    <div class="flex justify-between">
                        <span>Output VAT</span>
                        <span>{{ number_format($outputVat,2) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Input VAT</span>
                        <span>{{ number_format($inputVat,2) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Withholding Tax</span>
                        <span>{{ number_format($totalWHT,2) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Salary Tax</span>
                        <span>{{ number_format($totalSalaryTax,2) }}</span>
                    </div>

                    <hr>

                    <div class="flex justify-between font-bold text-lg">
                        <span>Total Tax Due</span>
                        <span>{{ number_format($totalTaxDue,2) }}</span>
                    </div>

                </div>

            </div>

            <div class="bg-white shadow-xl rounded-2xl p-6">

                <h2 class="text-xl font-bold mb-4">
                    Quick Actions
                </h2>

                <div class="grid grid-cols-2 gap-4">

                    <a href="{{ route('business.revenues.create') }}"
                        class="bg-green-600 text-white p-4 rounded-xl text-center">
                        Add Revenue
                    </a>

                    <a href="{{ route('business.expenses.create') }}"
                        class="bg-red-600 text-white p-4 rounded-xl text-center">
                        Add Expense
                    </a>

                    <a href="{{ route('business.payrolls.create') }}"
                        class="bg-purple-600 text-white p-4 rounded-xl text-center">
                        Payroll
                    </a>

                    <a href="{{ route('business.tax-returns.create') }}"
                        class="bg-indigo-600 text-white p-4 rounded-xl text-center">
                        Tax Return
                    </a>

                </div>

            </div>

        </div>

        {{-- Recent Transactions --}}

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-white shadow-xl rounded-2xl p-6">

                <h2 class="text-xl font-bold mb-4">
                    Recent Revenues
                </h2>

                @forelse($recentRevenues as $revenue)

                <div class="flex justify-between py-3 border-b">

                    <span>
                        {{ $revenue->customer_name }}
                    </span>

                    <span class="text-green-600 font-semibold">
                        {{ number_format($revenue->amount,2) }}
                    </span>

                </div>

                @empty

                <p class="text-gray-500">
                    No revenue records
                </p>

                @endforelse

            </div>

            <div class="bg-white shadow-xl rounded-2xl p-6">

                <h2 class="text-xl font-bold mb-4">
                    Recent Expenses
                </h2>

                @forelse($recentExpenses as $expense)

                <div class="flex justify-between py-3 border-b">

                    <span>
                        {{ $expense->supplier_name }}
                    </span>

                    <span class="text-red-600 font-semibold">
                        {{ number_format($expense->amount,2) }}
                    </span>

                </div>

                @empty

                <p class="text-gray-500">
                    No expense records
                </p>

                @endforelse

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx =
            document.getElementById('financeChart');

        new Chart(ctx, {

            type: 'bar',

            data: {

                labels: @json($months),

                datasets: [

                    {
                        label: 'Revenue',
                        data: @json($monthlyRevenue),
                        backgroundColor: '#16a34a'
                    },

                    {
                        label: 'Expense',
                        data: @json($monthlyExpense),
                        backgroundColor: '#dc2626'
                    }

                ]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {
                        position: 'top'
                    }

                }

            }

        });
    </script>

</x-app-layout>