<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex items-center justify-between mb-6">

            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Revenue Management
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage invoices and company revenue records
                </p>
            </div>

            <a
                href="{{ route('business.revenues.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow">

                + Add Revenue

            </a>

        </div>

        @if(session('success'))

        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>

        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">

            <table class="min-w-full divide-y divide-gray-200">

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

                    <tr class="border-t hover:bg-gray-50 transition">

                        <td class="p-3">
                            {{ $revenue->invoice_no }}
                        </td>

                        <td class="p-3">
                            {{ $revenue->customer_name }}
                        </td>

                        <td class="p-3">
                            {{ number_format($revenue->amount,2) }} {{ $revenue->currency }}
                        </td>

                        <td class="p-3">
                            {{ number_format($revenue->base_amount,2) }}
                        </td>

                        <td class="p-3">
                            {{ number_format($revenue->vat_amount,2) }}
                        </td>

                        <td class="p-3">
                            {{ \Carbon\Carbon::parse($revenue->invoice_date)->format('d M Y') }}
                        </td>

                        <td class="p-3">

                            <div class="flex gap-3">

                                <a
                                    href="{{ route('business.revenues.show',$revenue) }}"
                                    class="px-3 py-1 bg-green-100 text-green-700 rounded">

                                    View

                                </a>

                                <a
                                    href="{{ route('business.revenues.edit',$revenue) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('business.revenues.destroy',$revenue) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded"
                                        onclick="return confirm('Delete this revenue?')">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center py-12">

                            <div>

                                <p class="text-lg font-semibold text-gray-600">
                                    No Revenue Records Found
                                </p>

                                <p class="text-gray-500 mt-2">
                                    Start by creating your first revenue invoice.
                                </p>

                            </div>

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