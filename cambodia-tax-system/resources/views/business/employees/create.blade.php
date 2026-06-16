<x-app-layout>

    <div class="max-w-5xl mx-auto py-8">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-green-700">
                    Add Employee
                </h1>

                <p class="text-gray-500 mt-2">
                    Register employees for payroll, salary tax and fringe benefit calculations.
                </p>

            </div>

            <form
                action="{{ route('business.employees.store') }}"
                method="POST">

                @csrf

                {{-- Employee Information --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Employee Information
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Employee Code
                            </label>

                            <input
                                type="text"
                                name="employee_code"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Employee Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                    </div>

                </div>

                {{-- Employment Information --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Employment Information
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Position
                            </label>

                            <input
                                type="text"
                                name="position"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Residency Status
                            </label>

                            <select
                                name="residency_status"
                                class="w-full border rounded-lg p-3"
                                required>

                                <option value="resident">
                                    Resident
                                </option>

                                <option value="non_resident">
                                    Non Resident
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                {{-- Salary Information --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Salary Information
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Monthly Salary
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="salary"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Currency
                            </label>

                            <select
                                name="currency"
                                class="w-full border rounded-lg p-3"
                                required>

                                <option value="USD">
                                    USD ($)
                                </option>

                                <option value="KHR">
                                    KHR (៛)
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                {{-- Tax Information --}}
                <div class="border rounded-xl p-6 mb-6">

                    <h3 class="text-lg font-bold mb-4">
                        Tax Information
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <!-- <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Spouse Count
                            </label>

                            <input
                                type="number"
                                name="spouse_count"
                                value="0"
                                min="0"
                                max="1"
                                class="w-full border rounded-lg p-3">

                        </div> -->

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Dependents
                            </label>

                            <input
                                type="number"
                                name="dependents"
                                value="0"
                                min="0"
                                class="w-full border rounded-lg p-3">

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Fringe Benefit (KHR)
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="fringe_benefit_khr"
                                value="0"
                                class="w-full border rounded-lg p-3">

                        </div>

                    </div>

                </div>

                {{-- Information Notice --}}
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">

                    <p class="text-sm text-green-700">

                        The system will automatically calculate salary tax,
                        net salary and payroll deductions based on the
                        employee's salary, residency status and dependents.

                    </p>

                </div>

                <div class="flex justify-end gap-3">

                    <a
                        href="{{ route('business.employees.index') }}"
                        class="px-5 py-3 bg-gray-100 rounded-xl">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl shadow">

                        Save Employee

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>