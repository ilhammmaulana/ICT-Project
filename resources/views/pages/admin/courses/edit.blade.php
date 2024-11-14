<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Course') }}
            </h2>

        </div>
    </x-slot>

    <div class=""">
        <div class="grid grid-cols-12 gap-2 ">
            <div class=" col-span-6 card bg-white dark:bg-slate-800">
                <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data"
                    class="card-body">
                    <h2 class="text-xl font-semibold">Edit Course</h2>
                    @method('put')
                    @csrf
                    <div class="">
                        <div class="mt-5 mb-2">
                            <label for="course_category_id" class="text-base block">Course Category</label>

                            <select class="select select-bordered w-full mt-2" id="course_category_id_input"
                                name="course_category_id">
                                <option disabled>Select course category</option>
                                @foreach ($course_categories as $courseCategory)
                                    <option value="{{ $courseCategory->id }}"
                                        {{ $courseCategory->id == $course->course_category_id ? 'selected' : '' }}>
                                        {{ $courseCategory->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="mt-5 mb-2">
                            <label for="name" class="text-base block">Course Name</label>
                            <input type="text" placeholder="Your course name"
                                class="input input-bordered w-full max-full mt-2" id="course-name-input" name="name"
                                required value="{{ $course->name }}" />
                        </div>
                        <div class="mt-5 mb-2">
                            <label for="title" class="text-base block">Course Title</label>
                            <input type="text" placeholder="Your course title"
                                class="input input-bordered w-full max-full mt-2" id="course-title-input" name="title"
                                required value="{{ $course->title }}" />
                        </div>
                        <div class="mt-5 mb-2">
                            <label for="meta_title" class="text-base block">Course Meta Title</label>
                            <input type="text" placeholder="Your course meta title"
                                class="input input-bordered w-full max-full mt-2" id="course-meta-title-input"
                                name="meta_title" required value="{{ $course->meta_title }}" />
                        </div>
                        <div class="mt-5 mb-2">
                            <label for="description" class="text-base block">Course Description</label>
                            <textarea class="textarea textarea-bordered w-full mt-2" id="course-description-input" name="description"
                                placeholder="Your course description" required>{{ $course->description }}</textarea>
                        </div>
                        <div class="mt-5 mb-2">
                            <label for="meta_description" class="text-base block">Course Meta Description</label>
                            <textarea class="textarea textarea-bordered w-full mt-2" id="course-meta-description-input" name="meta_description"
                                placeholder="Your course meta description" required>{{ $course->meta_description }}</textarea>
                        </div>


                        <div class="mt-5 mb-2">
                            <label for="image" class="text-base block">Cover Image</label>
                            <div class="mt-2">
                                <img src="{{ asset($course->image) }}" alt="" id="cover_image_preview"
                                    class="max-w-80 rounded-lg">
                            </div>

                            <input type="file" class="file-input file-input-bordered w-full mt-2"
                                id="cover_image_input" name="image" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-5">
                        <a href="{{ route('admin.courses.index') }}"><button class="btn"
                                type="button">Cancel</button></a>
                        <button class="btn btn-active btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-span-6 card bg-white dark:bg-slate-800">
                <div class="card-body">
                    <h2 class="text-xl font-semibold">Course Modules</h2>
                    <div class="flex justify-between mt-12">

                        <form action="{{ route('admin.courses.edit', $course) }}" method="GET" id="search_form">
                            <label class="input input-bordered flex items-center gap-2" for="searchModule">
                                <input type="text" class="grow input  focus:border-none active:border-none"
                                    placeholder="Search" name="searchModule" id="module-search-input" value="{{ request('searchModule') }}"/>
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
                            <div class="flex justify-between items-center px-4 py-4 border rounded-lg mb-2">
                                <p>{{ $module->title }}</p>
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.course-modules.edit', $module->id) }}">Edit</a>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('cover_image_input');
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    const image = document.getElementById('cover_image_preview');
                    image.src = reader.result;
                });
                reader.readAsDataURL(file);
            })

            const moduleContainer = document.getElementById('module_container');
            const modules = @json($course->modules);
            const searchInput = document.getElementById('module-search-input');


            function renderModules(filteredModules) {
                moduleContainer.innerHTML = ''; // Clear the container

                filteredModules.forEach(element => {
                    const moduleElement = document.createElement('div');
                    moduleElement.className = 'px-4 py-4 border rounded-lg mb-2';
                    moduleElement.innerHTML = `
                        <div class="flex justify-between items-center">
                            <p>${element.title}</p>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.course-modules.edit', '') }}/${element.id}">Edit</a>
                        </div>
                    `;
                    moduleContainer.appendChild(moduleElement);
                });
            }

            // Initial render with all modules
            // renderModules(modules);

            // Filter modules based on search input
            searchInput.addEventListener('input', function() {
                document.getElementById('search_form').submit();
            });
        })
    </script>

</x-app-layout>
