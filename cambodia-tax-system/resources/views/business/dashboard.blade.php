<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold">
            Business Dashboard
        </h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-green-100 p-6 rounded">
            <h3>Total Revenue</h3>
            <p class="text-3xl font-bold">
                ${{ number_format($totalRevenue, 2) }}
            </p>
        </div>

        <div class="bg-red-100 p-6 rounded">
            <h3>Total Expense</h3>
            <p class="text-3xl font-bold">
                ${{ number_format($totalExpense, 2) }}
            </p>
        </div>

        <div class="bg-blue-100 p-6 rounded">
            <h3>Net Profit</h3>
            <p class="text-3xl font-bold">
                ${{ number_format($profit, 2) }}
            </p>
        </div>

        <div class="bg-yellow-100 p-6 rounded">
            <h3>VAT Payable</h3>
            <p class="text-3xl font-bold">
                ${{ number_format($vatPayable, 2) }}
            </p>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


        <a href="{{ route('business.revenues.index') }}"
            class="bg-blue-600 text-white p-6 rounded-lg">

            <h3 class="text-xl font-bold">
                Revenue
            </h3>

            <p>
                Manage company income
            </p>

        </a>

        <a href="{{ route('business.expenses.index') }}"
            class="bg-red-600 text-white p-6 rounded-lg">

            <h3 class="text-xl font-bold">
                Expense
            </h3>

            <p>
                Manage company expenses
            </p>

        </a>

        <a href="{{ route('business.payrolls.index') }}"
            class="bg-purple-600 text-white p-6 rounded-lg">

            <h3 class="text-xl font-bold">
                Payroll
            </h3>

            <p>
                Manage employee payroll
            </p>

        </a>

    </div>
</x-app-layout>