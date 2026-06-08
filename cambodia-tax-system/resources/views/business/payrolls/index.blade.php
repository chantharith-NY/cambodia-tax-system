<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                Payroll List
            </h2>

            <a
                href="{{ route('business.payrolls.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded">

                Generate Payroll

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
                            Employee
                        </th>

                        <th class="p-3 text-left">
                            Month
                        </th>

                        <th class="p-3 text-left">
                            Gross Salary
                        </th>

                        <th class="p-3 text-left">
                            Salary Tax
                        </th>

                        <th class="p-3 text-left">
                            Net Salary
                        </th>

                        <th class="p-3 text-left">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($payrolls as $payroll)

                    <tr class="border-t">

                        <td class="p-3">
                            {{ $payroll->employee->name }}
                        </td>

                        <td class="p-3">
                            {{ $payroll->payroll_month->format('M Y') }}
                        </td>

                        <td class="p-3">
                            {{ number_format($payroll->gross_salary, 2) }}
                        </td>

                        <td class="p-3 text-red-600">
                            {{ number_format($payroll->salary_tax, 2) }}
                        </td>

                        <td class="p-3 text-green-600">
                            {{ number_format($payroll->net_salary, 2) }}
                        </td>

                        <td class="p-3 flex gap-3">

                            <a
                                href="{{ route('business.payrolls.edit', $payroll) }}"
                                class="text-blue-600">

                                Edit

                            </a>

                            <form
                                action="{{ route('business.payrolls.destroy', $payroll) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="text-red-600"
                                    onclick="return confirm('Delete payroll?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center p-6">

                            No payroll records found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-4">

            {{ $payrolls->links() }}

        </div>

    </div>

</x-app-layout>