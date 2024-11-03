<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Course') }}
            </h2>

        </div>
    </x-slot>

    <div class="card bg-white dark:bg-slate-800">
        <div class="card-body">
            <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="mt-5 mb-2">
                    <label for="name" class="text-base block">Course Name</label>
                    <input type="text" placeholder="Your course name"
                        class="input input-bordered w-full max-full mt-2" id="course-name-input" name="name"
                        required />
                </div>
                <div class="mt-5 mb-2">
                    <label for="title" class="text-base block">Course Title</label>
                    <input type="text" placeholder="Your course title"
                        class="input input-bordered w-full max-full mt-2" id="course-title-input" name="title"
                        required />

                </div>
                <div class="mt-5 mb-2">
                    <label for="description" class="text-base block">Course Description</label>


                    <textarea class="textarea textarea-bordered w-full mt-2" id="course-description-input" name="description"
                        placeholder="Your course description" required></textarea>
                </div>
                <div class="mt-5 mb-2">
                    <label for="course_category_id" class="text-base block">Course Category</label>

                    <select class="select select-bordered w-full mt-2" id="course_category_id_input"
                        name="course_category_id">
                        <option disabled selected>Select course category</option>
                        @foreach ($course_categories as $courseCategory)
                            <option value="{{ $courseCategory->id }}">{{ $courseCategory->name }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="mt-5 mb-2">
                    <label for="image" class="text-base block">Cover Image</label>


                    <input type="file" class="file-input file-input-bordered w-full mt-2"
                        id="cover_image_input" name="image" />
                </div>

                <div class="flex justify-end gap-3 mt-5">
                    <button class="btn" type="button" onclick="add_new_course_modal.close()">Close</button>
                    <button class="btn btn-active btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
