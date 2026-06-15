<x-public-layout>

    <div class="max-w-7xl mx-auto py-12 px-6">

        {{-- Header --}}
        <div class="text-center mb-10">

            <h1 class="text-4xl font-bold text-gray-900">
                Stamp Tax Calculator
            </h1>

            <p class="text-gray-500 mt-3">
                Calculate Cambodia Property Transfer (Stamp) Tax instantly.
            </p>

        </div>

        <div class="grid lg:grid-cols-2 gap-10 items-start">

            {{-- Calculator Form --}}
            <div class="bg-white shadow-xl rounded-2xl border border-gray-100 p-8">

                <div class="flex items-center gap-4 mb-8">

                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-2xl">
                        🏠
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Property Information
                        </h2>

                        <p class="text-gray-500">
                            Enter the property value to calculate stamp tax.
                        </p>
                    </div>

                </div>

                <form
                    method="POST"
                    action="{{ route('public.stamp-tax.calculate') }}">

                    @csrf

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Property Value (KHR)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="property_value"
                            value="{{ old('property_value') }}"
                            placeholder="Example: 500,000,000"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>

                    </div>

                    <div class="mt-8 flex gap-4">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold shadow">

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

            {{-- Information Card --}}
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl shadow-xl p-8 text-white">

                <h2 class="text-3xl font-bold mb-6">
                    About Stamp Tax
                </h2>

                <p class="text-blue-100 leading-relaxed mb-6">
                    Stamp Tax is payable when ownership of immovable property is transferred.
                    The tax is calculated based on the taxable value of the property according
                    to Cambodian tax regulations.
                </p>

                <div class="space-y-4">

                    <div class="bg-white/10 rounded-xl p-4">
                        <h3 class="font-semibold text-lg">
                            Tax Rate
                        </h3>

                        <p class="text-blue-100">
                            Standard Rate: 4%
                        </p>
                    </div>

                    <div class="bg-white/10 rounded-xl p-4">
                        <h3 class="font-semibold text-lg">
                            Applies To
                        </h3>

                        <p class="text-blue-100">
                            Property transfers and ownership registrations.
                        </p>
                    </div>

                </div>

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

                <div class="grid md:grid-cols-3 gap-6">

                    <div class="bg-gray-50 rounded-xl p-6">

                        <p class="text-gray-500 text-sm">
                            Property Value
                        </p>

                        <h3 class="text-2xl font-bold text-gray-800 mt-2">

                            {{ number_format($result['property_value'],2) }}

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
                            Stamp Tax Due
                        </p>

                        <h3 class="text-2xl font-bold text-red-700 mt-2">

                            {{ number_format($result['stamp_tax'],2) }}

                        </h3>

                        <p class="text-red-500">
                            KHR
                        </p>

                    </div>

                </div>

            </div>

        </div>

        @endisset

        <div class="grid lg:grid-cols-2 gap-8 mt-10">

            {{-- Formula --}}
            <div class="bg-white rounded-2xl shadow-xl p-8">

                <h2 class="text-2xl font-bold mb-4">
                    Stamp Tax Formula
                </h2>

                <div class="bg-blue-50 border border-blue-100 rounded-xl p-6">

                    <p class="text-2xl font-bold text-blue-700">
                        Stamp Tax = Property Value × 4%
                    </p>

                </div>

                <div class="mt-4 text-gray-600">

                    The standard Cambodian Stamp Tax rate is
                    <strong>4%</strong>
                    of the property's taxable value.

                </div>

            </div>

            {{-- Example --}}
            <div class="bg-white rounded-2xl shadow-xl p-8">

                <h2 class="text-2xl font-bold mb-4">
                    Example Calculation
                </h2>

                <div class="space-y-3">

                    <p>
                        Property Value:
                        <strong>500,000,000 KHR</strong>
                    </p>

                    <p>
                        Stamp Tax:
                        <strong>
                            500,000,000 × 4%
                        </strong>
                    </p>

                    <div class="bg-green-50 border border-green-100 rounded-xl p-4">

                        <p class="text-xl font-bold text-green-700">
                            = 20,000,000 KHR
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>



</x-public-layout>