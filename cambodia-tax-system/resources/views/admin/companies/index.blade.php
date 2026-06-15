<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="mb-6">

            <h1 class="text-3xl font-bold text-gray-900">
                Company Management
            </h1>

            <p class="text-gray-500 mt-1">
                Manage registered companies and taxpayers.
            </p>

        </div>

        @if(session('success'))

        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>

        @endif

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Company
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Owner
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Tax Number
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Business Type
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($companies as $company)

                    <tr class="border-t hover:bg-gray-50 transition">

                        <td class="px-4 py-4">
                            {{ $company->company_name }}
                        </td>

                        <td class="px-4 py-4">
                            {{ $company->owner?->name }}
                        </td>

                        <td class="px-4 py-4">
                            {{ $company->tax_number }}
                        </td>

                        <td class="px-4 py-4">
                            @if($company->business_type === 'legal_entity')

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                Legal Entity
                            </span>

                            @else

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Physical Person
                            </span>

                            @endif
                        </td>

                        <td class="px-4 py-4">

                            <div class="flex gap-2">

                                <a
                                    href="{{ route('admin.companies.show', $company) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg">

                                    View

                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('admin.companies.destroy', $company) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded-lg"
                                        onclick="return confirm('Delete company?')">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>
                    @if($companies->isEmpty())
                    <tr>

                        <td colspan="5" class="text-center py-12">

                            <div>

                                <p class="text-lg font-semibold text-gray-600">
                                    No Companies Found
                                </p>

                                <p class="text-gray-500 mt-2">
                                    Registered companies will appear here.
                                </p>

                            </div>

                        </td>

                    </tr>
                    @endif

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="mt-4">
            {{ $companies->links() }}
        </div>

    </div>

</x-app-layout>