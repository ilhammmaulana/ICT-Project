@php
    $youtubeEmbedUrl = null;
    $youtubeThumbnailUrl = null;

    // Check if the link is a YouTube URL and extract the video ID
    if (str_contains($content->content, 'youtube.com') || str_contains($content->content, 'youtu.be')) {
        $urlParts = parse_url($content->content);

        if (isset($urlParts['host']) && str_contains($urlParts['host'], 'youtu.be')) {
            // Shortened YouTube link (e.g., https://youtu.be/VIDEO_ID)
            $videoId = ltrim($urlParts['path'], '/');
        } elseif (isset($urlParts['query'])) {
            // Standard YouTube link (e.g., https://www.youtube.com/watch?v=VIDEO_ID)
            parse_str($urlParts['query'], $queryParts);
            $videoId = $queryParts['v'] ?? null;
        }

        // Construct the thumbnail and embed URLs if we have a video ID
        if (isset($videoId)) {
            $youtubeEmbedUrl = 'https://www.youtube.com/embed/' . $videoId;
            $youtubeThumbnailUrl = 'https://img.youtube.com/vi/' . $videoId . '/0.jpg';
        }
    }
@endphp

@if ($youtubeThumbnailUrl)
    <div class="rounded-lg mb-5 w-full">
        <div class="relative w-full">
            <div class="w-full flex justify-center">
                <img src="{{ $youtubeThumbnailUrl }}" alt="YouTube Thumbnail" class="block rounded-lg w-3/5">
            </div>
            <button
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white transform-none p-2 flex justify-center items-center rounded-[50%] bg-red-500"
                onclick="document.getElementById('{{ 'video' . str_replace('-', '_', $id) }}').showModal()">

                <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                </svg>

            </button>
            <dialog id="{{ 'video' . str_replace('-', '_', $id) }}" class="modal bg-black/60">
                <div class="absolute top-5 right-10 z-[10000] text-white">
                    <button onclick="document.getElementById('{{ 'video' . str_replace('-', '_', $id) }}').close()"
                        class="transform-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor" class="size-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>

                    </button>
                </div>
                <div class="modal-box w-11/12 max-w-3xl bg-transparent">

                    @php
                        $youtubeEmbedUrl = null;

                        // Extract the video ID from the URL
                        $urlParts = parse_url($url);

                        if (isset($urlParts['host'])) {
                            if (str_contains($urlParts['host'], 'youtu.be')) {
                                // Shortened YouTube link (e.g., https://youtu.be/VIDEO_ID)
                                $videoId = ltrim($urlParts['path'], '/');
                            } elseif (str_contains($urlParts['host'], 'youtube.com') && isset($urlParts['query'])) {
                                // Standard YouTube link (e.g., https://www.youtube.com/watch?v=VIDEO_ID)
                                parse_str($urlParts['query'], $queryParts);
                                $videoId = $queryParts['v'] ?? null;
                            }

                            // Construct the embed URL if we have a video ID
                            if (isset($videoId)) {
                                $youtubeEmbedUrl = 'https://www.youtube.com/embed/' . $videoId;
                            }
                        }
                    @endphp
                    @if ($youtubeEmbedUrl)
                        <div class="w-full">
                            <iframe src="{{ $youtubeEmbedUrl }}" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen class="w-full h-80"></iframe>
                        </div>
                    @endif


                </div>
            </dialog>
        </div>
    </div>
@endif
