@php
    $course_categories = \App\Models\CourseCategory::all();
@endphp

<button class="btn" onclick="edit_course_modal.showModal()">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
    </svg>

    Edit
</button>
<dialog id="edit_course_modal" class="modal">
    <div class="modal-box w-11/12 max-w-xl">
        <h3 class="text-lg font-bold">Edit Course</h3>

        <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="gap-3">
                <div class="mt-5 mb-2">
                    <label for="course_category_id" class="text-base block">Course Category</label>

                    <select class="select select-bordered w-full mt-2" id="course_category_id_input"
                        name="course_category_id">
                        <option disabled selected>Select course category</option>
                        @foreach ($course_categories as $courseCategory)
                            <option value="{{ $courseCategory->id }}" @if ($courseCategory->id == $course->course_category_id) selected @endif>
                                {{ $courseCategory->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="mt-5 mb-2">
                    <label for="name" class="text-base block">Course Name</label>
                    <input type="text" placeholder="Your course name"
                        class="input input-bordered w-full max-full mt-2" id="course-name-input" name="name" required
                        value="{{ $course->name }}" />
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
                        class="input input-bordered w-full max-full mt-2" id="course-meta-title-input" name="meta_title"
                        required value="{{ $course->meta_title }}" />
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

                    <div class="mt-2" id="cover_image_preview">

                        @if ($course->image)
                            <img src="{{ asset($course->image) }}" id="previous-course-image-preview"
                                alt="{{ $course->name }}" class="max-w-80">
                        @endif
                    </div>

                    <input type="file" class="file-input file-input-bordered w-full mt-2" id="cover_image_input"
                        name="image" />
                </div>
            </div>


            <div class="flex justify-end gap-3 mt-5">
                <button class="btn" type="button" onclick="edit_course_modal.close()">Close</button>
                <button class="btn btn-active btn-primary">Submit</button>
            </div>
        </form>
    </div>
</dialog>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const imagePreviewContainer = document.getElementById('cover_image_preview');
        const imageInput = document.getElementById('cover_image_input');
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            const reader = new FileReader();
            reader.addEventListener('load', function() {
                const image = document.createElement('img');
                image.classList.add("max-w-80")
                image.src = reader.result;
                imagePreviewContainer.innerHTML = '';
                imagePreviewContainer.appendChild(image);
            });
            reader.readAsDataURL(file);
        });

        document.getElementById('previous-course-image-preview').style.display = 'none';
    })
</script>
