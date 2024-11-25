<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Manage article') }}
            </h2>
            <div class="flex gap-3">
                <x-button class="text-sm flex gap-2 align-middle" href="{{ route('admin.articles.create') }}">
                    <x-icons.add></x-icons.add>
                    <span>
                        Create Article
                    </span>
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
            <!-- head -->
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th>{{ $loop->iteration + ($articles->currentPage() - 1) * $articles->perPage() }}</th>
                        <th>
                            <div class="w-24 h-24 overflow-hidden relative group">
                                <img src="{{ url('/storage/' . $article->image) }}" alt="{{ $article->title }}">
                            </div>
                        </th>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->created_at ?? '-' }}</td>
                        <td>{{ $article->updated_at ?? '-' }}</td>
                        <td class="flex gap-2">
                            <x-button href="{{ route('admin.articles.edit', $article) }}">
                                Edit
                            </x-button>
                            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" variant="danger"
                                    href="{{ route('admin.articles.edit', $article) }}">
                                    Delete
                                </x-button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-center mt-5">
            <div class="join">
                @if ($articles->onFirstPage())
                    <span
                        class="join-item btn btn-square tab-disabled dark:bg-dark-eval-0 bg-gray-300 hover:bg-gray-300">
                        <x-icons.chevron-left></x-icons.chevron-left>
                    </span>
                @else
                    <a class="join-item btn btn-square" href="{{ $articles->previousPageUrl() }}"
                        aria-label="Previous">
                        <x-icons.chevron-left></x-icons.chevron-left>
                    </a>
                @endif

                @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                    <a class="join-item btn btn-square {{ $page == $articles->currentPage() ? 'btn-primary' : '' }}"
                        href="{{ $url }}" aria-label="Page {{ $page }}">
                        {{ $page }}
                    </a>
                @endforeach

                @if ($articles->hasMorePages())
                    <a class="join-item btn btn-square" href="{{ $articles->nextPageUrl() }}" aria-label="Next">
                        <x-icons.chevron-right></x-icons.chevron-right>
                    </a>
                @else
                    <span
                        class="join-item btn btn-square tab-disabled dark:bg-dark-eval-0 bg-gray-300 hover:bg-gray-300"
                        type="radio" aria-label="Last">
                        <x-icons.chevron-right></x-icons.chevron-right>
                        <span>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
