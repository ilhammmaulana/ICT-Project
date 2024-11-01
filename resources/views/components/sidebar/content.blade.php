<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>


    @role(['admin', 'editor'])
        <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-500">
            Manage
        </div>
        <x-sidebar.link title="Courses" href="{{ route('courses.index') }}" :isActive="request()->routeIs('courses.index')">
            <x-slot name="icon">
                <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
        <x-sidebar.link title="Article" href="{{ route('articles.index') }}" :isActive="request()->routeIs('articles.index')">
            <x-slot name="icon">
                <x-icons.news class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
        <x-sidebar.link title="Users" href="{{ route('articles.index') }}" :isActive="request()->routeIs('articles.index')">
            <x-slot name="icon">
                <x-icons.people class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @endrole
    <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-500">
        Applications
    </div>
    <x-sidebar.link title="Courses" href="{{ route('courses.index') }}" :isActive="request()->routeIs('courses.index')">
        <x-slot name="icon">
            <x-icons.inbox-alt class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link title="Your Progress" href="{{ route('courses.index') }}" :isActive="request()->routeIs('courses.index')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

</x-perfect-scrollbar>
