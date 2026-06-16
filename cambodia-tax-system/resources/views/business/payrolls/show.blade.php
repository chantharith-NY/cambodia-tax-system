<x-app-layout>

    <div class="max-w-5xl mx-auto py-8">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="flex justify-between items-center mb-8">

                <div>

                    <h1 class="text-3xl font-bold text-gray-900">
                        Employee Details
                    </h1>

                    <p class="text-gray-500 mt-1">
                        View employee information and tax details.
                    </p>

                </div>

                <a
                    href="{{ route('business.employees.index') }}"
                    class="px-4 py-2 bg-gray-100 rounded-xl">

                    Back

                </a>

            </div>

            {{-- Employee Information --}}
            <div class="border rounded-xl p-6 mb-6">

                <h2 class="text-xl font-bold mb-4">
                    Employee Information
                </h2>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-gray-500">Employee Code</p>
                        <p class="font-semibold">
                            {{ $payroll->employee->employee_code }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Employee Name</p>
                        <p class="font-semibold">
                            {{ $payroll->employee->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Position</p>
                        <p class="font-semibold">
                            {{ $payroll->employee->salary }}
                            {{ $payroll->employee->currency }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Residency Status</p>

                        @if($payroll->employee->residency_status === 'resident')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            Resident
                        </span>

                        @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                            Non Resident
                        </span>

                        @endif

                    </div>

                </div>

            </div>

            {{-- Salary Information --}}
            <div class="border rounded-xl p-6 mb-6">

                <h2 class="text-xl font-bold mb-4">
                    Salary Information
                </h2>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-gray-500">Monthly Salary</p>
                        <p class="font-semibold text-blue-600">
                            {{ number_format($payroll->employee->salary,2) }}
                            {{ $payroll->employee->currency }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Dependents</p>
                        <p class="font-semibold">
                            {{ $payroll->employee->dependents }}
                        </p>
                    </div>

                    <!-- <div>
                        <p class="text-gray-500">Spouse Count</p>
                        <p class="font-semibold">
                            {{ $payroll->employee->spouse_count ?? 0 }}
                        </p>
                    </div> -->

                    <div>
                        <p class="text-gray-500">
                            Fringe Benefit
                        </p>

                        <p class="font-semibold text-purple-600">
                            {{ number_format($payroll->employee->fringe_benefit_khr,2) }}
                            KHR
                        </p>
                    </div>

                </div>

            </div>

            {{-- Payroll History --}}
            <div class="border rounded-xl p-6">

                <h2 class="text-xl font-bold mb-4">
                    Payroll History
                </h2>

                @if($payroll->employee->payrolls->count())

                <table class="w-full">

                    <thead>

                        <tr class="border-b">

                            <th class="text-left py-2">
                                Month
                            </th>

                            <th class="text-left py-2">
                                Gross Salary
                            </th>

                            <th class="text-left py-2">
                                Salary Tax
                            </th>

                            <th class="text-left py-2">
                                Net Salary
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($payroll->employee->payrolls as $payroll)

                        <tr class="border-b">

                            <td class="py-3">
                                {{ \Carbon\Carbon::parse($payroll->payroll_month)->format('M Y') }}
                            </td>

                            <td>
                                {{ number_format($payroll->gross_salary,2) }}
                            </td>

                            <td>
                                {{ number_format($payroll->salary_tax,2) }}
                            </td>

                            <td class="text-green-600 font-semibold">
                                {{ number_format($payroll->net_salary,2) }}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

                @else

                <p class="text-gray-500">
                    No payroll records found.
                </p>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>