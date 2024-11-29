<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Manage article') }}
            </h2>
            <div class="flex gap-3">
                <x-button class="text-sm flex gap-2 align-middle" href="{{ route('admin.article-categories.create') }}">
                    <x-icons.add></x-icons.add>
                    <span>Create Category</span>
                </x-button>
                <label class="input input-bordered flex items-center gap-2">
                    <input type="text" class="grow" placeholder="Search" />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="h-4 w-4 opacity-70">
                        <path fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </label>
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
                            <x-button variant="warning" iconOnly="true"
                                href="{{ route('admin.article-categories.edit', $category) }}">
                                <x-icons.edit></x-icons.edit>
                            </x-button>
                            <form action="{{ route('admin.article-categories.destroy', $category->id) }}" method="POST"
                                id="delete-form-{{ $category->id }}">
                                @csrf
                                @method('DELETE')
                                <x-button iconOnly="true" type="button" variant="danger"
                                    onclick="confirmDelete('{{ $category->id }}')">
                                    <x-icons.trash></x-icons.trash>
                                </x-button>
                            </form>
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