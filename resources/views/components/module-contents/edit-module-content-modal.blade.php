<button class="btn btn-primary btn-active" onclick="edit_module_content_modal.showModal()">Edit</button>
<dialog id="edit_module_content_modal" class="modal">
    <div class="modal-box w-11/12 max-w-xl">
        <h3 class="text-lg font-bold">Add New Module Content</h3>
        <form action="{{ route('admin.module-contents.store') }}" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="mt-5 mb-2 hidden">
                <label for="module_id" class="text-base block"></label>
                <input type="text" name="module_id" required value="{{ $moduleId }}" />
            </div>
            <div class="mt-5 mb-2">
                <label for="content_type" class="text-base block" for="content_type">Content Type</label>
                <select name="content_type" class="select select-bordered w-full mt-2" id="content_type">
                    <option value="FILE" selected>File</option>
                    <option value="LINK">Link</option>
                </select>
            </div>
            <div class="mt-5 mb-2" id="file-input-container">
                <label for="files" class="text-base block">Content</label>
                <input type="file" class="file-input file-input-bordered w-full mt-2" id="content_input"
                    name="files" multiple />
                <div id="file-input-preview" class="mt-3"></div>
            </div>
            <div class="mt-5 mb-2" id="link-input-container" style="display: none;">
                <label for="links" class="text-base block">Content</label>
                <textarea name="links" class="textarea textarea-bordered w-full mt-2" rows="5"></textarea>
            </div>

            <div class="flex justify-end gap-3 mt-5">
                <button class="btn" type="button" id="create-content-button-close-btn">Close</button>
                <button class="btn btn-active btn-primary">Submit</button>
            </div>
        </form>
    </div>
</dialog>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const contentTypeSelect = document.getElementById('content_type');
        const fileInputContainer = document.getElementById('file-input-container');
        const linkInputContainer = document.getElementById('link-input-container');
        const fileInput = document.getElementById('content_input');
        const fileInputPreview = document.getElementById('file-input-preview');

        const fileTypes = {
            image: ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
            pdf: ['pdf'],
            word: ['doc', 'docx'],
            excel: ['xls', 'xlsx'],
            powerpoint: ['ppt', 'pptx'],
            text: ['txt'],
            zip: ['zip', 'rar']
        };

        const fileTypeIcons = {
            pdf: '📄',
            word: '📄',
            excel: '📊',
            powerpoint: '📊',
            text: '📄',
            zip: '🗜️'
        };

        function toggleContentInput() {
            if (contentTypeSelect.value === 'FILE') {
                fileInputContainer.style.display = 'block';
                linkInputContainer.style.display = 'none';
            } else {
                fileInputContainer.style.display = 'none';
                linkInputContainer.style.display = 'block';
            }
        }

        // Add event listener for changes on the select element
        contentTypeSelect.addEventListener('change', toggleContentInput);

        // Add event listener for file input change
        fileInput.addEventListener('change', function() {
            fileInputPreview.innerHTML = ''; // Clear previous previews

            Array.from(fileInput.files).forEach(file => {
                const fileName = file.name;
                const fileExt = fileName.split('.').pop().toLowerCase();
                const isImage = fileTypes.image.includes(fileExt);

                const previewElement = document.createElement('div');
                previewElement.className = 'flex items-center mb-3';

                if (isImage) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = fileName;
                        img.style.width = '50px';
                        img.style.height = '50px';
                        img.style.objectFit = 'cover';
                        img.classList.add('mr-2');

                        previewElement.appendChild(img);
                        previewElement.innerHTML += `<span>${fileName}</span>`;
                    };
                    reader.readAsDataURL(file);
                } else {
                    const fileTypeIcon = Object.keys(fileTypeIcons).find(type => fileTypes[type]
                        .includes(fileExt));

                    // Only add icon if file type is recognized
                    if (fileTypeIcon) {
                        previewElement.innerHTML = `
                            <span class="mr-2" style="font-size: 24px;">${fileTypeIcons[fileTypeIcon]}</span>
                            <span>${fileName}</span>
                        `;
                    } else {
                        // Just show the filename if file type is not recognized
                        previewElement.innerHTML = `<span>${fileName}</span>`;
                    }
                }

                fileInputPreview.appendChild(previewElement);
            });
        });

        toggleContentInput();


        function resetModalState() {
            contentTypeSelect.value = 'FILE';
            toggleContentInput();
            fileInput.value = '';
            fileInputPreview.innerHTML = '';
            document.querySelector('textarea[name="content"]').value = '';
        }

        document.getElementById("create-content-button-close-btn").addEventListener("click", function() {
            document.getElementById("edit_new_module_content_modal").close(         resetModalState();
        })
    });
</script>
