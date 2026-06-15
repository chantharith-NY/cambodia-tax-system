<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold text-gray-900">
                    Tax Return Management
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage monthly tax declarations and compliance reports.
                </p>

            </div>

            <a
                href="{{ route('business.tax-returns.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl shadow">

                + Generate Tax Return

            </a>

        </div>

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Month
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Total Tax Due
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Status
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($taxReturns as $taxReturn)

                    <tr class="border-t hover:bg-gray-50 transition">

                        <td class="px-4 py-4">
                            {{ $taxReturn->tax_month->format('F Y') }}
                        </td>

                        <td class="p-3 font-semibold text-red-600">
                            {{ number_format($taxReturn->total_tax_due, 2) }} KHR
                        </td>

                        <td class="px-4 py-4">
                            @if($taxReturn->status == 'draft')

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                Draft
                            </span>

                            @elseif($taxReturn->status == 'submitted')

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                Submitted
                            </span>

                            @else

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Paid
                            </span>

                            @endif
                        </td>

                        <td class="px-4 py-4">

                            <a
                                href="{{ route('business.tax-returns.show', $taxReturn) }}"
                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg">

                                View

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="text-center py-12">

                            <div>
                                <p class="text-lg font-semibold text-gray-600">
                                    No Tax Returns Found
                                </p>

                                <p class="text-gray-500 mt-2">
                                    Generate your first monthly tax return.
                                </p>
                            </div>
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-4">
            {{ $taxReturns->links() }}
        </div>

    </div>

</x-app-layout>