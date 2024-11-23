<button class="btn btn-primary btn-active text-white" onclick="add_new_course_category_modal.showModal()">Add
    Category</button>
<dialog id="add_new_course_category_modal" class="modal">
    <div class="modal-box w-11/12 max-w-xl">
        <h3 class="text-lg font-bold">Add New Category</h3>
        <form action="{{ route('admin.course-categories.store') }}" method="POST">
            @method('POST')
            @csrf

            <div class="mt-5 mb-2">
                <label for="name" class="text-base block">Name</label>
                <input type="text" placeholder="Category name" class="input input-bordered w-full max-full mt-2"
                    id="module-name-input" name="name" />
            </div>


            <div class="flex gap-3 items-center justify-end mt-5">
                <button class="btn" type="button" onclick="add_new_course_category_modal.close()">Close</button>
                <button class="btn btn-active btn-primary text-white">Submit</button>
            </div>

        </form>
    </div>
</dialog>
