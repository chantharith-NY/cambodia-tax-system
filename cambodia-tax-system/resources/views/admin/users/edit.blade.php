<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">

            <h2 class="text-3xl font-bold text-blue-800 mb-2">
                Edit User
            </h2>

            <p class="text-gray-500 mb-6">
                Update user role and account permissions.
            </p>

            @if ($errors->any())

            <div class="bg-red-100 border border-red-200 text-red-700 p-4 rounded-lg mb-6">

                <ul class="list-disc list-inside">

                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif

            <form
                action="{{ route('admin.users.update', $user) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            User ID
                        </label>

                        <input
                            type="text"
                            value="{{ $user->id }}"
                            class="w-full border border-gray-300 rounded-xl p-3 bg-gray-100"
                            disabled>

                    </div>

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Full Name
                        </label>

                        <input
                            type="text"
                            value="{{ $user->name }}"
                            class="w-full border border-gray-300 rounded-xl p-3 bg-gray-100"
                            disabled>

                    </div>

                    <div class="md:col-span-2">

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Email Address
                        </label>

                        <input
                            type="email"
                            value="{{ $user->email }}"
                            class="w-full border border-gray-300 rounded-xl p-3 bg-gray-100"
                            disabled>

                    </div>

                    <div class="md:col-span-2">

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            User Role
                        </label>

                        <select
                            name="role"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500"
                            required>

                            <option
                                value="individual"
                                @selected($user->role === 'individual')>
                                Individual
                            </option>

                            <option
                                value="business"
                                @selected($user->role === 'business')>
                                Business
                            </option>

                            <option
                                value="admin"
                                @selected($user->role === 'admin')>
                                Administrator
                            </option>

                        </select>

                    </div>

                </div>

                <div class="flex gap-3 mt-8">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow">

                        Update User

                    </button>

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>