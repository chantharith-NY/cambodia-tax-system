<x-guest-layout>

    <div class="w-full max-w-md mx-auto">

        <div class="text-center mb-8">

            <!-- <img
                src="https://www.tax.gov.kh/images/logo-3d.png"
                alt="GDT Logo"
                class="h-24 mx-auto mb-4"> -->

            <h1 class="text-3xl font-bold text-blue-800">
                Cambodia Tax Management System
            </h1>

            <p class="text-gray-600 mt-2">
                Login to access your tax management dashboard
            </p>

        </div>

        <div class="bg-white shadow-xl rounded-xl p-8">

            <x-auth-session-status
                class="mb-4"
                :status="session('status')" />

            <form
                method="POST"
                action="{{ route('login') }}">

                @csrf

                <!-- Email -->
                <div>

                    <x-input-label
                        for="email"
                        :value="__('Email Address')" />

                    <x-text-input
                        id="email"
                        class="block mt-1 w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username" />

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="mt-2" />

                </div>

                <!-- Password -->
                <div class="mt-4">

                    <x-input-label
                        for="password"
                        :value="__('Password')" />

                    <x-text-input
                        id="password"
                        class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2" />

                </div>

                <!-- Remember Me -->
                <div class="block mt-4">

                    <label
                        for="remember_me"
                        class="inline-flex items-center">

                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                            name="remember">

                        <span class="ms-2 text-sm text-gray-600">

                            Remember Me

                        </span>

                    </label>

                </div>

                <div class="flex items-center justify-between mt-6">

                    @if (Route::has('password.request'))

                    <a
                        class="text-sm text-blue-600 hover:text-blue-800"
                        href="{{ route('password.request') }}">

                        Forgot Password?

                    </a>

                    @endif

                    <x-primary-button>

                        Log In

                    </x-primary-button>

                </div>

            </form>

        </div>

        <div class="text-center mt-6">

            <a
                href="{{ route('register') }}"
                class="text-blue-600 hover:text-blue-800">

                Don't have an account? Register

            </a>

        </div>

    </div>

</x-guest-layout>