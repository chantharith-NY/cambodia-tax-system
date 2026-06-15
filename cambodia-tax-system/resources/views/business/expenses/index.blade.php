<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold text-gray-900">
                    Expense Management
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage suppliers, expenses, VAT and withholding tax.
                </p>

            </div>

            <a
                href="{{ route('business.expenses.create') }}"
                class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl shadow">

                + Add Expense

            </a>

        </div>

        @if(session('success'))

        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>

        @endif

        <div class="bg-white shadow-xl rounded-2xl overflow-x-auto border border-gray-100">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Supplier
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Supplier Type
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Category
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Amount
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Base Amount
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            VAT
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            WHT %
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            WHT Amount
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Net Payment
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Date
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($expenses as $expense)

                    <tr class="border-t hover:bg-gray-50 transition">

                        <td class="p-3">
                            {{ $expense->supplier_name }}
                        </td>

                        <td class="p-3">

                            @if($expense->supplier_type === 'resident')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Resident
                            </span>

                            @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                Non Resident
                            </span>

                            @endif

                        </td>

                        <td class="p-3">

                            <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">

                                {{ ucfirst($expense->category) }}

                            </span>

                        </td>

                        <td class="p-3">
                            {{ number_format($expense->amount,2) }} {{ $expense->currency }}
                        </td>

                        <td class="p-3">
                            {{ number_format($expense->base_amount,2) }}
                        </td>

                        <td class="p-3">
                            {{ number_format($expense->vat_amount,2) }}
                        </td>

                        <td class="p-3">
                            {{ number_format($expense->withholding_rate, 2) }}%
                        </td>

                        <td class="p-3">
                            {{ number_format($expense->withholding_tax, 2) }}
                        </td>

                        <td class="p-3">
                            {{ number_format($expense->net_payment, 2) }}
                        </td>

                        <td class="p-3">
                            {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}
                        </td>

                        <td class="p-3">

                            <div class="flex gap-2">

                                <a
                                    href="{{ route('business.expenses.show',$expense) }}"
                                    class="px-3 py-1 bg-green-100 text-green-700 rounded-lg">

                                    View

                                </a>

                                <a
                                    href="{{ route('business.expenses.edit',$expense) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('business.expenses.destroy',$expense) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded-lg"
                                        onclick="return confirm('Delete this expense?')">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="11" class="text-center py-12">

                            <div class="text-gray-500">

                                <p class="text-lg font-semibold">
                                    No expenses recorded yet
                                </p>

                                <p class="mt-2">
                                    Start by adding your first expense.
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-4">

            {{ $expenses->links() }}

        </div>

    </div>

</x-app-layout>