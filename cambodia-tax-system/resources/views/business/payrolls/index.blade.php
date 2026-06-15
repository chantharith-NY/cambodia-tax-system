<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold text-gray-900">
                    Payroll Management
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage employee payroll and salary tax calculations.
                </p>

            </div>

            <a
                href="{{ route('business.payrolls.create') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-3 rounded-xl shadow">

                + Generate Payroll

            </a>

        </div>

        @if(session('success'))

        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>

        @endif

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">

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

                    <tr class="border-t hover:bg-gray-50 transition">

                        <td class="p-3">
                            {{ $payroll->employee->name }}
                        </td>

                        <td class="p-3">
                            {{ $payroll->payroll_month->format('M Y') }}
                        </td>

                        <td class="p-3 font-semibold">
                            {{ number_format($payroll->gross_salary,2) }}
                        </td>

                        <td class="p-3 text-red-600 font-semibold">
                            {{ number_format($payroll->salary_tax,2) }}
                        </td>

                        <td class="p-3 text-green-600 font-semibold">
                            {{ number_format($payroll->net_salary,2) }}
                        </td>

                        <td class="p-3">

                            <div class="flex gap-2">

                                <a
                                    href="{{ route('business.payrolls.show',$payroll) }}"
                                    class="px-3 py-1 bg-green-100 text-green-700 rounded">

                                    View

                                </a>

                                <a
                                    href="{{ route('business.payrolls.edit',$payroll) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('business.payrolls.destroy',$payroll) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded"
                                        onclick="return confirm('Delete payroll?')">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center py-12">

                            <div>

                                <p class="text-lg font-semibold text-gray-600">
                                    No Payroll Records Found
                                </p>

                                <p class="text-gray-500 mt-2">
                                    Generate your first payroll record.
                                </p>

                            </div>

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