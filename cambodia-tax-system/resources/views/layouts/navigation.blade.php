<nav
    x-data="{ open: false }"
    class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-200 shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            {{-- Left Side --}}
            <div class="flex items-center">

                {{-- Logo --}}
                <div class="shrink-0 flex items-center">

                    <a
                        href="{{ route('dashboard') }}"
                        class="flex items-center gap-3">

                        <img
                            src="https://www.tax.gov.kh/images/logo-3d.png"
                            alt="GDT Logo"
                            class="h-10 w-10 object-contain">

                        <div>

                            <div class="font-bold text-blue-900 text-lg">
                                Cambodia Tax
                            </div>

                            <div class="text-xs text-gray-500">
                                Management System
                            </div>

                        </div>

                    </a>

                </div>

                {{-- Business Company Badge --}}
                @if(Auth::user()?->role === 'business' && Auth::user()->company)

                <div class="hidden lg:flex ml-6">

                    <span
                        class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">

                        {{ Auth::user()->company->company_name }}

                    </span>

                </div>

                @endif

                {{-- Navigation --}}
                <div class="hidden sm:flex sm:items-center sm:ms-10 space-x-6">

                    @if(Auth::user()?->role === 'admin')

                    <x-nav-link
                        :href="route('admin.dashboard')"
                        :active="request()->routeIs('admin.dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link
                        :href="route('admin.users.index')"
                        :active="request()->routeIs('admin.users.*')">
                        Users
                    </x-nav-link>

                    <x-nav-link
                        :href="route('admin.companies.index')"
                        :active="request()->routeIs('admin.companies.*')">
                        Companies
                    </x-nav-link>

                    <x-nav-link
                        :href="route('admin.tax-settings.index')"
                        :active="request()->routeIs('admin.tax-settings.*')">
                        Tax Settings
                    </x-nav-link>

                    <x-nav-link
                        :href="route('admin.salary-tax-brackets.index')"
                        :active="request()->routeIs('admin.salary-tax-brackets.*')">
                        Salary Tax
                    </x-nav-link>

                    <x-nav-link
                        :href="route('admin.income-tax-brackets.index')"
                        :active="request()->routeIs('admin.income-tax-brackets.*')">
                        Income Tax
                    </x-nav-link>

                    @endif

                    @if(Auth::user()?->role === 'business')

                    <x-nav-link
                        :href="route('business.dashboard')"
                        :active="request()->routeIs('business.dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link
                        :href="route('business.revenues.index')"
                        :active="request()->routeIs('business.revenues.*')">
                        Revenue
                    </x-nav-link>

                    <x-nav-link
                        :href="route('business.expenses.index')"
                        :active="request()->routeIs('business.expenses.*')">
                        Expense
                    </x-nav-link>

                    <x-nav-link
                        :href="route('business.employees.index')"
                        :active="request()->routeIs('business.employees.*')">
                        Employee
                    </x-nav-link>

                    <x-nav-link
                        :href="route('business.payrolls.index')"
                        :active="request()->routeIs('business.payrolls.*')">
                        Payroll
                    </x-nav-link>

                    <x-nav-link
                        :href="route('business.tax-returns.index')"
                        :active="request()->routeIs('business.tax-returns.*')">
                        Tax Return
                    </x-nav-link>

                    @endif

                    @if(Auth::user()?->role === 'individual')

                    <x-nav-link
                        :href="route('individual.dashboard')"
                        :active="request()->routeIs('individual.dashboard')">
                        Dashboard
                    </x-nav-link>

                    @endif

                </div>

            </div>

            {{-- Right Side --}}
            <div class="hidden sm:flex items-center gap-4">

                {{-- Quick Actions --}}
                @if(Auth::user()?->role === 'business')

                <a
                    href="{{ route('business.revenues.create') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm font-medium">

                    + Revenue

                </a>

                <a
                    href="{{ route('business.expenses.create') }}"
                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium">

                    + Expense

                </a>

                @endif

                {{-- Notification --}}
                <button
                    class="relative text-gray-500 hover:text-blue-600">

                    <!-- <img src="https://pngtree.com/so/notification-icon" alt="Notification" class="w-5 h-5"> -->
                    🔔

                    <span
                        class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full">
                    </span>

                </button>

                {{-- User Dropdown --}}
                <x-dropdown align="right" width="56">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center gap-3 px-3 py-2 rounded-xl border border-gray-200 bg-white hover:bg-gray-50">

                            <div class="text-right">

                                <div class="font-semibold text-gray-800">

                                    {{ Auth::user()->name }}

                                </div>

                                <div class="text-xs">

                                    @if(Auth::user()->role === 'admin')

                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full">
                                        Admin
                                    </span>

                                    @elseif(Auth::user()->role === 'business')

                                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                                        Business
                                    </span>

                                    @else

                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full">
                                        Individual
                                    </span>

                                    @endif

                                </div>

                            </div>

                            <svg
                                class="w-4 h-4"
                                fill="currentColor"
                                viewBox="0 0 20 20">

                                <path
                                    fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />

                            </svg>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">

                            Profile

                        </x-dropdown-link>

                        <form
                            method="POST"
                            action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">

                                Logout

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- Mobile Menu Button --}}
            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = !open"
                    class="p-2 rounded-md text-gray-500 hover:bg-gray-100">

                    ☰

                </button>

            </div>

        </div>

    </div>

</nav>