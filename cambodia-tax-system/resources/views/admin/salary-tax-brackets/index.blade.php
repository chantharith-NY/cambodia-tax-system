<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold text-gray-900">
                    Salary Tax Brackets
                </h1>

                <p class="text-gray-500 mt-1">
                    Configure salary tax rates for resident and non-resident employees.
                </p>

            </div>

            <a
                href="{{ route('admin.salary-tax-brackets.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow">

                + Add Bracket

            </a>

        </div>

        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">Resident Type</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">Min Salary</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">Max Salary</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">Tax Rate</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">Deduction</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">Effective Date</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($salaryTaxBrackets as $bracket)

                    <tr class="border-t hover:bg-gray-50 transition">

                        <td class="px-4 py-4">
                            @if($bracket->resident_type === 'resident')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Resident
                            </span>

                            @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                Non Resident
                            </span>

                            @endif
                        </td>

                        <td class="px-4 py-4">
                            {{ number_format($bracket->min_salary,2) }}
                        </td>

                        <td class="px-4 py-4">
                            @if($bracket->max_salary)

                            {{ number_format($bracket->max_salary,2) }}

                            @else

                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">
                                No Limit
                            </span>

                            @endif
                        </td>

                        <td class="px-4 py-4">
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $bracket->tax_rate }}%
                            </span>
                        </td>

                        <td class="px-4 py-4">
                            {{ number_format($bracket->deduction_amount, 0) }}
                        </td>

                        <td class="px-4 py-4">
                            {{ \Carbon\Carbon::parse($bracket->effective_date)->format('d M Y') }}
                        </td>

                        <td class="px-4 py-4">

                            <div class="flex gap-2">

                                <a
                                    href="{{ route('admin.salary-tax-brackets.edit',$bracket) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('admin.salary-tax-brackets.destroy',$bracket) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete this bracket?')"
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded-lg">

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
                                    No Salary Tax Brackets Found
                                </p>

                                <p class="text-gray-500 mt-2">
                                    Create your first salary tax configuration.
                                </p>

                            </div>

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>