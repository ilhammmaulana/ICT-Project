<button class="btn btn-sm"
    onclick="document.getElementById('{{ str_replace('-', '_', $articleCategory->id) . '_edit' }}').showModal()"><svg
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="size-4">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
    </svg>
</button>
<dialog id="{{ str_replace('-', '_', $articleCategory->id) . '_edit' }}" class="modal">
    <div class="modal-box w-11/12 max-w-xl">
        <h3 class="text-lg font-bold">Edit Category</h3>
        <form action="{{ route('admin.article-categories.update', $articleCategory) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="mt-5 mb-2">
                <label for="name" class="text-base block">Name</label>
                <input type="text" placeholder="Category name" class="input input-bordered w-full max-full mt-2"
                    id="module-name-input" name="name"value="{{ $articleCategory->name }}" />
            </div>


            <div class="flex gap-3 items-center justify-end mt-5">
                <button class="btn" type="button"
                    onclick="document.getElementById('{{ str_replace('-', '_', $articleCategory->id) . '_edit' }}').close()">Close</button>
                <button class="btn btn-active btn-primary text-white">Submit</button>
            </div>

        </form>
    </div>
</dialog>
