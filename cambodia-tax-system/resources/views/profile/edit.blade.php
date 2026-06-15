<x-app-layout>

    <div class="max-w-6xl mx-auto py-8">

        <!-- Header -->
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-gray-900">
                Profile Settings
            </h1>

            <p class="text-gray-500 mt-2">
                Manage your account information, password, and security settings.
            </p>

        </div>

        <div class="space-y-6">

            <!-- Profile Information -->
            <div class="bg-white shadow-xl rounded-2xl border border-gray-100">

                <div class="border-b border-gray-100 px-8 py-5">

                    <h2 class="text-xl font-bold text-blue-800">
                        Profile Information
                    </h2>

                    <p class="text-gray-500 text-sm mt-1">
                        Update your personal information and email address.
                    </p>

                </div>

                <div class="p-8">

                    @include('profile.partials.update-profile-information-form')

                </div>

            </div>

            <!-- Password -->
            <div class="bg-white shadow-xl rounded-2xl border border-gray-100">

                <div class="border-b border-gray-100 px-8 py-5">

                    <h2 class="text-xl font-bold text-green-700">
                        Security Settings
                    </h2>

                    <p class="text-gray-500 text-sm mt-1">
                        Change your password and secure your account.
                    </p>

                </div>

                <div class="p-8">

                    @include('profile.partials.update-password-form')

                </div>

            </div>

            <!-- Delete Account -->
            <div class="bg-white shadow-xl rounded-2xl border border-red-100">

                <div class="border-b border-red-100 px-8 py-5 bg-red-50 rounded-t-2xl">

                    <h2 class="text-xl font-bold text-red-700">
                        Danger Zone
                    </h2>

                    <p class="text-red-600 text-sm mt-1">
                        Permanently delete your account and all associated data.
                    </p>

                </div>

                <div class="p-8">

                    @include('profile.partials.delete-user-form')

                </div>

            </div>

        </div>

    </div>

</x-app-layout>