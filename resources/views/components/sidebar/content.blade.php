<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>


    @role(['admin', 'editor'])
        <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-500 dark:text-white">
            Manage
        </div>
        <x-sidebar.link title="Course Categories" href="{{ route('admin.course-categories.index') }}" :isActive="request()->routeIs('admin.course-categories.index')">
            <x-slot name="icon">
                <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
        <x-sidebar.link title="Courses" href="{{ route('admin.courses.index') }}" :isActive="request()->routeIs('admin.courses.index')">
            <x-slot name="icon">
                <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>

        <x-sidebar.dropdown title="Article" :active="request()->routeIs('admin.articles.index') ||
            request()->routeIs('admin.articles.create') ||
            request()->routeIs('admin.articles.edit')">
            <x-slot name="icon">
                <x-icons.news class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
            <x-sidebar.sublink title="Manage Articles" href="{{ route('admin.articles.index') }}" :active="request()->routeIs('admin.articles.index')" />
            <x-sidebar.sublink title="Article Categories" href="{{ route('admin.article-categories.index') }}"
                :active="request()->routeIs('admin.articles.index')" />
        </x-sidebar.dropdown>
        {{-- <x-sidebar.link title="Users" href="{{ route('admin.articles.index') }}" :isActive="request()->routeIs('admin.articles.index')">
            <x-slot name="icon">
                <x-icons.people class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link> --}}
    @endrole
    
    @role(['user'])
    <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-500 dark:text-white">
        Application
    </div>
    <x-sidebar.link title="Course Categories" href="{{ route('admin.course-categories.index') }}" :isActive="request()->routeIs('admin.course-categories.index')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link title="Courses" href="{{ route('admin.courses.index') }}" :isActive="request()->routeIs('admin.courses.index')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.dropdown title="Article" :active="request()->routeIs('admin.articles.index') ||
        request()->routeIs('admin.articles.create') ||
        request()->routeIs('admin.articles.edit')">
        <x-slot name="icon">
            <x-icons.news class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
        <x-sidebar.sublink title="Manage Articles" href="{{ route('admin.articles.index') }}" :active="request()->routeIs('admin.articles.index')" />
        <x-sidebar.sublink title="Article Categories" href="{{ route('admin.article-categories.index') }}"
            :active="request()->routeIs('admin.articles.index')" />
    </x-sidebar.dropdown>
    @endrole
    {{-- <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray dark:text-500">
        Applications
    </div>
    <x-sidebar.link title="Courses" href="{{ route('admin.courses.index') }}" :isActive="request()->routeIs('admin.courses.index')">
        <x-slot name="icon">
            <x-icons.inbox-alt class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link> --}}
    {{-- <x-sidebar.link title="Your Progress" href="{{ route('admin.courses.index') }}" :isActive="request()->routeIs('admin.courses.index')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link> --}}

</x-perfect-scrollbar>
