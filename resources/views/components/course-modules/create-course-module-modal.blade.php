<button class="btn btn-primary btn-active" onclick="add_new_course_module_modal.showModal()">Add Module</button>
<dialog id="add_new_course_module_modal" class="modal">
    <div class="modal-box w-11/12 max-w-3xl">
        {{-- <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form> --}}

        <h3 class="text-lg font-bold">Add New Module</h3>
        <form action="{{ route('admin.course-modules.store') }}" method="POST">
            @method('POST')
            @csrf
            <div class="mt-5 mb-2 hidden">
                <label for="course_id" class="text-base block"></label>
                <input type="text" name="course_id" value="{{ $courseId }}" />
            </div>
            <div class="mt-5 mb-2">
                <label for="title" class="text-base block">Module Title</label>
                <input type="text" placeholder="Your module title" class="input input-bordered w-full max-full mt-2"
                    id="module-title-input" name="title" />
            </div>

            <div class="mt-5 mb-2">
                <label for="description" class="text-base block">Module Description</label>

                <textarea class="textarea textarea-bordered w-full mt-2" id="module-description-input" name="description"
                    placeholder="Your module description"></textarea>
            </div>

            <div class="mt-5 mb-2" id="links-preview" style="display: none">
                <label for="description" class="text-base block">Links</label>

                <div class="hidden" id="links"></div>
                <div class="links-container">

                </div>
            </div>
            <div class="flex justify-between items-center gap-3 mt-5">
                <div>
                    <button class="btn btn-cricle" onclick="add_new_course_module_link.showModal()" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                        </svg>
                    </button>

                    <dialog id="add_new_course_module_link" class="modal">
                        <div class="modal-box ">
                            <h3 class="text-base font-bold">Add Link</h3>
                            <div>
                                <div class="mt-5 mb-2">
                                    <label for="content_type" class="text-sm block" for="content_type">Link</label>
                                    <input type="text" placeholder=""
                                        class="input input-bordered w-full max-full mt-2 text-sm"
                                        id="module_content_link_input" />
                                </div>

                                <div class="flex justify-end gap-3 mt-5 text-sm">
                                    <button class="btn" type="button" id="create-link-close-btn"
                                        onclick="add_new_course_module_link.close()">Close</button>
                                    <button class="btn btn-active btn-primary" id="create-content-button-submit-btn"
                                        type="button">Submit</button>
                                </div>
                            </div>
                        </div>
                    </dialog>

                </div>

                <div class="flex gap-3 items-center">
                    <button class="btn" type="button" onclick="add_new_course_module_modal.close()">Close</button>
                    <button class="btn btn-active btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</dialog>

<script>
    const links = [];


    const deleteLink  = (index) => {
        links.splice(index, 1);
        renderLinkPreview();
    }
    
    const renderLinkPreview = () => {
        const linksContainer = document.querySelector('.links-container');
        linksContainer.innerHTML = '';
        links.forEach(link => {
            linksContainer.innerHTML += `
                <div class="flex items-center justify-between">
                    <div class="flex gap-2 items-center" >
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                        </svg>

                    <a href="${link}" target="_blank" rel="noopener noreferrer" class="link link-primary">${link}</a>
                  </div>

                    <button class="btn btn-circle" onclick="deleteLink(${links.indexOf(link)})">
                        X
                    </button>
                </div>
            `
        })

        const links_hidden = document.getElementById("links");

        links.forEach(link => {
            links_hidden.innerHTML += `<input type="hidden" name="module_content_links[]" value="${link}">`
        })
    }



    const inputLink = document.getElementById('module_content_link_input');
    const submitLink = document.getElementById('create-content-button-submit-btn');
    const closeInputLink = document.getElementById('create-link-close-btn');


    submitLink.addEventListener('click', () => {
        const link = inputLink.value;
        if (link === '') {
            alert('Please enter a link');
            return;
        }
        links.push(link);
        inputLink.value = '';
        closeInputLink.click();

        
        document.getElementById('links-preview').style.display = 'block';
        renderLinkPreview();
        
    })
</script>
