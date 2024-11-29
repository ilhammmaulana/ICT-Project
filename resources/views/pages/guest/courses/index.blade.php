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
            <select class="select select-primary w-full max-w-xs select-md" id="category_search_input"
                name="categoryId">
                <option selected value="">Choose course category</option>
                @foreach ($course_categories as $course_category)
                    <option value="{{ $course_category->id }}" @if (request('categoryId') == $course_category->id) selected @endif>
                        {{ $course_category->name }}</option>
                @endforeach
            </select>
            <label class="input input-bordered input-info flex items-center gap-2 w-full max-w-sm input-md"
                for="search">
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
        @if ($courses->count() > 0)
            <div class="grid grid-cols-2 gap-4 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach ($courses as $course)
                    <div class="bg-white rounded-lg overflow-hidden p-3">
                        <img src="{{ asset($course->image) }}" alt="{{ $course->name }}"
                            class="rounded-md aspect-square object-cover">
                        <div class="p-2">
                            <h2 class="text-base font-semibold">{{ $course->title }}</h2>
                            <p class=" text-muted-foreground line-clamp-4 text-gray-600 text-xs mt-2">
                                {{ $course->description }}
                            </p>

                            {{-- 
           <div class="flex items-center gap-1 text-xs font-medium text-muted-foreground mt-3">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                   stroke="currentColor" class="size-4 text-gray-600">
                   <path stroke-linecap="round" stroke-linejoin="round"
                       d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
               </svg>

               {{ $course->modules->count() }} Modules
           </div> --}}

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
    </section>
</x-landing-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('course_search_form');

        console.log(searchForm);
        const categorySearchInput = document.getElementById('category_search_input');
        console.log(categorySearchInput);
        if (categorySearchInput) {
            categorySearchInput.addEventListener('change', function() {
                if (searchForm) {
                    searchForm.submit();
                }
            })
        }
    })
</script>
