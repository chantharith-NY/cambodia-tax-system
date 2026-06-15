<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold text-gray-900">
                    Employee Management
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage employee information and payroll taxation.
                </p>

            </div>

            <a
                href="{{ route('business.employees.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow">

                + Add Employee

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
                            Employee Code
                        </th>

                        <th class="p-3 text-left">
                            Name
                        </th>

                        <th class="p-3 text-left">
                            Residency Status
                        </th>

                        <th class="p-3 text-left">
                            Position
                        </th>

                        <th class="p-3 text-left">
                            Salary
                        </th>

                        <th class="p-3 text-left">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($employees as $employee)

                    <tr class="border-t">

                        <td class="p-3">
                            {{ $employee->employee_code }}
                        </td>

                        <td class="p-3">
                            {{ $employee->name }}
                        </td>

                        <td class="p-3">
                            @if($employee->residency_status === 'resident')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Resident
                            </span>

                            @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                Non Resident
                            </span>

                            @endif
                        </td>

                        <td class="p-3">
                            {{ $employee->position }}
                        </td>

                        <td class="p-3">
                            {{ number_format($employee->salary,2) }}
                            {{ $employee->currency }}
                        </td>

                        <td class="p-3">

                            <div class="flex gap-2">

                                <a
                                    href="{{ route('business.employees.show',$employee) }}"
                                    class="px-3 py-1 bg-green-100 text-green-700 rounded">

                                    View

                                </a>

                                <a
                                    href="{{ route('business.employees.edit',$employee) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('business.employees.destroy',$employee) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded"
                                        onclick="return confirm('Delete this employee?')">

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
                                    No Employees Found
                                </p>

                                <p class="text-gray-500 mt-2">
                                    Start by registering your first employee.
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-4">

            {{ $employees->links() }}

        </div>

    </div>

</x-app-layout>