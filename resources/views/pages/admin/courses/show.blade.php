<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __(' Course Detail') }}
            </h2>

        </div>
    </x-slot>

    <div class="w-[85%] mx-auto mt-5">
        <div class="rounded-xl relative min-h-60 w-full shadow-md"
            style="background-image: url({{ asset('images/course-placeholder.jpg') }});">

            <div class="absolute bottom-0 left-0 p-4">
                <p class="text-lg font-semibold">
                    {{ $course->name }}
                </p>
                <p>
                    {{ $course->title }}
                </p>
            </div>

            {{-- <img src="{{ asset('images/course-placeholder.jpg') }}" alt="{{ $course->name }}"> --}}
        </div>

        <div class="card bg-white mt-5 dark:bg-slate-800">
            <div class="card-body">
                <h2 class="text-xl font-semibold">Course Modules</h2>
                <div class="flex justify-between mt-12">

                    <form action="{{ route('admin.courses.edit', $course) }}" method="GET" id="search_form">
                        <label class="input input-bordered flex items-center gap-2" for="searchModule">
                            <input type="text" class="grow input  focus:border-none active:border-none"
                                placeholder="Search" name="searchModule" id="module-search-input"
                                value="{{ request('searchModule') }}" />
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                class="h-4 w-4 opacity-70">
                                <path fill-rule="evenodd"
                                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </label>
                    </form>
                    <x-course-modules.create-course-module-modal :courseId="$course->id" />
                </div>
                <div id="module_container" class="mt-5">
                    @foreach ($course->modules as $module)
                        <div class="rounded-lg p-4 border mb-4">
                            <div class="flex justify-between items-center">
                                <p class="text-xl text-slate-900 font-medium">{{ $module->title }}</p>
                                <x-course-modules.edit-course-module-modal :courseId="$course->id" :module="$module" :contents="$module->moduleContents" />

                            </div>
                            <p class="text-sm mt-3">{{ $module->description }}</p>
                            @php
                                $date = \Carbon\Carbon::parse($module->created_at)->format('d M Y');
                            @endphp
                            <p class="text-xs text-end mb-4">{{ $date }}</p>
                            <div class="">
                                <div class="grid grid-cols-1 place-items-center">
                                    @foreach ($module->moduleContents as $content)
                                        @if ($content->content_type === 'LINK' && $content->content)
                                            <x-courses.youtube-video-modal :id="$module->id" :url="$content->content"
                                                :content="$content" />
                                        @endif
                                    @endforeach
                                </div>

                                <div>
                                    @foreach ($module->moduleContents as $content)
                                        @if ($content->content_type === 'LINK' && $content->content)
                                            @php
                                                $isYouTubeLink = false;
                                                if (
                                                    str_contains($content->content, 'youtube.com') ||
                                                    str_contains($content->content, 'youtu.be')
                                                ) {
                                                    $isYouTubeLink = true;
                                                }
                                            @endphp

                                            @if (!$isYouTubeLink)
                                                <a href="{{ $content->content }}"
                                                    class="rounded-lg mb-2 w-full block bg-blue-200 px-2 py-1.5 underline"
                                                    target="_blank"
                                                    referrerpolicy="no-referrer">{{ $content->content }}</a>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>



            </div>
        </div>

</x-app-layout>
