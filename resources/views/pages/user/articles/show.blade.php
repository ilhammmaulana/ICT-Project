<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="bg-white p-3 rounded-xl py-5">
        <div class="max-w-[80ch] mx-auto">
            <img src="{{ url('/storage/' . $article->image) }}" alt="{{ $article->title }}"
                class="mx-auto max-w-3xl rounded-md">

            <h1 class="text-2xl text-center font-semibold my-4">{{ $article->title }}</h1>
            <div class="prose text-black mt-6">
                {!! $article->content !!}
            </div>
        </div>
    </div>
</x-app-layout>
