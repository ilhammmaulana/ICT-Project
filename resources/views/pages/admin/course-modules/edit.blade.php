<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Module') }}
            </h2>

        </div>
    </x-slot>

    <div class="">
        <div class="grid grid-cols-12 gap-2 items-start">
            <div class=" col-span-12 card bg-white dark:bg-slate-800">
                <form action="{{ route('admin.course-modules.update', $module) }}" method="POST" class="card-body">
                    <h2 class="text-xl font-semibold">Edit Module</h2>
                    @method('put')
                    @csrf
                    <div class="">
                        <div class="mt-5 mb-2 hidden">
                            <label for="course_id" class="text-base block"></label>
                            <input type="text" name="course_id" required value="{{ $module->course_id }}" />
                        </div>
                        <div class="mt-5 mb-2">
                            <label for="title" class="text-base block">Module Title</label>
                            <input type="text" placeholder="Your module title"
                                class="input input-bordered w-full max-full mt-2" id="module-title-input" name="title"
                                required value="{{ $module->title }}" />
                        </div>

                        <div class="mt-5 mb-2">
                            <label for="description" class="text-base block">Module Description</label>

                            <textarea class="textarea textarea-bordered w-full mt-2" id="module-description-input" name="description"
                                placeholder="Your module description" required>{{ $module->description }}</textarea>
                        </div>

                        <div class="flex justify-end gap-3 mt-5">
                            <a href="{{ route('admin.courses.show', $module->course) }}"><button class="btn"
                                    type="button">Cancel</button></a>
                            <button class="btn btn-active btn-primary">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-span-12 card bg-white dark:bg-slate-800">
                <div class="card-body">
                    <h2 class="text-xl font-semibold">Module Contents</h2>
                    <div class="flex justify-between mt-12">
                        <form action="{{ route('admin.course-modules.edit', $module) }}" method="GET"
                            id="search_form">
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
                        <x-module-contents.create-module-content-modal :moduleId="$module->id" />
                    </div>

                    <div class="mt-10">
                        @foreach ($module->moduleContents as $content)
                            @if ($content->content_type === 'LINK')
                                @if ($content->content)
                                    @php
                                        $youtubeEmbedUrl = null;

                                        // Check if the link is a YouTube URL and extract the video ID
                                        if (
                                            str_contains($content->content, 'youtube.com') ||
                                            str_contains($content->content, 'youtu.be')
                                        ) {
                                            $urlParts = parse_url($content->content);

                                            if (
                                                isset($urlParts['host']) &&
                                                str_contains($urlParts['host'], 'youtu.be')
                                            ) {
                                                // Shortened YouTube link (e.g., https://youtu.be/VIDEO_ID)
                                                $videoId = ltrim($urlParts['path'], '/');
                                            } elseif (isset($urlParts['query'])) {
                                                // Standard YouTube link (e.g., https://www.youtube.com/watch?v=VIDEO_ID)
                                                parse_str($urlParts['query'], $queryParts);
                                                $videoId = $queryParts['v'] ?? null;
                                            }

                                            // Construct the embed URL if we have a video ID
                                            if (isset($videoId)) {
                                                $youtubeEmbedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                            }
                                        }
                                    @endphp

                                    {{-- Embed YouTube video if a YouTube link is detected --}}
                                    @if ($youtubeEmbedUrl)
                                        <div class="rounded-lg mb-5">
                                            <iframe width="560" height="315" src="{{ $youtubeEmbedUrl }}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen class=" overflow-hidden"></iframe>
                                            <div class="mt-1">
                                                <p>Uploaded At: {{ $content->created_at }}</p>
                                                {{-- <x-module-contents.edit-module-content-modal :moduleId="$module->id" /> --}}

                                            </div>
                                        </div>
                                    @else
                                        {{-- If not a YouTube URL, show the link as text or regular link --}}
                                        <a href="{{ $content->content }}" target="_blank" class="link text-sky-800"
                                            style="color: mediumblue">{{ $content->content }}</a>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </div>

                    <div>

                        {{-- <pre>{{ $module->moduleContents }}</pre> --}}
                        {{-- <pre>{{ $module }}</pre> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
