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

    <div class="grid grid-cols-4 mt-5 gap-5">
        @foreach ($courses as $course)
            <a href="{{ route('user.courses.show', $course) }}">
                <div class="rounded-lg shadow overflow-hidden bg-white">
                    <img src="{{ asset($course->image) }}" alt="{{ $course->name }}" class=" aspect-video object-cover">

                    <div class="p-2">
                        <h2 class="text-lg font-semibold">{{ $course->name }}</h2>
                        <p class=" text-muted-foreground line-clamp-4">{{ $course->description }}</p>

                        <div>
                            <div class="flex items-center gap-1 text-sm font-medium text-muted-foreground">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                </svg>

                                {{ $course->modules->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>


</x-app-layout>
