<x-landing-layout>
    <section class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-6">Artikel</h1>
        <hr>
        <!-- Dropdown Kategori -->
        {{-- <div class="flex justify-start mb-4 mt-3 md:mx-40">
            <div class="relative">
                <select class="select select-ghost w-72">
                    <option class="font-bold">
                        Kategori
                    </option>
                    <!-- Tambahkan kategori lain jika ada -->
                    <option>Desain</option>
                    <option>Teknologi</option>
                    <option>UI/UX</option>
                </select>
            </div>
        </div> --}}

        <div class="my-10 md:mx-20">
            <form action="{{ route('articles.index') }}" method="GET" class="flex items-center gap-3"
                id="article_search_form">

                <label for="categoryId" class="hidden">
                </label>
                <select class="select select-primary w-full max-w-xs select-md text-sm" id="category_search_input"
                    name="categoryId">
                    <option selected value="">Kategori</option>
                    @foreach ($article_categories as $article_category)
                        <option value="{{ $article_category->id }}" @if (request('categoryId') == $article_category->id) selected @endif>
                            {{ $article_category->name }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Grid Artikel -->
        <div class="bg-white py-8 px-8 rounded-md md:mx-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
                @foreach ($articles as $article)
                    <a class="card mx-auto bg-base-100 block w-full"
                        href="{{ route('articles.show', $article->slug) }}">
                        <figure class="rounded-lg aspect-video object-cover">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                class="w-full h-80" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">
                                <span class="truncate">{{ $article->title }}</span>
                                <div class="badge">NEW</div>
                            </h2>
                            <p>{{ Str::limit($article->body, 100, '...') }}</p>
                            <div class="card-actions justify-end">
                                @if ($article->categoryArticle)
                                    <div class="badge badge-primary">{{ $article->categoryArticle->name }}</div>
                                @else
                                    <div class="badge badge-primary">Uncategorized</div>
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
                                    <a href="{{ $url }}"
                                        class="px-3 py-1 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
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
