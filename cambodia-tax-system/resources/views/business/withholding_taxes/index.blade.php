<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                Withholding Taxes
            </h2>

            <a
                href="{{ route('business.withholding-taxes.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded">

                Add Withholding Tax

            </a>

        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-3 text-left">
                            Vendor
                        </th>

                        <th class="p-3 text-left">
                            Type
                        </th>

                        <th class="p-3 text-left">
                            Gross Amount
                        </th>

                        <th class="p-3 text-left">
                            Tax
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

                    @foreach($withholdingTaxes as $tax)

                    <tr class="border-t">

                        <td class="p-3">
                            {{ $tax->vendor_name }}
                        </td>

                        <td class="p-3">
                            {{ ucfirst(str_replace('_', ' ', $tax->payment_type)) }}
                        </td>

                        <td class="p-3">
                            {{ number_format($tax->gross_amount, 2) }} KHR
                        </td>

                        <td class="p-3">
                            {{ number_format($tax->withholding_tax, 2) }} KHR
                        </td>

                        <td class="p-3">
                            {{ $tax->payment_date->format('d-M-Y') }}
                        </td>

                        <td class="p-3 flex gap-2">

                            <a
                                href="{{ route('business.withholding-taxes.show', $tax) }}"
                                class="text-blue-600">
                                View
                            </a>

                            <a
                                href="{{ route('business.withholding-taxes.edit', $tax) }}"
                                class="text-green-600">
                                Edit
                            </a>

                            <form
                                action="{{ route('business.withholding-taxes.destroy', $tax) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="text-red-600"
                                    onclick="return confirm('Delete this record?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="mt-4">

            {{ $withholdingTaxes->links() }}

        </div>

    </div>

</x-app-layout>