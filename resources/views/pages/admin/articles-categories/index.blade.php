<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="">
                <h2 class="text-xl font-semibold leading-tight mb-6">
                    {{ __('Manage Article Categories') }}
                </h2>
                <form action="" method="GET">
                    <label class="input input-bordered input-info flex items-center gap-2">
                        <input type="text" class="grow input focus:border-none active:border-none" name="search"
                            placeholder="Search" value="{{ request('search') }}" />
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="h-4 w-4 opacity-70">
                            <path fill-rule="evenodd"
                                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                clip-rule="evenodd" />
                        </svg>

                    </label>
                </form>
            </div>
            <div class="flex gap-3  mt-auto">
                <x-article-categories.create-modal />
            </div>
        </div>
    </x-slot>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 px-4 py-4 rounded-lg">
        <table class="table rounded-xl">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articleCategories as $category)
                    <tr class="bg-white dark:bg-gray-800">
                        <th>{{ $loop->iteration + ($articleCategories->currentPage() - 1) * $articleCategories->perPage() }}
                        </th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->created_at ?? '-' }}</td>
                        <td>{{ $category->updated_at ?? '-' }}</td>
                        <td class="flex gap-2 ">
                            <x-articles.edit-modal :articleCategory="$category" />
                            <x-modal.delete-modal :id="$category->id" :action="route('admin.article-categories.destroy', $category->id)" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-center mt-5">
            <div class="join">
                @if ($articleCategories->onFirstPage())
                    <span
                        class="join-item btn btn-square tab-disabled dark:bg-dark-eval-0 bg-gray-300 hover:bg-gray-300">
                        <x-icons.chevron-left></x-icons.chevron-left>
                    </span>
                @else
                    <a class="join-item btn btn-square" href="{{ $articleCategories->previousPageUrl() }}"
                        aria-label="Previous">
                        <x-icons.chevron-left></x-icons.chevron-left>
                    </a>
                @endif
                @foreach ($articleCategories->getUrlRange(1, $articleCategories->lastPage()) as $page => $url)
                    <a class="join-item btn btn-square {{ $page == $articleCategories->currentPage() ? 'btn-primary' : '' }}"
                        href="{{ $url }}" aria-label="Page {{ $page }}">
                        {{ $page }}
                    </a>
                @endforeach
                @if ($articleCategories->hasMorePages())
                    <a class="join-item btn btn-square" href="{{ $articleCategories->nextPageUrl() }}"
                        aria-label="Next">
                        <x-icons.chevron-right></x-icons.chevron-right>
                    </a>
                @else
                    <span
                        class="join-item btn btn-square tab-disabled dark:bg-dark-eval-0 bg-gray-300 hover:bg-gray-300"
                        type="radio" aria-label="Last">
                        <x-icons.chevron-right></x-icons.chevron-right>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script>
            function confirmDelete(articleCategoryId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form if confirmed
                        document.getElementById('delete-form-' + articleCategoryId).submit();

                        Swal.fire(
                            'Deleted!',
                            'Your category has been deleted.',
                            'success'

                        );
                    }
                });
            }
        </script>
    </x-slot>
</x-app-layout>
