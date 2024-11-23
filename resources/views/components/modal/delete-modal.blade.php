<button class="p-2 {{ $class ?? '' }}" onclick="document.getElementById('{{ str_replace('-', '_', $id) }}').showModal()">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="size-4">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
    </svg>

</button>

<dialog id="{{ str_replace('-', '_', $id) }}" class="modal">
    <div class="modal-box w-11/12 max-w-xl">
        <form action="{{ $action }}" method="POST" class="">
            @method('delete')
            @csrf
            <div class="flex justify-center">
                <div class="sa">
                    <div class="sa-warning">
                        <div class="sa-warning-body"></div>
                        <div class="sa-warning-dot"></div>
                    </div>
                </div>
            </div>
            <p class="text-center font-bold text-lg text-black dark:text-white mt-4">Delete</p>
            <p class="text-center text-lg text-black dark:text-white">
                Are you sure want to delete this data?
            </p>
            <div class="flex justify-end gap-3 mt-12">
                <button class="btn" type="button"
                    onclick="document.getElementById('{{ str_replace('-', '_', $id) }}').close()">Cancel</button>
                <button class="btn btn-active btn-error text-white dark:text-black">Delete</button>
            </div>
        </form>
    </div>
</dialog>
