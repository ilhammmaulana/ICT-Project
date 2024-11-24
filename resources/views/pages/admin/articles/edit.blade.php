<x-app-layout>
    <x-slot name="head">
        @trixassets
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Article') }}
            </h2>
        </div>
    </x-slot>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 px-4 py-4 rounded-lg" x-data="formData()">
        <form action="{{ route('admin.articles.udpate', $article->id) }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 gap-6">
            @csrf
            @method('PUT')
            <!-- Thumbnail Image -->
            <div class="form-group">
                <x-form.label class="mb-2" for="image" :value="__('Thumbnail Image')" />
                <x-form.input-file id="image" name="image" x-on:change="previewImage" />
                <x-form.error :messages="$errors->get('image')" />
                <div x-show="imagePreview" class="mt-2">
                    <label class="block text-sm text-gray-600">Image Preview:</label>
                    <img :src="imagePreview" class="w-32 h-32 object-cover rounded-md" />
                </div>
            </div>

            <!-- Title and Slug -->
            <div class="grid grid-cols-2 gap-4">
                <div class="form-group">
                    <x-form.label class="mb-2" for="title" :value="__('Title')" />
                    <x-form.input id="title" name="title" type="text" x-model="title" x-on:input="generateSlug"
                        required autofocus autocomplete="title" placeholder="Masukkan Judul"
                        value="{{ old('title', $article->title) }}" />
                    <x-form.error :messages="$errors->get('title')" />
                </div>
                <div class="form-group">
                    <x-form.label class="mb-2" for="slug" :value="__('Slug')" />
                    <x-form.input id="slug" name="slug" type="text" x-model="slug" readonly
                        placeholder="Slug otomatis diisi" disabled />
                    <x-form.error :messages="$errors->get('slug')" />
                </div>
                <div class="form-group col-span-2">
                    <x-form.label class="mb-2" for="category_id" :value="__('Category')" />
                    <x-form.select required :options="$articleCategories" valueKey="id" displayKey="name" id="article_category_id"
                        name="article_category_id" type="text" :value="$article->article_category_id" />
                    <x-form.error :messages="$errors->get('article_category_id')" />
                </div>
                <div class="form-control">
                    <label class="label cursor-pointer">
                        <span class="label-text text-black dark:text-slate-200">Advanced Settings</span>
                        <input type="hidden" name="advance_settings" value="false">
                        <input type="checkbox" name="advance_settings" x-model="showMeta"
                            class="checkbox checkbox-primary" />
                    </label>
                </div>
            </div>

            <!-- Advanced Meta Settings -->
            <div x-show="showMeta" class="grid grid-cols-2 gap-4">
                <div class="form-group">
                    <x-form.label class="mb-2" for="meta_title" :value="__('Meta Title')" />
                    <x-form.input id="meta_title" name="meta_title" type="text" placeholder="Masukkan Meta Title"
                        value="{{ old('meta_title', $article->meta_title) }}" />
                    <x-form.error :messages="$errors->get('meta_title')" />
                </div>
                <div class="form-group">
                    <x-form.label class="mb-2" for="meta_author" :value="__('Meta Author')" />
                    <x-form.input id="meta_author" name="meta_author" type="text" placeholder="Masukkan Meta Author"
                        value="{{ old('meta_author', $article->meta_author) }}" />
                    <x-form.error :messages="$errors->get('meta_author')" />
                </div>
                <div class="form-group">
                    <x-form.label class="mb-2" for="meta_keyword" :value="__('Meta Keyword')" />
                    <x-form.input id="meta_keyword" name="meta_keyword" type="text"
                        placeholder="Masukkan Meta Keyword. Example: HTML, CSS, JS"
                        value="{{ old('meta_keyword', $article->meta_keyword) }}" />
                    <x-form.error :messages="$errors->get('meta_keyword')" />
                </div>
                <div class="form-group col-span-2">
                    <x-form.label class="mb-2" for="meta_description" :value="__('Meta Description')" />
                    <textarea id="meta_description" name="meta_description" class="textarea textarea-bordered w-full"
                        placeholder="Masukkan Meta Description...">{{ old('meta_description', $article->meta_description) }}</textarea>
                    <x-form.error :messages="$errors->get('meta_description')" />
                </div>
            </div>

            <!-- Content (Trix Editor) -->
            <div class="form-group">
                <x-form.label class="mb-2" for="content" :value="__('Content')" />
                <!-- Hidden input for content (required by Trix) -->
                <input id="content" type="hidden" name="content" value="{{ old('content', $article->content) }}" />
                <!-- Trix Editor -->
                @trix($article->content, 'content')
                <x-form.error :messages="$errors->get('content')" />
            </div>

            <!-- Submit -->
            <div class="form-group">
                <x-button variant="primary" type="submit">{{ __('Update') }}</x-button>
            </div>
        </form>
    </div>

    <x-slot name="script">
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const trixEditor = document.querySelector('trix-editor');
                trixEditor.addEventListener('trix-change', function() {
                    const content = trixEditor.editor.getDocument().toString();
                    document.getElementById('content').value = content;
                });

                document.querySelector('form').addEventListener('submit', function(event) {
                    const content = document.getElementById('content').value;
                    console.log(content);
                });
            });

            function formData() {
                return {
                    title: '{{ old('title', $article->title) }}',
                    slug: '{{ old('slug', $article->slug) }}',
                    imagePreview: '{{ $article->image ? asset("storage/$article->image") : '' }}',
                    showMeta: Boolean(
                        '{{ $article->meta_title || $article->meta_author || $article->meta_keyword || $article->meta_description }}'
                    ),
                    generateSlug() {
                        this.slug = this.title
                            .toLowerCase()
                            .replace(/\s+/g, '-')
                            .replace(/[^a-z0-9-]/g, '')
                            .replace(/-+/g, '-')
                            .replace(/^-|-$/g, '');
                    },
                    previewImage(event) {
                        const file = event.target.files[0];
                        if (file && ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'].includes(file.type)) {
                            const reader = new FileReader();
                            reader.onload = () => this.imagePreview = reader.result;
                            reader.readAsDataURL(file);
                        } else {
                            this.imagePreview = '';
                            alert('Hanya format gambar diperbolehkan!');
                        }
                    }
                };
            }
        </script>
    </x-slot>
</x-app-layout>
