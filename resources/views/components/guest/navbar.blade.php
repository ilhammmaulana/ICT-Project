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
            <div class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('home.index') }}"
                    class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                    Home
                </a>
                <a href="{{ route('courses.index') }}"
                    class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                    Kursus
                </a>
                <a href="#" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                    Artikel
                </a>
                <a href="{{ route('about.index') }}" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                    Tentang Kami
                </a>
                <a href="#" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                    Kontak
                </a>
            </div>

            <!-- Search & Auth Links -->
            @if (Auth::user())
                <div class="flex items-center justify-end gap-3">
                    {{-- <a href="{{ route('dashboard') }}" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                        Dashboard
                    </a> --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 rounded-md">
                                <img src="{{ asset('images/icons/avatars/blank.svg') }}" class="size-12" />

                                <div class="ml-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Profile -->
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <div class="relative hidden lg:block">
                        <input type="text" placeholder="Cari Kursus..." class="w-64 px-4 py-2 input input-rounded">
                        <button class="absolute right-3 top-2.5">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Auth Links -->
                    <a href="{{ route('register') }}" class="text-gray-900 hover:text-gray-700 font-medium max-lg:text-xs">
                        Daftar
                    </a>
                    <a href="{{ route('login') }}" class="bg-blue-400 text-white px-4 py-2 rounded-lg  font-medium max-lg:text-xs">
                        Login
                    </a>
                    <!-- Hamburger Button -->
                    <div class="flex lg:hidden">
                        <button type="button"
                            class="text-gray-500 hover:text-gray-700 focus:outline-none  focus:ring-0"
                            x-on:click="isMenuOpen = !isMenuOpen" aria-label="Toggle navigation">
                            <svg class="w-7 h-7 transition-transform duration-300 ease-in-out transform"
                                :class="{ 'rotate-180': isMenuOpen }" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!isMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="isMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="lg:hidden" x-show="isMenuOpen" x-cloak x-transition:enter="transition ease-out duration-300 transform"
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
