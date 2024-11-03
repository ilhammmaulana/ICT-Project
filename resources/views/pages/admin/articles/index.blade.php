<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Manage article') }}
            </h2>
        </div>
    </x-slot>
    <div class="overflow-x-auto">
        <table class="table w-full" data-theme="light">
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
                    <tr>
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
    </div>
</x-app-layout>
