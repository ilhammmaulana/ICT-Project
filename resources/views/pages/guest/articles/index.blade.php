<x-landing-layout>
    <section class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-6">Artikel</h1>
        <hr>
        <!-- Dropdown Kategori -->
        <div class="flex justify-start mb-4 mt-3 md:mx-40">
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
        </div>

        <!-- Grid Artikel -->
        <div class="bg-white py-8 px-8 rounded-md md:mx-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ">
                @foreach ($articles as $article)
                    <a class="card mx-auto bg-base-100 w-80" href="{{ route('articles.show', $article->slug) }}">
                        <figure class="w-full h-64 overflow-hidden rounded-lg">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                class="w-full h-full object-cover" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">
                                {{ $article->title }}
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

            <div class="flex justify-center mt-6">
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
