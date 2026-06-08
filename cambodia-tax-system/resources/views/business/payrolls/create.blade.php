<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Create Payroll
            </h2>

            <form
                action="{{ route('business.payrolls.store') }}"
                method="POST">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>

                        <label>
                            Employee
                        </label>

                        <select
                            name="employee_id"
                            class="w-full border rounded p-2"
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

                        <label>
                            Payroll Month
                        </label>

                        <input
                            type="date"
                            name="payroll_month"
                            class="w-full border rounded p-2"
                            required>

                    </div>

                </div>

                <div class="mt-6">

                    <button
                        type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded">

                        Generate Payroll

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>