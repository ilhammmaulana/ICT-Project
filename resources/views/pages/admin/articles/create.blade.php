<x-app-layout>
    <x-slot name="head">
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Manage Article') }}
            </h2>
        </div>
    </x-slot>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 px-4 py-4 rounded-lg" x-data="formData()">
        <form action="" class="grid grid-cols-2 gap-6 mb-3">
            <!-- Thumbnail Image -->
            <div class="form-group">
                <div class="space-y-2">
                    <x-form.label for="image" :value="__('Thumbnail Image')" />
                    <x-form.input-file id="image" name="image" x-on:change="previewImage" />
                    <x-form.error :messages="$errors->get('image')" />
                </div>
            </div>
            <div x-show="imagePreview" class="mt-2">
                <label class="block text-sm text-gray-600">Image Preview:</label>
                <img :src="imagePreview" class="w-32 h-32 object-cover rounded-md" />
            </div>
        </form>
        <div class="grid grid-cols-2 gap-4">
            <div class="form-group">
                <div class="space-y-2">
                    <x-form.label for="title" :value="__('Title')" />
                    <x-form.input id="title" name="title" type="text" x-model="title" x-on:input="generateSlug"
                        required autofocus autocomplete="title" placeholder="Masukkan Judul" />
                    <x-form.error :messages="$errors->get('title')" />
                </div>
            </div>

            <!-- Slug -->
            <div class="form-group">
                <div class="space-y-2">
                    <x-form.label for="slug" :value="__('Slug')" />
                    <x-form.input id="slug" name="slug" type="text" x-model="slug" readonly
                        placeholder="Slug otomatis diisi" disabled />
                    <x-form.error :messages="$errors->get('slug')" />
                </div>
            </div>

            <!-- Rich Text Editor -->
            <div class="form-group col-span-1 md:col-span-2">
                <label for="content" class="block text-gray-700 font-medium mb-2">Content</label>
                <input id="content" type="hidden" name="content">
                <trix-editor input="content"
                    class="border rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600"></trix-editor>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Update hidden input with Trix Editor content on change
                document.addEventListener('trix-change', function(event) {
                    const content = document.querySelector('trix-editor').editor.getDocument().toString();
                    document.getElementById('content').value = content;
                });
            });

            // Alpine.js component for managing form data and logic
            function formData() {
                return {
                    title: '', // Title input value
                    slug: '', // Slug value
                    imagePreview: '', // Image preview URL
                    allowedFormats: ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'], // Allowed image formats

                    // Function to generate slug from title
                    generateSlug() {
                        this.slug = this.title
                            .toLowerCase() // Convert to lowercase
                            .replace(/\s+/g, '-') // Replace spaces with hyphens
                            .replace(/[^a-z0-9-]/g, '') // Remove non-alphanumeric characters
                            .replace(/-+/g, '-') // Replace multiple hyphens with a single one
                            .replace(/^-|-$/g, ''); // Trim hyphens from the start and end
                    },

                    // Function to preview selected image
                    previewImage(event) {
                        const file = event.target.files[0];

                        // Check if the file format is valid
                        if (file && this.allowedFormats.includes(file.type)) {
                            const reader = new FileReader();
                            reader.onload = () => {
                                this.imagePreview = reader.result;
                            };
                            reader.readAsDataURL(file);
                        } else {
                            // Reset the image preview and alert the user if the file is invalid
                            this.imagePreview = '';
                            alert('Hanya format PNG, JPG, JPEG, atau WebP yang diperbolehkan.');
                        }
                    }
                };
            }
        </script>
    </x-slot>
</x-app-layout>
