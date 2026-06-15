<x-app-layout>

    <div class="max-w-5xl mx-auto py-8">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-purple-700">
                    Generate Payroll
                </h1>

                <p class="text-gray-500 mt-2">
                    Generate monthly payroll, salary tax and net salary calculations for employees.
                </p>

            </div>

            <form
                action="{{ route('business.payrolls.store') }}"
                method="POST">

                @csrf

                {{-- Employee Selection --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Employee Information
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Employee
                            </label>

                            <select
                                name="employee_id"
                                class="w-full border rounded-lg p-3"
                                required>

                                <option value="">
                                    Select Employee
                                </option>

                                @foreach($employees as $employee)

                                <option value="{{ $employee->id }}">

                                    {{ $employee->employee_code }}
                                    -
                                    {{ $employee->name }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Payroll Month
                            </label>

                            <input
                                type="month"
                                name="payroll_month"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                    </div>

                </div>

                {{-- Information Notice --}}
                <div class="bg-purple-50 border border-purple-200 rounded-xl p-5 mb-6">

                    <h4 class="font-semibold text-purple-700 mb-2">
                        Automatic Payroll Calculation
                    </h4>

                    <ul class="text-sm text-purple-700 space-y-1">

                        <li>✓ Gross Salary Calculation</li>

                        <li>✓ Salary Tax Calculation</li>

                        <li>✓ Residency Tax Rules</li>

                        <li>✓ Dependent & Spouse Deductions</li>

                        <li>✓ Fringe Benefit Tax Consideration</li>

                        <li>✓ Net Salary Calculation</li>

                    </ul>

                </div>

                {{-- Process Flow --}}
                <div class="bg-gray-50 border rounded-xl p-5 mb-6">

                    <h4 class="font-semibold mb-3">
                        Payroll Process
                    </h4>

                    <div class="grid md:grid-cols-4 gap-4 text-center">

                        <div>

                            <div class="bg-blue-100 rounded-full w-10 h-10 flex items-center justify-center mx-auto mb-2">
                                1
                            </div>

                            <p class="text-sm">
                                Select Employee
                            </p>

                        </div>

                        <div>

                            <div class="bg-blue-100 rounded-full w-10 h-10 flex items-center justify-center mx-auto mb-2">
                                2
                            </div>

                            <p class="text-sm">
                                Load Salary Data
                            </p>

                        </div>

                        <div>

                            <div class="bg-blue-100 rounded-full w-10 h-10 flex items-center justify-center mx-auto mb-2">
                                3
                            </div>

                            <p class="text-sm">
                                Calculate Tax
                            </p>

                        </div>

                        <div>

                            <div class="bg-blue-100 rounded-full w-10 h-10 flex items-center justify-center mx-auto mb-2">
                                4
                            </div>

                            <p class="text-sm">
                                Generate Payroll
                            </p>

                        </div>

                    </div>

                </div>

                <div class="flex justify-end gap-3">

                    <a
                        href="{{ route('business.payrolls.index') }}"
                        class="px-5 py-3 bg-gray-100 rounded-xl">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-xl shadow">

                        Generate Payroll

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>