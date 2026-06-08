<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                Employee List
            </h2>

            <a
                href="{{ route('business.employees.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded">
                Add Employee
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
                            {{ $employee->residency_status == 'resident' ? 'Resident' : 'Non Resident' }}
                        </td>

                        <td class="p-3">
                            {{ $employee->position }}
                        </td>

                        <td class="p-3">
                            ${{ number_format($employee->salary, 2) }}
                        </td>

                        <td class="p-3 flex gap-3">

                            <a
                                href="{{ route('business.employees.edit', $employee) }}"
                                class="text-blue-600">
                                Edit
                            </a>

                            <form
                                action="{{ route('business.employees.destroy', $employee) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="text-red-600"
                                    onclick="return confirm('Delete this employee?')">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="5"
                            class="text-center p-6">
                            No employees found.
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