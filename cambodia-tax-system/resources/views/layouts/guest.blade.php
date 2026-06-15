<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}">

    <title>
        Cambodia Tax Management System
    </title>

    <!-- Fonts -->
    <link
        rel="preconnect"
        href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet" />

    <!-- Scripts -->
    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>

<body
    class="font-sans antialiased bg-gradient-to-br from-blue-50 via-white to-gray-100">

    <div
        class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-lg">

            <!-- Logo -->
            <div class="text-center mb-6">

                <a href="{{ url('/') }}">

                    <img
                        src="{{ asset('https://www.tax.gov.kh/images/logo-3d.png') }}"
                        alt="GDT Logo"
                        class="h-24 mx-auto">

                </a>

            </div>

            <!-- Card -->
            <div
                class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">

                {{ $slot }}

            </div>

            <!-- Footer -->
            <div class="text-center mt-6">

                <p class="text-sm text-gray-500">

                    General Department of Taxation

                </p>

                <p class="text-sm text-gray-500">

                    Kingdom of Cambodia

                </p>

            </div>

        </div>

    </div>

</body>

</html>