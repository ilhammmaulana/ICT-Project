<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Course') }}
            </h2>

        </div>
    </x-slot>

    <div class="flex justify-between">
        <input type="text" placeholder="Type here" class="input input-bordered input-primary w-full max-w-sm" />

        {{-- <x-courses.create-course-modal :courses="$course_categories" /> --}}
        {{-- <x-courses.create-course-modal :course-categories="$course_categories" /> --}}
        <a href="{{ route('admin.courses.create') }}">
            <button class="btn btn-primary btn-active">Add Course</button>
        </a>

    </div>
    <div class="relative overflow-hidden rounded mt-10">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Meta Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Meta Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cover Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Updated At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $course->name }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $course->title }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $course->description }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $course->meta_title }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $course->meta_description }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($course->image)
                                <img src="{{ asset($course->image) }}" alt="{{ $course->name }}" class="rounded max-w-40">
                            @else
                                No Image
                            @endif
                        </th>
                        <td class="px-6 py-4">
                            {{ $course->created_at ?? '-' }}

                        </td>
                        <td class="px-6 py-4">
                            {{ $course->updated_at ?? '-' }}

                        </td>
                        <td class="px-6 py-4">
                            {{-- <x-button href="{{ route('admin.course-categories.edit', $course) }}">
                                Edit
                            </x-button> --}}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</x-app-layout>
