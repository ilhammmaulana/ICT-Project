<button class="btn btn-primary btn-active" onclick="add_new_course_module_modal.showModal()">Add Module</button>
<dialog id="add_new_course_module_modal" class="modal">
    <div class="modal-box w-11/12 max-w-xl">
        {{-- <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form> --}}

        <h3 class="text-lg font-bold">Add New Module</h3>
        <form action="{{ route('admin.course-modules.store') }}" method="POST">
            @method('POST')
            @csrf
            <div class="mt-5 mb-2 hidden">
                <label for="course_id" class="text-base block"></label>
                <input type="text" name="course_id" required value="{{ $courseId }}" />
            </div>
            <div class="mt-5 mb-2">
                <label for="title" class="text-base block">Module Title</label>
                <input type="text" placeholder="Your module title" class="input input-bordered w-full max-full mt-2"
                    id="module-title-input" name="title" required />
            </div>

            <div class="mt-5 mb-2">
                <label for="description" class="text-base block">Module Description</label>

                <textarea class="textarea textarea-bordered w-full mt-2" id="module-description-input" name="description"
                    placeholder="Your module description" required></textarea>
            </div>
            <div class="flex justify-end gap-3 mt-5">
                <button class="btn" type="button" onclick="add_new_course_module_modal.close()">Close</button>
                <button class="btn btn-active btn-primary">Submit</button>
            </div>
        </form>
    </div>
</dialog>
