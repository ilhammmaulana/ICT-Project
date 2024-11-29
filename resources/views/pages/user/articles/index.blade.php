<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="flex justify-between">
        <form action="{{ route('user.articles.index') }}" method="GET" class="flex items-center gap-3"
            id="article_search_form">
            <label for="categoryId" class="hidden">
            </label>
            <select class="select select-primary w-full max-w-xs" id="category_search_input" name="categoryId">
                <option selected value="">Choose article category</option>
                @foreach ($article_categories as $article_category)
                    <option value="{{ $article_category->id }}" @if (request('categoryId') == $article_category->id) selected @endif>
                        {{ $article_category->name }}</option>
                @endforeach
            </select>
            <label class="input input-bordered input-info flex items-center gap-2" for="search">
                <input type="text" class="grow input  focus:border-none active:border-none" placeholder="Search"
                    name="search" value="{{ request('search') }}" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="h-4 w-4 opacity-70">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </label>
        </form>

    </div>

    <div class="grid grid-cols-4 mt-5 gap-5">
        @foreach ($articles as $article)
            <div class="rounded-lg shadow overflow-hidden bg-white">
                <a href="{{ route('user.articles.show', $article) }}">
                    <img src="{{ asset($article->image) }}" alt="{{ $article->title }}"
                        class=" aspect-video object-cover">

                    <div class="p-2">
                        @php
                            $date = \Carbon\Carbon::parse($article->created_at)->format('d M Y');
                        @endphp
                        <p class="text-xs">{{ $date }}</p>
                        <h2 class="font-semibold">{{ $article->title }}</h2>
                    </div>
                </a>
            </div>
        @endforeach
    </div>


</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('article_search_form');

        console.log(searchForm);
        const categorySearchInput = document.getElementById('category_search_input');
        console.log(categorySearchInput);
        if (categorySearchInput) {
            categorySearchInput.addEventListener('change', function() {
                if (searchForm) {
                    searchForm.submit();
                }
            })
        }
    })
</script>
