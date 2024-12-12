<x-landing-layout>
    <section class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-6">Artikel</h1>
        <hr>

        <div class="my-10 mx:mx-5 lg:mx-10 xl:mx-20">
            <form action="{{ route('articles.index') }}" method="GET" class="flex items-center gap-3"
                id="article_search_form">

                <label for="categoryId" class="hidden">
                </label>
                <select class="select select-primary w-full max-w-xs select-md text-sm" id="category_search_input"
                    name="categoryId">
                    <option selected value="">Kategori</option>
                    @foreach ($article_categories as $article_category)
                    <option value="{{ $article_category->id }}" @if (request('categoryId')==$article_category->id)
                        selected @endif>
                        {{ $article_category->name }}</option>
                    @endforeach
                </select>

                <label class="input input-bordered input-info flex items-center gap-2 w-full max-w-sm input-md"
                    for="search">
                    <input type="text" class="grow input  focus:border-none active:border-none text-sm"
                        placeholder="Search" name="search" value="{{ request('search') }}" />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="h-4 w-4 opacity-70">
                        <path fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </label>
            </form>
        </div>

        <!-- Grid Artikel -->
        <div class="bg-white py-4 px-4 rounded-md mx:mx-5 lg:mx-10 xl:mx-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
                @foreach ($articles as $article)
                <a class="card mx-auto h-[700] bg-base-100 w-full flex flex-col "
                    href="{{ route('articles.show', $article->slug) }}">
                    <figure class="rounded-lg aspect-video object-cover">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                            class="w-full h-80" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title text-md font-semibold leading-normal">
                            {{ $article->title }}
                        </h2>
                        <p class="text-gray-600 text-sm"> <br>
                            {{ Str::limit(strip_tags($article->content), 100, '...') }}
                        </p>
                        <div class="card-actions justify-between flex items-center space-x-2 mt-3">
                            <div class="text-xs text-gray-500 flex gap-1">
                                <span>Created by: {{ $article->user->name }}</span>
                                <span>&bull;</span> <!-- Bullet point separator -->
                                <span>
                                    Published {{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}
                                </span>
                            </div>
                            @if ($article->categoryArticle)
                            <div class="badge badge-primary text-xs">{{ $article->categoryArticle->name }}</div>
                            @else
                            <div class="badge badge-primary text-xs">Uncategorized</div>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach

            </div>

            <div class="flex justify-center mt-20">
                <nav aria-label="Pagination">
                    <ul class="inline-flex items-center space-x-2">
                        <!-- Previous Page Link -->
                        @if ($articles->onFirstPage())
                        <li>
                            <span class="px-3 py-1 text-gray-500 bg-gray-200 rounded cursor-not-allowed">
                                ← Previous
                            </span>
                        </li>
                        @else
                        <li>
                            <a href="{{ $articles->previousPageUrl() }}"
                                class="px-3 py-1 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                                ← Previous
                            </a>
                        </li>
                        @endif

                        <!-- Pagination Links -->
                        @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                        <li>
                            @if ($page == $articles->currentPage())
                            <span class="px-3 py-1 text-white bg-blue-500 rounded cursor-default">
                                {{ $page }}
                            </span>
                            @else
                            <a href="{{ $url }}" class="px-3 py-1 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                                {{ $page }}
                            </a>
                            @endif
                        </li>
                        @endforeach

                        <!-- Next Page Link -->
                        @if ($articles->hasMorePages())
                        <li>
                            <a href="{{ $articles->nextPageUrl() }}"
                                class="px-3 py-1 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                                Next →
                            </a>
                        </li>
                        @else
                        <li>
                            <span class="px-3 py-1 text-gray-500 bg-gray-200 rounded cursor-not-allowed">
                                Next →
                            </span>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>

        </div>

        <!-- Pagination -->


    </section>
</x-landing-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('article_search_form');
        const categorySearchInput = document.getElementById('category_search_input');

        if (categorySearchInput) {
            categorySearchInput.addEventListener('change', function() {
                if (searchForm) {
                    searchForm.submit();
                }
            })
        }
    })
</script>