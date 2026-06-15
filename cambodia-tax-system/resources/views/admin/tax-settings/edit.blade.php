<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">

            <h2 class="text-3xl font-bold text-blue-800 mb-2">
                Edit Tax Setting
            </h2>

            <p class="text-gray-500 mb-6">
                Update tax configuration and system tax rates.
            </p>

            @if($errors->any())

            <div class="bg-red-100 border border-red-200 text-red-700 p-4 rounded-lg mb-6">

                <ul class="list-disc list-inside">

                    @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif

            <form
                action="{{ route('admin.tax-settings.update', $taxSetting) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tax Code
                        </label>

                        <input
                            type="text"
                            name="tax_code"
                            value="{{ old('tax_code', $taxSetting->tax_code) }}"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500"
                            required>

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tax Name
                        </label>

                        <input
                            type="text"
                            name="tax_name"
                            value="{{ old('tax_name', $taxSetting->tax_name) }}"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500"
                            required>

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tax Rate (%)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="tax_rate"
                            value="{{ old('tax_rate', $taxSetting->tax_rate) }}"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500"
                            required>

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Effective Date
                        </label>

                        <input
                            type="date"
                            name="effective_date"
                            value="{{ old('effective_date', \Carbon\Carbon::parse($taxSetting->effective_date)->format('Y-m-d')) }}"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500"
                            required>

                    </div>

                </div>

                <div class="mt-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="4"
                        class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500">{{ old('description', $taxSetting->description) }}</textarea>

                </div>

                <div class="flex gap-3 mt-8">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow">

                        Update Tax Setting

                    </button>

                    <a
                        href="{{ route('admin.tax-settings.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>