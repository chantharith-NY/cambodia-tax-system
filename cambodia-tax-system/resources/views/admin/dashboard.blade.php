<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="mb-8">

            <h1 class="text-3xl font-bold text-gray-900">
                Admin Dashboard
            </h1>

            <p class="text-gray-500 mt-1">
                Cambodia Tax Management System Control Center
            </p>

        </div>

        {{-- Statistics --}}
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-8">

            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl p-5 shadow">
                <p class="text-gray-500">Users</p>
                <h2 class="text-2xl font-bold text-blue-600">
                    {{ $totalUsers }}
                </h2>
            </div>

            <div class="bg-green-50 border-l-4 border-green-500 rounded-xl p-5 shadow">
                <p class="text-gray-500">Companies</p>
                <h2 class="text-2xl font-bold text-green-600">
                    {{ $totalCompanies }}
                </h2>
            </div>

            <div class="bg-purple-50 border-l-4 border-purple-500 rounded-xl p-5 shadow">
                <p class="text-gray-500">Revenue Records</p>
                <h2 class="text-2xl font-bold text-purple-600">
                    {{ $totalRevenues }}
                </h2>
            </div>

            <div class="bg-red-50 border-l-4 border-red-500 rounded-xl p-5 shadow">
                <p class="text-gray-500">Expense Records</p>
                <h2 class="text-2xl font-bold text-red-600">
                    {{ $totalExpenses }}
                </h2>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-xl p-5 shadow">
                <p class="text-gray-500">Payrolls</p>
                <h2 class="text-2xl font-bold text-yellow-600">
                    {{ $totalPayrolls }}
                </h2>
            </div>

            <div class="bg-indigo-50 border-l-4 border-indigo-500 rounded-xl p-5 shadow">
                <p class="text-gray-500">Tax Returns</p>
                <h2 class="text-2xl font-bold text-indigo-600">
                    {{ $totalTaxReturns }}
                </h2>
            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="grid md:grid-cols-5 gap-4 mb-8">

            <a href="{{ route('admin.users.index') }}"
                class="bg-blue-600 text-white p-5 rounded-xl text-center shadow">
                Users
            </a>

            <a href="{{ route('admin.companies.index') }}"
                class="bg-green-600 text-white p-5 rounded-xl text-center shadow">
                Companies
            </a>

            <a href="{{ route('admin.tax-settings.index') }}"
                class="bg-purple-600 text-white p-5 rounded-xl text-center shadow">
                Tax Settings
            </a>

            <a href="{{ route('admin.salary-tax-brackets.index') }}"
                class="bg-yellow-600 text-white p-5 rounded-xl text-center shadow">
                Salary Tax
            </a>

            <a href="{{ route('admin.income-tax-brackets.index') }}"
                class="bg-red-600 text-white p-5 rounded-xl text-center shadow">
                Income Tax
            </a>

        </div>

        {{-- Latest Data --}}
        <div class="grid md:grid-cols-2 gap-6">

            <div class="bg-white shadow-xl rounded-2xl p-6">

                <h2 class="text-xl font-bold mb-4">
                    Latest Companies
                </h2>

                @forelse($latestCompanies as $company)

                <div class="border-b py-3">

                    <div class="font-semibold">
                        {{ $company->company_name }}
                    </div>

                    <div class="text-sm text-gray-500">
                        {{ $company->tax_number }}
                    </div>

                </div>

                @empty

                <p>No companies found.</p>

                @endforelse

            </div>

            <div class="bg-white shadow-xl rounded-2xl p-6">

                <h2 class="text-xl font-bold mb-4">
                    Latest Users
                </h2>

                @forelse($latestUsers as $user)

                <div class="border-b py-3">

                    <div class="font-semibold">
                        {{ $user->name }}
                    </div>

                    <div class="text-sm text-gray-500">
                        {{ $user->email }}
                    </div>

                </div>

                @empty

                <p>No users found.</p>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>