<x-app-layout>

    <div class="max-w-5xl mx-auto py-6">

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">

                <h1 class="text-3xl font-bold text-white">
                    {{ $company->company_name }}
                </h1>

                <p class="text-blue-100 mt-1">
                    Company Profile & Registration Information
                </p>

            </div>

            <!-- Content -->
            <div class="p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-1">
                            Company Name
                        </p>

                        <p class="font-semibold text-gray-900">
                            {{ $company->company_name }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-1">
                            Tax Number
                        </p>

                        <p class="font-semibold text-gray-900">
                            {{ $company->tax_number }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-1">
                            Owner Name
                        </p>

                        <p class="font-semibold text-gray-900">
                            {{ $company->owner?->name }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-1">
                            Email Address
                        </p>

                        <p class="font-semibold text-gray-900">
                            {{ $company->owner?->email }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-1">
                            Industry
                        </p>

                        <p class="font-semibold text-gray-900">
                            {{ $company->industry }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-1">
                            Business Type
                        </p>

                        <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-medium">

                            {{ ucfirst(str_replace('_', ' ', $company->business_type)) }}

                        </span>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-1">
                            Phone Number
                        </p>

                        <p class="font-semibold text-gray-900">
                            {{ $company->phone ?? 'N/A' }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-1">
                            Registration Date
                        </p>

                        <p class="font-semibold text-gray-900">
                            {{ $company->created_at->format('d M Y') }}
                        </p>
                    </div>

                </div>

                <div class="mt-6 bg-gray-50 rounded-xl p-4">

                    <p class="text-sm text-gray-500 mb-2">
                        Address
                    </p>

                    <p class="font-semibold text-gray-900">
                        {{ $company->address ?? 'No address provided' }}
                    </p>

                </div>

                <!-- Footer Buttons -->
                <div class="flex gap-3 mt-8">

                    <a
                        href="{{ route('admin.companies.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">

                        Back

                    </a>

                    <form
                        action="{{ route('admin.companies.destroy', $company) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            onclick="return confirm('Delete this company?')"
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl">

                            Delete Company

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>