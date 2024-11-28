<button class="btn btn-primary btn-active" onclick="add_new_course_modal.showModal()">Add Course</button>
<dialog id="add_new_course_modal" class="modal">
    <div class="modal-box w-11/12 max-w-xl">
        {{-- <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form> --}}

        <h3 class="text-lg font-bold">Add New Course</h3>
        <form action="{{ route('admin.courses.store') }}" method="POST">
            @method('POST')
            @csrf
            <div class="mt-5 mb-2">
                <label for="name" class="text-base block">Course Name</label>
                <input type="text" placeholder="Your course name" class="input input-bordered w-full max-full mt-2"
                    id="course-name-input" name="name" required />
            </div>
            <qdiv class="mt-5 mb-2">
                <label for="title" class="text-base block">Course Title</label>
                <input type="text" placeholder="Your course title" class="input input-bordered w-full max-full mt-2"
                    id="course-title-input" name="title" required />

            </qdiv>
            <div class="mt-5 mb-2">
                <label for="description" class="text-base block">Course Description</label>
                {{-- <input type="text" placeholder="Your course description"
                    class="input input-bordered w-full max-full mt-2" id="course-description-input"
                    name="description" /> --}}

                <textarea class="textarea textarea-bordered w-full mt-2" id="course-description-input" name="description"
                    placeholder="Your course description" required></textarea>
            </div>
            <div class="mt-5 mb-2">
                <label for="name" class="text-base block">Course Category</label>
                {{-- <select class="select select-bordered w-full mt-2">
                    <option disabled selected>Select course category</option>
                    @foreach ($course_categories as $course_category)
                        <option value="{{ $course_category->id }}">{{ $course_category->name }}</option>
                    @endforeach
                </select> --}}
                {{-- <select class="select select-bordered w-full mt-2" name="category_id">
                    <option disabled selected>Select course category</option>
                    @foreach ($courseCategories as $courseCategory)
                        <option value="{{ $courseCategory->id }}">{{ $courseCategory->name }}</option>
                    @endforeach
                </select> --}}

            </div>

            <div class="flex justify-end gap-3 mt-5">
                <button class="btn" type="button" onclick="add_new_course_modal.close()">Close</button>
                <button class="btn btn-active btn-primary">Submit</button>
            </div>
        </form>
    </div>
</dialog>
