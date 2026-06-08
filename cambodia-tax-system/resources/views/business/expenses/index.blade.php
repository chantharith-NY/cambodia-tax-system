<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex justify-between mb-4">

            <h2 class="text-2xl font-bold">
                Expense List
            </h2>

            <a
                href="{{ route('business.expenses.create') }}"
                class="bg-red-600 text-white px-4 py-2 rounded">
                Add Expense
            </a>

        </div>

        @if(session('success'))

        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>

        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-3 text-left">
                            Supplier
                        </th>

                        <th class="p-3 text-left">
                            Category
                        </th>

                        <th class="p-3 text-left">
                            Amount
                        </th>

                        <th class="p-3 text-left">
                            Base Amount
                        </th>

                        <th class="p-3 text-left">
                            VAT
                        </th>

                        <th class="p-3 text-left">
                            Date
                        </th>

                        <th class="p-3 text-left">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($expenses as $expense)

                    <tr class="border-t">

                        <td class="p-3">
                            {{ $expense->supplier_name }}
                        </td>

                        <td class="p-3">
                            {{ $expense->category }}
                        </td>

                        <td class="p-3">
                            {{ number_format($expense->amount,2) }}
                        </td>

                        <td class="p-3">
                            {{ number_format($expense->base_amount,2) }}
                        </td>

                        <td class="p-3">
                            {{ number_format($expense->vat_amount,2) }}
                        </td>

                        <td class="p-3">
                            {{ $expense->expense_date }}
                        </td>

                        <td class="p-3 flex gap-2">

                            <a
                                href="{{ route('business.expenses.edit',$expense) }}"
                                class="text-blue-600">
                                Edit
                            </a>

                            <form
                                action="{{ route('business.expenses.destroy',$expense) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')

                                <button
                                    class="text-red-600"
                                    onclick="return confirm('Delete this expense?')">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center p-4">
                            No Expense Found
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