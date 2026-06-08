<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Edit Employee
            </h2>

            <form
                action="{{ route('business.employees.update', $employee) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label>Employee Code</label>

                        <input
                            type="text"
                            name="employee_code"
                            value="{{ old('employee_code', $employee->employee_code) }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label>Employee Name</label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $employee->name) }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label>Residency Status</label>

                        <select name="residency_status" class="w-full border rounded p-2" required>
                            <option
                                value="resident"
                                {{ $employee->residency_status == 'resident' ? 'selected' : '' }}>
                                Resident
                            </option>

                            <option
                                value="non_resident"
                                {{ $employee->residency_status == 'non_resident' ? 'selected' : '' }}>
                                Non Resident
                            </option>
                        </select>
                    </div>

                    <div>
                        <label>Position</label>

                        <input
                            type="text"
                            name="position"
                            value="{{ old('position', $employee->position) }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label>Monthly Salary</label>

                        <input
                            type="number"
                            step="0.01"
                            name="salary"
                            value="{{ old('salary', $employee->salary) }}"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label>Currency</label>

                        <select
                            name="currency"
                            class="w-full border rounded p-2">

                            <option
                                value="USD"
                                {{ $employee->currency == 'USD' ? 'selected' : '' }}>
                                USD ($)
                            </option>

                            <option
                                value="KHR"
                                {{ $employee->currency == 'KHR' ? 'selected' : '' }}>
                                KHR (៛)
                            </option>

                        </select>
                    </div>

                    <div>
                        <label>Dependents</label>

                        <input
                            type="number"
                            name="dependents"
                            value="{{ old('dependents', $employee->dependents) }}"
                            min="0"
                            class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label>Fringe Benefit (KHR)</label>

                        <input
                            type="number"
                            step="0.01"
                            name="fringe_benefit_khr"
                            value="{{ old('fringe_benefit_khr', $employee->fringe_benefit_khr) }}"
                            class="w-full border rounded p-2">
                    </div>

                </div>

                <div class="mt-6">

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded">
                        Update Employee
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>