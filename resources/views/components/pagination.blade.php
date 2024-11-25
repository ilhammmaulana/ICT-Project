<div class="flex justify-center mt-5">
    <div class="join">
        @if ($articles->onFirstPage())
            <span class="join-item btn btn-square tab-disabled dark:bg-dark-eval-0 bg-gray-300 hover:bg-gray-300">
                <x-icons.chevron-left></x-icons.chevron-left>
            </span>
        @else
            <a class="join-item btn btn-square" href="{{ $articles->previousPageUrl() }}" aria-label="Previous">
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
            <span class="join-item btn btn-square tab-disabled dark:bg-dark-eval-0 bg-gray-300 hover:bg-gray-300"
                type="radio" aria-label="Last">
                <x-icons.chevron-right></x-icons.chevron-right>
                <span>
        @endif
    </div>
</div>
