<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Course') }}
            </h2>

        </div>
    </x-slot>

    <div class="flex justify-between">
        <form action="{{ route('user.courses.index') }}" method="GET">
            <label class="input input-bordered input-info flex items-center gap-2" for="search">
                <input type="text" class="grow input  focus:border-none active:border-none" placeholder="Search"
                    name="search" value="{{ request('search') }}" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="h-4 w-4 opacity-70">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </label>
        </form>
        {{-- <input type="text" placeholder="Type here" class="input input-bordered input-primary w-full max-w-sm" /> --}}

        {{-- <x-courses.create-course-modal :courses="$course_categories" /> --}}
        {{-- <x-courses.create-course-modal /> --}}
        {{-- <a href="{{ route('user.courses.create') }}">
            <button class="btn btn-primary btn-active text-white">Add Course</button>
        </a> --}}

    </div>

    <div class="grid grid-cols-3">
        
    </div>


</x-app-layout>
