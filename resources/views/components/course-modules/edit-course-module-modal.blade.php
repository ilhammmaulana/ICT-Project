<button class="p-2"
    onclick="document.getElementById('{{ 'edit-module-modal' . str_replace('-', '_', $module->id) }}').showModal()">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="size-4">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
    </svg>
</button>
<dialog id="{{ 'edit-module-modal' . str_replace('-', '_', $module->id) }}" class="modal">
    <div class="modal-box w-11/12 max-w-3xl">
        {{-- <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form> --}}

        <h3 class="text-lg font-bold">Edit Module</h3>
        <form action="{{ route('admin.course-modules.update', $module) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="mt-5 mb-2 hidden">
                <label for="course_id" class="text-base block"></label>
                <input type="text" name="course_id" value="{{ $courseId }}" />
            </div>
            <div class="mt-5 mb-2">
                <label for="title" class="text-base block">Module Title</label>
                <input type="text" placeholder="Your module title" class="input input-bordered w-full max-full mt-2"
                    id="module-title-input" name="title" value="{{ $module->title }}" />
            </div>

            <div class="mt-5 mb-2">
                <label for="description" class="text-base block">Module Description</label>

                <textarea class="textarea textarea-bordered w-full mt-2" id="module-description-input" name="description"
                    placeholder="Your module description">{{ $module->description }}</textarea>
            </div>

            <div class="mt-5 mb-2" id="{{ 'linksEdit-preview' . str_replace('-', '_', $module->id) }}">
                <label for="description" class="text-base block">Links</label>

                <div class="hidden" id="{{ 'linksEdit' . str_replace('-', '_', $module->id) }}">
                    @foreach ($module->moduleContents as $content)
                        <input type="hidden" name="module_content_links[]" value="{{ $content->content }}">`;
                    @endforeach
                </div>
                <div class="{{ 'linksEdit-container' . str_replace('-', '_', $module->id) }}">
                    @foreach ($module->moduleContents as $content)
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                </svg>

                                <a href="{{ $content->content }}" target="_blank" rel="noopener noreferrer"
                                    class="link link-primary">{{ $content->content }}</a>
                            </div>

                            <button type="button" class="btn btn-circle"
                                onclick="deleteLinkEdit({{ $loop->index }}, '{{ str_replace('-', '_', $module->id) }}')">
                                X
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-between items-center gap-3 mt-5">
                <div>
                    <button class="btn btn-cricle"
                        onclick="document.getElementById('{{ 'add_new_course_module_link_edit' . str_replace('-', '_', $module->id) }}').showModal()"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                        </svg>
                    </button>


                    <dialog id="{{ 'add_new_course_module_link_edit' . str_replace('-', '_', $module->id) }}"
                        class="modal">
                        <div class="modal-box ">
                            <h3 class="text-base font-bold">Add Link</h3>
                            <div>
                                <div class="mt-5 mb-2">
                                    <label for="content_type" class="text-sm block" for="content_type">Link</label>
                                    <input type="text" class="input input-bordered w-full max-full mt-2 text-sm"
                                        id="module_content_link_input_edit{{ str_replace('-', '_', $module->id) }}"
                                        name="module_content_link" />
                                </div>

                                <div class="flex justify-end gap-3 mt-5 text-sm">
                                    <button class="btn" type="button"
                                        id="{{ 'create-link-close-btn_edit' . str_replace('-', '_', $module->id) }}"
                                        onclick="document.getElementById('{{ 'add_new_course_module_link_edit' . str_replace('-', '_', $module->id) }}').close()">Close</button>
                                    <button class="btn btn-active btn-primary text-white"
                                        id="{{ 'create-content-button-submit-btn-edit' . str_replace('-', '_', $module->id) }}"
                                        type="button"
                                        data-module-id ="{{ str_replace('-', '_', $module->id) }}">Submit</button>
                                </div>
                            </div>
                        </div>
                    </dialog>

                </div>

                <div class="flex gap-3 items-center">
                    <button class="btn" type="button"
                        onclick="document.getElementById('{{ 'edit-module-modal' . str_replace('-', '_', $module->id) }}').close()"">Close</button>
                    <button class="btn btn-active btn-primary text-white">Submit</button>
                </div>
            </div>
        </form>
    </div>
</dialog>

<script>
    window.contents = {};
    window.linksEdit = {};

    window.deleteLinkEdit = (index, moduleId) => {
        window.linksEdit[moduleId].splice(index, 1);
        window.renderLinkPreviewEdit(moduleId);
    };

    window.renderLinkPreviewEdit = (moduleId) => {
        const linksEditContainer = document.querySelector(
            `.linksEdit-container${moduleId}`
        );
        const linksEditHidden = document.getElementById(`linksEdit${moduleId}`);

        // Clear existing content before appending
        linksEditContainer.innerHTML = "";
        linksEditHidden.innerHTML = "";

        if (window.linksEdit[moduleId]) {
            window.linksEdit[moduleId].forEach((link, index) => {
                linksEditContainer.innerHTML += `
            <div class="flex items-center justify-between mb-2">
                <div class="flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                    </svg>
                    <a href="${link}" target="_blank" rel="noopener noreferrer" class="link link-primary">${link}</a>
                </div>
                <button class="btn btn-circle" onclick="window.deleteLinkEdit(${index}, '${moduleId}')" type="button">
                    X
                </button>
            </div>`;

                linksEditHidden.innerHTML +=
                    `<input type="hidden" name="module_content_links[]" value="${link}">`;
            });
        }
    };
</script>
<script>
    window.contents["{{ str_replace('-', '_', $module->id) }}"] = @json($contents);

    window.contents["{{ str_replace('-', '_', $module->id) }}"].forEach(content => {
            const moduleId = content.module_id.replace(/-/g, '_');
            window.linksEdit[moduleId] = [...window.linksEdit[moduleId] || [], content.content];
        }
    )

    document.getElementById('create-content-button-submit-btn-edit' +
        '{{ str_replace('-', '_', $module->id) }}').addEventListener('click', (event) => {
        const moduleId = event.target.getAttribute('data-module-id');
        const link = document.getElementById('module_content_link_input_edit' +
            '{{ str_replace('-', '_', $module->id) }}').value;

        if (link === '') {
            alert('Please enter a link');
            return;
        }

        window.contents["{{ str_replace('-', '_', $module->id) }}"] = @json($contents);


        if (!window.linksEdit[moduleId]) {
            window.contents["{{ str_replace('-', '_', $module->id) }}"].forEach(content => {
                    const moduleId = content.module_id.replace(/-/g, '_');
                    window.linksEdit[moduleId] = [...window.linksEdit[moduleId] || [], content.content];
                }
            )

            if (!window.linksEdit[moduleId]) {
                window.linksEdit[moduleId] = [];
            }

        }

        window.linksEdit[moduleId].push(link);
        document.getElementById('module_content_link_input_edit' +
            '{{ str_replace('-', '_', $module->id) }}').value = '';

        document.getElementById('create-link-close-btn_edit' +
            '{{ str_replace('-', '_', $module->id) }}').click();

        document.getElementById('linksEdit-preview' + moduleId).style.display = 'block';
        window.renderLinkPreviewEdit(moduleId);
    });
</script>
