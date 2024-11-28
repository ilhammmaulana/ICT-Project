<x-app-layout>
    <x-slot name="head">
        @trixassets
        {{-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css"> --}}
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create Category Article') }}
            </h2>
        </div>
    </x-slot>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 px-4 py-4 rounded-lg" x-data="formData()">
        <form action="{{ route('admin.article-categories.update', $articleCategory->id) }}" method="POST"
            enctype="multipart/form-data" class="grid grid-cols-1 gap-6">
            @method('PUT')
            @csrf

            <div class="grid grid-cols-1 gap-4">
                <div class="form-group">
                    <x-form.label class="mb-2" for="name" :value="__('Name Category')" />
                    <x-form.input id="name" name="name" type="text" required autofocus autocomplete="name"
                        placeholder="Masukkan Judul" value="{{ old('name', $articleCategory->name) }}" />
                    <x-form.error :messages="$errors->get('name')" />
                </div>
            </div>

            <!-- Submit -->
            <div class="form-group">
                <x-button variant="primary" type="submit">{{ __('Simpan') }}</x-button>
            </div>
        </form>
    </div>

    <x-slot name="script">
        <script></script>
    </x-slot>
</x-app-layout>
