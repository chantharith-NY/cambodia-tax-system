<x-app-layout>

    <div class="max-w-5xl mx-auto py-8">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <div class="flex justify-between items-center mb-8">

                <div>

                    <h1 class="text-3xl font-bold text-gray-900">
                        Employee Details
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Employee profile and tax information.
                    </p>

                </div>

                <a
                    href="{{ route('business.employees.index') }}"
                    class="px-4 py-2 bg-gray-100 rounded-xl">

                    Back

                </a>

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <p class="text-gray-500">Employee Code</p>
                    <p class="font-semibold">
                        {{ $employee->employee_code }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Name</p>
                    <p class="font-semibold">
                        {{ $employee->name }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Position</p>
                    <p class="font-semibold">
                        {{ $employee->position }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Residency Status</p>
                    <p class="font-semibold">
                        {{ ucfirst(str_replace('_',' ',$employee->residency_status)) }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Salary</p>
                    <p class="font-semibold text-green-600">
                        {{ number_format($employee->salary,2) }}
                        {{ $employee->currency }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Dependents</p>
                    <p class="font-semibold">
                        {{ $employee->dependents }}
                    </p>
                </div>

                <!-- <div>
                    <p class="text-gray-500">Spouse Count</p>
                    <p class="font-semibold">
                        {{ $employee->spouse_count }}
                    </p>
                </div> -->

                <div>
                    <p class="text-gray-500">Fringe Benefit</p>
                    <p class="font-semibold text-purple-600">
                        {{ number_format($employee->fringe_benefit_khr,2) }}
                        KHR
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Created At</p>
                    <p class="font-semibold">
                        {{ $employee->created_at->format('d M Y') }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>