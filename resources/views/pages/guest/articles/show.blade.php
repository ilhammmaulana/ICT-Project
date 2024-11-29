<x-article-layout :title="$article->title">
    <!-- Judul Artikel -->
    @if ($article->image)
        <div class="rounded-lg overflow-hidden mb-6 max-w-md">
            <img src="{{ url('storage/' . $article->image) }}" alt="{{ $article->title }}"
                class="w-full h-48 object-cover md:h-64 lg:h-72">
        </div>
    @endif
    <h1 class="text-4xl font-bold mb-4">{{ $article->title }}</h1>
    <div class="flex items-center justify-between text-sm text-gray-500 mb-6">
        <p>Date: {{ $article->created_at->format('d M Y') }}</p> <br>
        <p>Write by {{ $article->user->name }}</p>
    </div>

    <!-- Gambar Artikel -->



    <!-- Konten Artikel -->
    <div class="prose max-w-none dark:prose-invert">
        {!! $article->content !!}
    </div>
</x-article-layout>
