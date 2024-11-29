<nav x-data="{ isMenuOpen: false }" class="w-full bg-gray-50 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="{{ route('home.index') }}" class="inline-flex items-center gap-2">
                        <x-application-logo aria-hidden="true" class="w-24 h-auto" />
                        <span class="sr-only">Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Full Menu (Desktop) -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                    Home
                </a>
                <a href="#" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                    Kursus
                </a>
                <a href="#" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                    Artikel
                </a>
                <a href="#" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                    Tentang Kami
                </a>
                <a href="#" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                    Kontak
                </a>
            </div>

            <!-- Search & Auth Links -->
            <div class="flex items-center space-x-4">
                <!-- Search Bar -->
                <div class="relative hidden md:block">
                    <input type="text" placeholder="Cari Kursus..." class="w-64 px-4 py-2 input input-rounded">
                    <button class="absolute right-3 top-2.5">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>

                <!-- Auth Links -->
                <a href="{{ route('register') }}" class="text-gray-900 hover:text-gray-700 font-medium">
                    Daftar
                </a>
                <a href="{{ route('login') }}" class="bg-blue-400 text-white px-4 py-2 rounded-lg  font-medium">
                    Login
                </a>
                <!-- Hamburger Button -->
                <div class="flex md:hidden">
                    <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none  focus:ring-0"
                        x-on:click="isMenuOpen = !isMenuOpen" aria-label="Toggle navigation">
                        <svg class="w-7 h-7 transition-transform duration-300 ease-in-out transform"
                            :class="{ 'rotate-180': isMenuOpen }" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!isMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="isMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden" x-show="isMenuOpen" x-cloak x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-gray-50">
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-200">
                Home
            </a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-200">
                Kursus
            </a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-200">
                Artikel
            </a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-200">
                Tentang Kami
            </a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-200">
                Kontak
            </a>

            <!-- Search Bar (Mobile) -->
            <div class="mt-4">
                <input type="text" placeholder="Cari Kursus..." class="w-full px-4 py-2 input input-rounded">
            </div>
        </div>
    </div>
</nav>