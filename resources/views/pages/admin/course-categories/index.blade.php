<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Course Categories') }}
            </h2>

        </div>
    </x-slot>

    <div class="relative overflow-hidden rounded">
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
                        {{ $course_category->udpated_at ?? '-' }}

                    </td>
                    <td class="px-6 py-4">
                        <x-button href="{{ route('admin.course-categories.edit', $course_category) }}">
                            Edit
                        </x-button>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</x-app-layout>