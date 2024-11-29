<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'KelasGratis.id') }}</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet" />

    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-base-200 text-base-content">
    <div class="flex flex-col min-h-screen">
        <!-- Navbar -->
        <x-guest.navbar />

        <!-- Main Content -->
        <main class="flex-grow">
            <div class="container mx-auto py-10 px-4">
                <div class="bg-base-100 shadow-xl rounded-lg p-6">
                    {{ $slot }} <!-- Tempat konten utama -->
                </div>
            </div>
        </main>

        <!-- Footer -->
        <x-guest.footer />
    </div>
</body>

</html>
