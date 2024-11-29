<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KelasGratis.id') }}</title>

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

<body x-data="{ isDarkMode: false }" x-init="isDarkMode = localStorage.getItem('theme') === 'dark';
$watch('isDarkMode', value => localStorage.setItem('theme', value ? 'dark' : 'light'))" :class="{ dark: isDarkMode }" class="font-sans antialiased">
    <div class="min-h-screen text-gray-900 bg-gray-100 dark:bg-dark-eval-0 dark:text-gray-200">
        <!-- Navbar -->
        <x-guest.navbar />

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <x-guest.footer />
    </div>

    <!-- Dark Mode Toggle -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('themeToggle', () => ({
                toggleTheme() {
                    this.isDarkMode = !this.isDarkMode;
                    document.documentElement.setAttribute('data-theme', this.isDarkMode ? 'dark' :
                        'light');
                }
            }));
        });
    </script>
</body>

</html>
