<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Course Categories') }}
            </h2>
        </div>
    </x-slot>

    <div class="flex justify-between">
        <form action="{{ route('admin.course-categories.index') }}" method="GET">
            <label class="input input-bordered input-info flex items-center gap-2" for="search">
                <input type="text" class="grow input focus:border-none active:border-none" placeholder="Search"
                    name="search" value="{{ request('search') }}" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="h-4 w-4 opacity-70">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </label>
        </form>
        <x-course-categories.create-modal />
    </div>


    <div class="relative overflow-hidden rounded mt-10">
        <table class="w-full text-sm text-left rtl:text-right">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
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
                @foreach ($course_categories as $course_category)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{ $loop->iteration }}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $course_category->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $course_category->created_at ?? '-' }}

                    </td>
                    <td class="px-6 py-4">
                        {{ $course_category->updated_at ?? '-' }}

                    </td>
                    <td class="px-6 py-4">
                        <x-course-categories.edit-modal :courseCategory="$course_category" />
                        <x-modal.delete-modal :id="$course_category->id"
                            :action="route('admin.course-categories.destroy', $course_category->id)" :style="'table'" />
                        {{-- <x-button href="{{ route('admin.course-categories.edit', $course_category) }}">
                        Edit
                        </x-button> --}}
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</x-app-layout>