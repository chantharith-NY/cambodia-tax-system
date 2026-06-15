<x-app-layout>

    <div class="max-w-7xl mx-auto py-6">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold text-gray-900">
                    User Management
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage administrators and business accounts.
                </p>

            </div>

        </div>

        @if(session('success'))

        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>

        @endif

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl p-5 shadow">

                <p class="text-gray-500">
                    Total Users
                </p>

                <h2 class="text-2xl font-bold text-blue-600">
                    {{ $users->total() }}
                </h2>

            </div>

            <div class="bg-green-50 border-l-4 border-green-500 rounded-xl p-5 shadow">

                <p class="text-gray-500">
                    Business Users
                </p>

                <h2 class="text-2xl font-bold text-green-600">
                    {{ $users->where('role','business')->count() }}
                </h2>

            </div>

            <div class="bg-purple-50 border-l-4 border-purple-500 rounded-xl p-5 shadow">

                <p class="text-gray-500">
                    Administrators
                </p>

                <h2 class="text-2xl font-bold text-purple-600">
                    {{ $users->where('role','admin')->count() }}
                </h2>

            </div>

        </div>

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            ID
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Name
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Email
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Role
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-700">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)

                    <tr class="border-t hover:bg-gray-50 transition">

                        <td class="px-4 py-4 font-medium">
                            #{{ $user->id }}
                        </td>

                        <td class="px-4 py-4">
                            {{ $user->name }}
                        </td>

                        <td class="px-4 py-4">
                            {{ $user->email }}
                        </td>

                        <td class="px-4 py-4">

                            @if($user->role === 'admin')

                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-semibold">
                                Admin
                            </span>

                            @else

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                Business
                            </span>

                            @endif

                        </td>

                        <td class="px-4 py-4">

                            <div class="flex gap-2">

                                <a
                                    href="{{ route('admin.users.edit', $user) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg">

                                    Edit

                                </a>

                                @if(auth()->id() !== $user->id)

                                <form
                                    action="{{ route('admin.users.destroy', $user) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded-lg"
                                        onclick="return confirm('Delete user?')">

                                        Delete

                                    </button>

                                </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="text-center py-12">

                            <div>

                                <p class="text-lg font-semibold text-gray-600">
                                    No Users Found
                                </p>

                                <p class="text-gray-500 mt-2">
                                    User accounts will appear here after registration.
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $users->links() }}

        </div>

    </div>

</x-app-layout>