<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Course') }}
            </h2>

        </div>
    </x-slot>

    <div class="card bg-white dark:bg-slate-800">
        <div class="card-body">
            <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="grid grid-cols-2 gap-3">
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

                        <input type="file" class="file-input file-input-bordered w-full mt-2" id="cover_image_input"
                            name="image" />
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-5">
                    <a href="{{ route('admin.courses.index') }}"><button class="btn" type="button">Cancel</button></a>
                    <button class="btn btn-active btn-primary">Submit</button>
                </div>
            </form>
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
        })
    </script>

</x-app-layout>
