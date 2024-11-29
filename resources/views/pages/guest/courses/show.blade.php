<x-landing-layout>

    <div class="container mx-auto my-10 max-w-[90%] xl:max-w-[80%] bg-white p-8 rounded-lg">
        <section class="">
            <div class="flex justify-between items-center gap-2">
                <h1 class="text-2xl text-left font-semibold">{{ $course->title }}</h1>
                @if ($is_user_joined)
                    <a href="{{ route('user.courses.show', $course) }}"> <button
                            class="btn btn-sm btn-primary text-white text-sm">
                            Belajar Sekarang
                        </button></a>
                @else
                    <form action="{{ route('courses.join', $course->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-primary text-white text-sm" type="submit">
                            Belajar Sekarang
                        </button>
                    </form>
                @endif
            </div>
            <p class="text-xs text-gray-600 indent-6 text-wrap mt-3">{{ $course->description }}</p>

            <hr class="m-5 mb-8">
            <img src="{{ asset($course->image) }}" alt="{{ $course->title }}" class="w-full rounded-md">
        </section>

        <section class="mt-10">
            @foreach ($course->modules as $module)
                <div class="mb-7">
                    <div class="mb-5">
                        <p class="text-2xl font-bold">{{ $loop->iteration }}</p>
                        <p class="text-sm font-semibold mt-5">{{ $module->title }}</p>
                    </div>

                    @if ($is_user_joined)
                        @foreach ($module->moduleContents as $content)
                            @if ($content->content_type === 'LINK' && $content->content)
                                <x-courses.youtube-video-modal :id="$module->id" :url="$content->content" :content="$content" />
                            @endif
                        @endforeach

                        @foreach ($module->moduleContents as $content)
                            @if ($content->content_type === 'LINK' && $content->content)
                                @php
                                    $isYouTubeLink = false;
                                    if (
                                        str_contains($content->content, 'youtube.com') ||
                                        str_contains($content->content, 'youtu.be')
                                    ) {
                                        $isYouTubeLink = true;
                                    }
                                @endphp

                                @if (!$isYouTubeLink)
                                    <div class="p-3 shadow-sm border rounded-md mb-2">
                                        <a href="{{ $content->content }}" target="_blank" class="underline w-full"
                                            referrerpolicy="no-referrer">{{ $content->content }}</a>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @else
                        @php
                            $faker = \Faker\Factory::create();
                        @endphp
                        <div class="relative">
                            <div class="blur-[3px]">
                                @foreach (range(1, $module->moduleContents->count()) as $index)
                                    <div class="p-3 shadow-sm border rounded-md mb-2">
                                        <p>{{ $faker->sentence }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <div
                                class="p-3 shadow-sm border rounded-md absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white">
                                <p>You need to join this course to see the contents</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </section>
    </div>
</x-landing-layout>
