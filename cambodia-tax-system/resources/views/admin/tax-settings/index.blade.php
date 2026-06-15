<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold text-gray-900">
                    Tax Settings
                </h1>

                <p class="text-gray-500 mt-1">
                    Configure tax rates and system tax rules.
                </p>

            </div>

            <a
                href="{{ route('admin.tax-settings.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow">

                + Add Tax Setting

            </a>

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
                            Tax Code
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Tax Name
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Tax Rate (%)
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Effective Date
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Description
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($taxSettings as $taxSetting)

                    <tr class="border-t hover:bg-gray-50 transition">

                        <td class="p-3">

                            <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold">

                                {{ $taxSetting->tax_code }}

                            </span>

                        </td>

                        <td class="p-3">
                            {{ $taxSetting->tax_name }}
                        </td>

                        <td class="p-3">

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">

                                {{ number_format($taxSetting->tax_rate, 2) }}%

                            </span>
                        </td>

                        <td class="p-3">
                            {{ \Carbon\Carbon::parse($taxSetting->effective_date)->format('d M Y') }}
                        </td>

                        <td class="p-3">
                            {{ \Illuminate\Support\Str::limit($taxSetting->description, 40) }}
                        </td>

                        <td class="p-3">

                            <div class="flex gap-2">

                                <a
                                    href="{{ route('admin.tax-settings.edit', $taxSetting) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('admin.tax-settings.destroy', $taxSetting) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded-lg"
                                        onclick="return confirm('Delete this tax setting?')">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center py-12">

                            <div>

                                <p class="text-lg font-semibold text-gray-600">
                                    No Tax Settings Found
                                </p>

                                <p class="text-gray-500 mt-2">
                                    Create your first tax configuration.
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>