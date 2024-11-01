<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Manage article') }}
            </h2>

        </div>
    </x-slot>
    <div class="overflow-x-auto">
        <div class="overflow-x-auto bg-dark-eval-3 ">
            <table class="table">
                <thead>
                    <tr class="dark:text-white">
                        <th></th>
                        <th>Name</th>
                        <th>Job</th>
                        <th>Favorite Color</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr>
                        <th>1</th>
                        <td>Cy Ganderton</td>
                        <td>Quality Control Specialist</td>
                        <td>Blue</td>
                    </tr>
                    <!-- row 2 -->
                    <!-- row 3 -->
                    <tr>
                        <th>3</th>
                        <td>Brice Swyre</td>
                        <td>Tax Accountant</td>
                        <td>Red</td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title Article
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
                @foreach ($articles as $article)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $article->title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $article->created_at ?? '-' }}

                        </td>
                        <td class="px-6 py-4">
                            {{ $article->udpated_at ?? '-' }}

                        </td>
                        <td class="px-6 py-4">
                            <x-button href="{{ route('admin.articles.edit', $article) }}">
                                Edit
                            </x-button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table> --}}
    </div>
    <div class="join mt-5">
        <button class="join-item btn-sm">1</button>
        <button class="join-item btn-sm btn-active">2</button>
        <button class="join-item btn-sm">3</button>
        <button class="join-item btn-sm">4</button>
    </div>


</x-app-layout>
