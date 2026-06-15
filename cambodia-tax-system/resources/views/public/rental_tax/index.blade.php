<x-public-layout>

    <div class="max-w-7xl mx-auto py-12 px-6">

        {{-- Header --}}
        <div class="text-center mb-10">

            <h1 class="text-4xl font-bold text-gray-900">
                Rental Tax Calculator
            </h1>

            <p class="text-gray-500 mt-3">
                Calculate Cambodia rental income tax instantly.
            </p>

        </div>

        <div class="grid lg:grid-cols-2 gap-10 items-start">

            {{-- Calculator --}}
            <div class="bg-white shadow-xl rounded-2xl border border-gray-100 p-8">

                <div class="flex items-center gap-4 mb-8">

                    <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center text-2xl">
                        🏢
                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-gray-800">
                            Rental Information
                        </h2>

                        <p class="text-gray-500">
                            Enter your rental income to calculate tax.
                        </p>

                    </div>

                </div>

                <form
                    method="POST"
                    action="{{ route('public.rental-tax.calculate') }}">

                    @csrf

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Rental Income (KHR)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="rental_income"
                            value="{{ old('rental_income') }}"
                            placeholder="Example: 5,000,000"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            required>

                    </div>

                    <div class="mt-8 flex gap-4">

                        <button
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl font-semibold shadow">

                            Calculate Tax

                        </button>

                        <a
                            href="{{ url('/') }}"
                            class="border border-gray-300 hover:border-gray-400 bg-white px-8 py-3 rounded-xl font-semibold text-gray-700 shadow-sm">

                            Back to Homepage

                        </a>

                    </div>

                </form>

            </div>

            {{-- Information Panel --}}
            <div class="bg-gradient-to-br from-green-600 to-emerald-700 rounded-2xl shadow-xl p-8 text-white">

                <h2 class="text-3xl font-bold mb-6">
                    About Rental Tax
                </h2>

                <p class="text-green-100 leading-relaxed mb-6">
                    Rental Tax applies to income earned from renting property.
                    The tax is calculated as a percentage of total rental income
                    according to Cambodian tax regulations.
                </p>

                <div class="space-y-4">

                    <div class="bg-white/10 rounded-xl p-4">

                        <h3 class="font-semibold text-lg">
                            Tax Rate
                        </h3>

                        <p class="text-green-100">
                            Standard Rate: 10%
                        </p>

                    </div>

                    <div class="bg-white/10 rounded-xl p-4">

                        <h3 class="font-semibold text-lg">
                            Applies To
                        </h3>

                        <p class="text-green-100">
                            Rental income from houses, apartments,
                            buildings, land, and commercial properties.
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- Formula --}}
        <div class="mt-10 bg-white rounded-2xl shadow-xl p-8">

            <h2 class="text-2xl font-bold mb-4">
                Tax Formula
            </h2>

            <div class="bg-green-50 border border-green-100 rounded-xl p-6">

                <p class="text-xl font-semibold text-green-700">
                    Rental Tax = Rental Income × 10%
                </p>

            </div>

        </div>

        {{-- Result --}}
        @isset($result)

        <div class="mt-10 bg-white shadow-xl rounded-2xl border border-gray-100 overflow-hidden">

            <div class="bg-green-600 text-white px-8 py-4">

                <h2 class="text-2xl font-bold">
                    Calculation Result
                </h2>

            </div>

            <div class="p-8">

                <div class="grid md:grid-cols-4 gap-6">

                    <div class="bg-gray-50 rounded-xl p-6">

                        <p class="text-gray-500 text-sm">
                            Rental Income
                        </p>

                        <h3 class="text-2xl font-bold text-gray-800 mt-2">
                            {{ number_format($result['rental_income'],2) }}
                        </h3>

                        <p class="text-gray-500">
                            KHR
                        </p>

                    </div>

                    <div class="bg-blue-50 rounded-xl p-6">

                        <p class="text-blue-600 text-sm">
                            Tax Rate
                        </p>

                        <h3 class="text-2xl font-bold text-blue-700 mt-2">
                            {{ $result['tax_rate'] }}%
                        </h3>

                    </div>

                    <div class="bg-red-50 rounded-xl p-6">

                        <p class="text-red-600 text-sm">
                            Rental Tax
                        </p>

                        <h3 class="text-2xl font-bold text-red-700 mt-2">
                            {{ number_format($result['rental_tax'],2) }}
                        </h3>

                        <p class="text-red-500">
                            KHR
                        </p>

                    </div>

                    <div class="bg-green-50 rounded-xl p-6">

                        <p class="text-green-600 text-sm">
                            Net Income
                        </p>

                        <h3 class="text-2xl font-bold text-green-700 mt-2">
                            {{ number_format($result['net_income'],2) }}
                        </h3>

                        <p class="text-green-500">
                            KHR
                        </p>

                    </div>

                </div>

            </div>

        </div>

        @endisset

        {{-- Example --}}
        <div class="mt-6 bg-green-50 border border-green-100 rounded-xl p-6">

            <h3 class="font-bold text-green-700 mb-2">
                Example
            </h3>

            <p>
                Rental Income = 10,000,000 KHR
            </p>

            <p>
                Rental Tax = 10,000,000 × 10%
            </p>

            <p class="font-bold text-green-700">
                = 1,000,000 KHR
            </p>

            <p class="mt-2">
                Net Income = 10,000,000 - 1,000,000
            </p>

            <p class="font-bold text-green-700">
                = 9,000,000 KHR
            </p>

        </div>

    </div>

</x-public-layout>