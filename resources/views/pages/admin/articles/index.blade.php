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
                    <th>Title</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->created_at ?? '-' }}</td>
                        <td>{{ $article->updated_at ?? '-' }}</td>
                        <td>
                            <x-button href="{{ route('admin.articles.edit', $article) }}">
                                Edit
                            </x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-center">
            <div class="join mt-5">
                <input class="join-item btn btn-square" type="radio" name="options" aria-label="1"
                    checked="checked" />
                <input class="join-item btn btn-square" type="radio" name="options" aria-label="2" />
                <input class="join-item btn btn-square" type="radio" name="options" aria-label="3" />
                <input class="join-item btn btn-square" type="radio" name="options" aria-label="4" />
            </div>
        </div>
    </div>
</x-app-layout>
