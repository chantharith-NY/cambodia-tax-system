<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                Tax Returns
            </h2>

            <a
                href="{{ route('business.tax-returns.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded">

                Generate Tax Return

            </a>

        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-3 text-left">
                            Month
                        </th>

                        <th class="p-3 text-left">
                            Total Tax Due
                        </th>

                        <th class="p-3 text-left">
                            Status
                        </th>

                        <th class="p-3 text-left">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($taxReturns as $taxReturn)

                    <tr class="border-t">

                        <td class="p-3">
                            {{ $taxReturn->tax_month->format('F Y') }}
                        </td>

                        <td class="p-3">
                            {{ number_format($taxReturn->total_tax_due, 2) }} KHR
                        </td>

                        <td class="p-3">
                            @if($taxReturn->status == 'draft')

                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">
                                Draft
                            </span>

                            @elseif($taxReturn->status == 'submitted')

                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">
                                Submitted
                            </span>

                            @else

                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">
                                Paid
                            </span>

                            @endif
                        </td>

                        <td class="p-3">

                            <a
                                href="{{ route('business.tax-returns.show', $taxReturn) }}"
                                class="text-blue-600">

                                View

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="4"
                            class="p-4 text-center">

                            No tax returns found.

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