<x-landing-layout>
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl lg:text-5xl">
                    Kursus Online untuk Design dan Coding
                </h1>
                {{-- <p class="mt-4 text-2xl text-gray-600">
                    dengan Kursus Design dan Coding dari Kelas Gratis
                </p> --}}
                <p class="mt-4 text-gray-600 text-xs">
                    Selamat datang di kursus online kami, di mana Anda dapat meningkatkan keterampilan Anda dalam desain
                    dan koding. Pilih dari pilihan 10 kursus kami yang dikuratori dengan cermat yang dirancang untuk
                    memberi Anda pengetahuan komprehensif dan pengalaman praktis. Jelajahi kursus di bawah ini dan
                    temukan yang paling cocok untuk perjalanan belajar Anda.
                </p>

            </div>
        </div>
    </section>

    <section class="container mx-auto my-10 max-w-[90%] xl:max-w-[80%]">
        <form action="{{ route('courses.index') }}" method="GET" class="flex items-center gap-3" id="course_search_form">
            <label for="categoryId" class="hidden">
            </label>
            <select class="select select-primary w-full max-w-xs select-md text-sm" id="category_search_input"
                name="categoryId">
                <option selected value="">Choose course category</option>
                @foreach ($course_categories as $course_category)
                    <option value="{{ $course_category->id }}" @if (request('categoryId') == $course_category->id) selected @endif>
                        {{ $course_category->name }}</option>
                @endforeach
            </select>
            <label class="input input-bordered input-info flex items-center gap-2 w-full max-w-sm input-md"
                for="search">
                <input type="text" class="grow input  focus:border-none active:border-none text-sm"
                    placeholder="Search" name="search" value="{{ request('search') }}" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="h-4 w-4 opacity-70">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </label>
        </form>
        @if ($courses->count() > 0)
            {{-- <div class="grid grid-cols-2 gap-4 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach ($courses as $course)
                    <div class="bg-white rounded-lg overflow-hidden p-3">
                        <img src="{{ asset($course->image) }}" alt="{{ $course->name }}"
                            class="rounded-md aspect-square object-cover min-h-full">
                        <div class="p-2">
                            <h2 class="text-base font-semibold">{{ $course->title }}</h2>
                            <p class=" text-muted-foreground line-clamp-4 text-gray-600 text-xs mt-2">
                                {{ $course->description }}
                            </p>
                            <a href="{{ route('courses.show', $course->slug) }}" title="{{ $course->name }}">
                                <button class="btn w-full btn-sm mt-2 text-xs">Mulai Sekarang</button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div> --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach ($courses as $course)
                    <div class="bg-white rounded-lg overflow-hidden p-3 flex flex-col h-full">
                        <img src="{{ asset($course->image) }}" alt="{{ $course->name }}"
                            class="rounded-md aspect-square object-cover">
                        <div class="p-2 flex-grow">
                            <h2 class="text-base font-semibold">{{ $course->title }}</h2>
                            <p class=" text-muted-foreground line-clamp-4 text-gray-600 text-xs mt-2">
                                {{ $course->description }}
                            </p>
                        </div>
                        <div class="flex flex-col mt-auto">
                            <a href="{{ route('courses.show', $course->slug) }}" title="{{ $course->name }}">
                                <button class="btn w-full btn-sm mt-2 text-xs">Mulai Sekarang</button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-muted-foreground my-44 font-medium">No courses found</p>
        @endif


        <div class="flex justify-center mt-20">
            <nav aria-label="Pagination">
                <ul class="inline-flex items-center space-x-2">
                    <!-- Previous Page Link -->
                    @if ($courses->onFirstPage())
                        <li>
                            <span class="px-3 py-1 text-gray-500 bg-gray-200 rounded cursor-not-allowed">
                                ← Previous
                            </span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $courses->previousPageUrl() }}"
                                class="px-3 py-1 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                                ← Previous
                            </a>
                        </li>
                    @endif

                    <!-- Pagination Links -->
                    @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                        <li>
                            @if ($page == $courses->currentPage())
                                <span class="px-3 py-1 text-white bg-blue-500 rounded cursor-default">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="px-3 py-1 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                                    {{ $page }}
                                </a>
                            @endif
                        </li>
                    @endforeach

                    <!-- Next Page Link -->
                    @if ($courses->hasMorePages())
                        <li>
                            <a href="{{ $courses->nextPageUrl() }}"
                                class="px-3 py-1 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                                Next →
                            </a>
                        </li>
                    @else
                        <li>
                            <span class="px-3 py-1 text-gray-500 bg-gray-200 rounded cursor-not-allowed">
                                Next →
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>

    </section>
</x-landing-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('course_search_form');
        const categorySearchInput = document.getElementById('category_search_input');

        if (categorySearchInput) {
            categorySearchInput.addEventListener('change', function() {
                if (searchForm) {
                    searchForm.submit();
                }
            })
        }
    })
</script>
