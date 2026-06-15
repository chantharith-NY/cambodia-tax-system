<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <title>
        Cambodia Tax Management System
    </title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])
</head>

<body class="bg-gray-50">

    {{-- Navbar --}}
    <nav class="bg-white shadow">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center h-16">

                <div>
                    <h1 class="font-bold text-xl">
                        Cambodia Tax System
                    </h1>
                </div>

                <div class="space-x-4">

                    <a href="{{ route('login') }}"
                        class="text-gray-700">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded">
                        Register
                    </a>

                </div>

            </div>

        </div>

    </nav>

    {{-- Hero --}}
    <section class="py-20 bg-blue-700 text-white">

        <div class="max-w-7xl mx-auto px-6 text-center">

            <h1 class="text-5xl font-bold mb-6">

                Cambodia Tax Management System

            </h1>

            <p class="text-xl mb-8">

                Calculate taxes instantly,
                manage business taxes efficiently,
                and generate tax reports automatically.

            </p>

            <div class="space-x-4">

                <a href="#calculators"
                    class="bg-white text-blue-700 px-6 py-3 rounded font-semibold">

                    Calculate Tax Now

                </a>

                <a href="{{ route('register') }}"
                    class="bg-green-600 px-6 py-3 rounded">

                    Register Business

                </a>

            </div>

        </div>

    </section>

    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid md:grid-cols-4 gap-6">

                <div class="bg-white shadow-lg rounded-xl p-6 text-center">
                    <h3 class="text-3xl font-bold text-blue-600">10+</h3>
                    <p class="text-gray-500">Supported Taxes</p>
                </div>

                <div class="bg-white shadow-lg rounded-xl p-6 text-center">
                    <h3 class="text-3xl font-bold text-green-600">100%</h3>
                    <p class="text-gray-500">Automated Calculation</p>
                </div>

                <div class="bg-white shadow-lg rounded-xl p-6 text-center">
                    <h3 class="text-3xl font-bold text-purple-600">24/7</h3>
                    <p class="text-gray-500">Available Online</p>
                </div>

                <div class="bg-white shadow-lg rounded-xl p-6 text-center">
                    <h3 class="text-3xl font-bold text-red-600">KHR/USD</h3>
                    <p class="text-gray-500">Multi Currency</p>
                </div>

            </div>

        </div>
    </section>

    {{-- Public Calculators --}}
    <section
        id="calculators"
        class="py-16">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-3xl font-bold text-center mb-12">

                Free Tax Calculators

            </h2>

            <div class="grid md:grid-cols-4 gap-6">

                <a href="{{ route('public.salary-tax') }}"
                    class="bg-white shadow rounded-lg p-6 hover:shadow-lg">

                    <h3 class="font-bold text-lg">
                        Salary Tax
                    </h3>

                    <p class="mt-2 text-gray-600">
                        Calculate monthly salary tax.
                    </p>

                </a>

                <a
                    href="{{ route('public.stamp-tax') }}"
                    class="bg-white shadow rounded-lg p-6 hover:shadow-lg">

                    <h3 class="font-bold text-lg">
                        Stamp Tax Calculator
                    </h3>

                    <p class="mt-2 text-gray-600">
                        Calculate property transfer tax.
                    </p>

                </a>

                <a
                    href="{{ route('public.rental-tax') }}"
                    class="bg-white shadow rounded-lg p-6 hover:shadow-lg">

                    <h3 class="font-bold text-lg">
                        Rental Tax Calculator
                    </h3>

                    <p class="mt-2 text-gray-600">
                        Calculate tax on rental income.
                    </p>

                </a>


            </div>

        </div>

    </section>

    <section class="py-20 bg-gray-100">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center mb-16">
                How It Works
            </h2>

            <div class="grid md:grid-cols-4 gap-8">

                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-full mx-auto flex items-center justify-center text-2xl font-bold">
                        1
                    </div>
                    <h3 class="mt-4 font-bold">
                        Register Business
                    </h3>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-green-600 text-white rounded-full mx-auto flex items-center justify-center text-2xl font-bold">
                        2
                    </div>
                    <h3 class="mt-4 font-bold">
                        Record Transactions
                    </h3>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-600 text-white rounded-full mx-auto flex items-center justify-center text-2xl font-bold">
                        3
                    </div>
                    <h3 class="mt-4 font-bold">
                        Generate Payroll
                    </h3>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-red-600 text-white rounded-full mx-auto flex items-center justify-center text-2xl font-bold">
                        4
                    </div>
                    <h3 class="mt-4 font-bold">
                        Submit Tax Return
                    </h3>
                </div>

            </div>

        </div>

    </section>

    {{-- Business Features --}}
    <section class="bg-white py-16">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-3xl font-bold text-center mb-12">

                Business Features

            </h2>

            <div class="grid md:grid-cols-2 gap-8">

                <div class="bg-gray-50 p-6 rounded">

                    <ul class="space-y-3">

                        <li>✓ Revenue Tracking</li>

                        <li>✓ Expense Tracking</li>

                        <li>✓ Employee Management</li>

                        <li>✓ Payroll Management</li>

                        <li>✓ Tax Return Generation</li>

                    </ul>

                </div>

                <div class="bg-gray-50 p-6 rounded">

                    <ul class="space-y-3">

                        <li>✓ VAT Reports</li>

                        <li>✓ Profit Tax Reports</li>

                        <li>✓ Financial Summary</li>

                        <li>✓ Tax Compliance</li>

                        <li>✓ Dashboard Analytics</li>

                    </ul>

                </div>

            </div>

        </div>

    </section>

    {{-- Supported Taxes --}}
    <section class="py-16">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-3xl font-bold text-center mb-12">

                Taxes Supported

            </h2>

            <div class="grid md:grid-cols-4 gap-4">

                <div class="bg-white p-4 rounded shadow text-center">
                    Salary Tax
                </div>

                <div class="bg-white p-4 rounded shadow text-center">
                    VAT
                </div>

                <div class="bg-white p-4 rounded shadow text-center">
                    Profit Tax
                </div>

                <div class="bg-white p-4 rounded shadow text-center">
                    Withholding Tax
                </div>

                <div class="bg-white p-4 rounded shadow text-center">
                    Prepayment Tax
                </div>

                <div class="bg-white p-4 rounded shadow text-center">
                    Fringe Benefit Tax
                </div>

                <div class="bg-white p-4 rounded shadow text-center">
                    Stamp Tax
                </div>

                <div class="bg-white p-4 rounded shadow text-center">
                    Accommodation Tax
                </div>

            </div>

        </div>

    </section>

    {{-- CTA --}}
    <section class="bg-blue-700 text-white py-20">

        <div class="max-w-4xl mx-auto text-center">

            <h2 class="text-4xl font-bold mb-6">

                Ready to Manage Your Taxes?

            </h2>

            <p class="mb-8">

                Join businesses across Cambodia and simplify your tax management.

            </p>

            <a href="{{ route('register') }}"
                class="bg-white text-blue-700 px-8 py-3 rounded font-bold">

                Register Business Account

            </a>

        </div>

    </section>

</body>

</html>