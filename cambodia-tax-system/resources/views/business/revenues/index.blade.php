<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex justify-between mb-4">

            <h2 class="text-2xl font-bold">
                Revenue List
            </h2>

            <a
                href="{{ route('business.revenues.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded">
                Add Revenue
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
                            Invoice
                        </th>

                        <th class="p-3 text-left">
                            Customer
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

                    @forelse($revenues as $revenue)

                    <tr class="border-t">

                        <td class="p-3">
                            {{ $revenue->invoice_no }}
                        </td>

                        <td class="p-3">
                            {{ $revenue->customer_name }}
                        </td>

                        <td class="p-3">
                            {{ number_format($revenue->amount,2) }}
                        </td>

                        <td class="p-3">
                            {{ number_format($revenue->base_amount,2) }}
                        </td>

                        <td class="p-3">
                            {{ number_format($revenue->vat_amount,2) }}
                        </td>

                        <td class="p-3">
                            {{ $revenue->invoice_date }}
                        </td>

                        <td class="p-3 flex gap-2">

                            <a
                                href="{{ route('business.revenues.edit',$revenue) }}"
                                class="text-blue-600">
                                Edit
                            </a>

                            <form
                                action="{{ route('business.revenues.destroy',$revenue) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')

                                <button
                                    class="text-red-600"
                                    onclick="return confirm('Delete this revenue?')">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="7"
                            class="p-4 text-center">
                            No Revenue Found
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-4">

            {{ $revenues->links() }}

        </div>

    </div>

</x-app-layout>