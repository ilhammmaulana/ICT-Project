<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Course') }}
            </h2>

        </div>
    </x-slot>

    <div class="flex justify-between">
        <form action="{{ route('admin.courses.index') }}" method="GET">
            <label class="input input-bordered input-info flex items-center gap-2" for="search">
                <input type="text" class="grow input  focus:border-none active:border-none" placeholder="Search"
                    name="search"  value="{{ request('search') }}"/>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="h-4 w-4 opacity-70">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </label>
        </form>
        {{-- <input type="text" placeholder="Type here" class="input input-bordered input-primary w-full max-w-sm" /> --}}

        {{-- <x-courses.create-course-modal :courses="$course_categories" /> --}}
        {{-- <x-courses.create-course-modal /> --}}
        <a href="{{ route('admin.courses.create') }}">
            <button class="btn btn-primary btn-active text-white">Add Course</button>
        </a>

    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 px-4 py-4 rounded-lg mt-10">
        <table class="table rounded-xl">
            <thead>
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
                        Category
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
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <th>
                            {{ $course->name }}
                        </th>
                        <th>
                            {{ $course->title }}
                        </th>
                        <th>
                            {{ $course->description }}
                        </th>
                        <th>
                            {{ $course->meta_title }}
                        </th>

                        <th>
                            {{ $course->meta_description }}
                        </th>

                        <th>
                            @if ($course->image)
                                <img src="{{ asset($course->image) }}" alt="{{ $course->name }}"
                                    class="rounded max-w-40">
                            @else
                                No Cover Image
                            @endif
                        </th>
                        <th>
                            {{ $course->courseCategory->name }}
                        </th>
                        <td>
                            {{ $course->created_at ?? '-' }}

                        </td>
                        <td>
                            {{ $course->updated_at ?? '-' }}
                        </td>
                        <td class="px-6 py-4 flex gap-3">
                            <x-detail-button href="{{ route('admin.courses.show', $course) }}" />

                            {{-- <x-edit-button href="{{ route('admin.courses.edit', $course) }}" /> --}}

                            <x-modal.delete-modal :id="$course->id" :action="route('admin.courses.destroy', $course->id)" />
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</x-app-layout>
