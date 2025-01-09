@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Edit Kelas')

@section('content')
<div class="container-fluid px-2 px-sm-5 mt-5">
    <div class="row ">
        @include('components.includes.admin.sidebar')
        <div class="col-12 col-lg-9 ps-xl-3 d-flex flex-column justify-content-center">
            <div class="table-responsive shadow-lg rounded-3 p-5 w-100" style="background-color: #ffffff;">
            <div class="d-flex justify-content-between mb-3">
                <h2 class="fw-bolder">Edit Data</h2>
                <a href="{{ route('admin.course') }}" class="btn btn-orange"> Kembali </a>
            </div>
        <div>
            <form id="formAction" action="{{ route('admin.course.edit.update', $course->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <label for="category">Kategori<span class="required-field"></span></label>
                            <select id="category" name="category" class="form-select">
                                <option value="UI/UX Designer"  {{ "UI/UX Designer" == $course->category ? 'selected' : '' }}>UI/UX Designer</option>
                                <option value="Frontend Developer" {{ "Frontend Developer" == $course->category ? 'selected' : '' }}>Frontend Developer</option>
                                <option value="Backend Developer" {{ "Backend Developer" == $course->category ? 'selected' : '' }}>Backend Developer</option>
                                <option value="Wordpress Developer" {{ "Wordpress Developer" == $course->category ? 'selected' : '' }}>Wordpress Developer</option>
                                <option value="Graphics Designer" {{ "Graphics Designer" == $course->category ? 'selected' : '' }}>Graphics Designer</option>
                                <option value="Fullstack Developer" {{ "Fullstack Developer" == $course->category ? 'selected' : '' }}>Fullstack Developer</option>
                            </select>
                            @error('category')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="name">Judul<span class="required-field"></span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder=""
                                value="{{ $course->name }}" />
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div>
                            <label for="description">Deskripsi<span class="required-field"></span></label>
                            <textarea id="description" name="description" placeholder="" class="form-control" style="height: 110px">{{ $course->description }}</textarea>
                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="status">Status<span class="required-field"></span></label>
                            <select id="status" name="status" class="form-select">
                                <option value="draft" {{ $course->status == 'draft' ? 'selected' : '' }}>Draf</option>
                                <option value="published" {{ $course->status == 'published' ? 'selected' : '' }}>Publik
                                </option>
                            </select>
                            @error('status')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="type">Tipe<span class="required-field"></span></label>
                            <select id="type" name="type" class="form-select">
                                <option value="free" {{ $course->type == 'free' ? 'selected' : '' }}>Gratis</option>
                                <option value="premium" {{ $course->type == 'premium' ? 'selected' : '' }}>Berbayar
                                </option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 {{ $course->type == 'free' ? 'd-none' : 'd-block' }}" id="price">
                        <div>
                            <label for="price">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder=""
                                value="{{ $course->price }}" />
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">Cover Kelas</label>
                        <div class="cover-input">
                            <input type="file" id="" name="cover" accept="image/*" class="form-control" hidden/>
                            <svg width="150" height="150" viewBox="0 0 120 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 27.1279C0 23.4812 1.4311 19.9838 3.97847 17.4052C6.52583 14.8266 9.98081 13.3779 13.5833 13.3779H67.9167C69.7178 13.3783 71.445 14.1029 72.7184 15.3923L106.677 49.7673C107.95 51.0563 108.666 52.8047 108.667 54.6279V137.128C108.667 140.775 107.236 144.272 104.688 146.851C102.141 149.429 98.6858 150.878 95.0833 150.878H13.5833C9.98081 150.878 6.52583 149.429 3.97847 146.851C1.4311 144.272 0 140.775 0 137.128V27.1279ZM92.2716 54.6279L67.9167 29.9742V54.6279H92.2716ZM54.3333 27.1279H13.5833V137.128H95.0833V68.3779H61.125C59.3237 68.3779 57.5962 67.6536 56.3226 66.3643C55.0489 65.075 54.3333 63.3263 54.3333 61.5029V27.1279ZM27.1667 89.0029C27.1667 87.1796 27.8822 85.4309 29.1559 84.1416C30.4296 82.8523 32.1571 82.1279 33.9583 82.1279H74.7083C76.5096 82.1279 78.2371 82.8523 79.5108 84.1416C80.7844 85.4309 81.5 87.1796 81.5 89.0029C81.5 90.8263 80.7844 92.575 79.5108 93.8643C78.2371 95.1536 76.5096 95.8779 74.7083 95.8779H33.9583C32.1571 95.8779 30.4296 95.1536 29.1559 93.8643C27.8822 92.575 27.1667 90.8263 27.1667 89.0029ZM27.1667 116.503C27.1667 114.68 27.8822 112.931 29.1559 111.642C30.4296 110.352 32.1571 109.628 33.9583 109.628H74.7083C76.5096 109.628 78.2371 110.352 79.5108 111.642C80.7844 112.931 81.5 114.68 81.5 116.503C81.5 118.326 80.7844 120.075 79.5108 121.364C78.2371 122.654 76.5096 123.378 74.7083 123.378H33.9583C32.1571 123.378 30.4296 122.654 29.1559 121.364C27.8822 120.075 27.1667 118.326 27.1667 116.503Z" fill="black" fill-opacity="0.26"/>
                                <path d="M104.507 149C101.535 149 98.7404 148.371 96.1222 147.112C93.5055 145.852 91.2289 144.141 89.2923 141.981C87.3557 139.821 85.8229 137.283 84.6937 134.365C83.5646 131.448 83 128.329 83 125.008C83 121.687 83.5646 118.567 84.6937 115.648C85.8213 112.727 87.351 110.186 89.2828 108.024C91.2146 105.862 93.4896 104.151 96.1078 102.891C98.7261 101.63 101.521 101 104.493 101C107.465 101 110.26 101.63 112.878 102.891C115.494 104.149 117.771 105.858 119.708 108.016C121.644 110.174 123.177 112.714 124.306 115.635C125.435 118.556 126 121.675 126 124.992C126 128.309 125.436 131.429 124.309 134.352C123.181 137.275 121.649 139.816 119.712 141.976C117.776 144.136 115.502 145.847 112.89 147.109C110.278 148.372 107.484 149.002 104.507 149Z" fill="#414142" fill-opacity="0.84"/>
                                <g clip-path="url(#clip0_900_6399)">
                                <path d="M106.507 111.677C105.93 111.243 105.149 111 104.335 111C103.52 111 102.739 111.243 102.163 111.677L90.5675 120.399C89.9909 120.833 89.667 121.422 89.667 122.036C89.667 122.649 89.9909 123.238 90.5675 123.672C91.1441 124.106 91.9261 124.35 92.7415 124.35C93.5569 124.35 94.3389 124.106 94.9155 123.672L101.261 118.897V136.687C101.261 137.3 101.585 137.889 102.161 138.322C102.738 138.756 103.52 139 104.335 139C105.15 139 105.932 138.756 106.508 138.322C107.084 137.889 107.408 137.3 107.408 136.687V118.897L113.752 123.672C114.037 123.887 114.376 124.057 114.749 124.174C115.122 124.29 115.522 124.35 115.926 124.35C116.33 124.35 116.729 124.29 117.102 124.174C117.475 124.057 117.814 123.887 118.1 123.672C118.385 123.457 118.612 123.202 118.766 122.921C118.921 122.64 119 122.34 119 122.036C119 121.732 118.921 121.431 118.766 121.15C118.612 120.869 118.385 120.614 118.1 120.399L106.507 111.677Z" fill="white"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_900_6399">
                                <rect width="36" height="31" fill="white" transform="translate(87 108)"/>
                                </clipPath>
                                </defs>
                                </svg>
                            <p class="mb-0">Maximum file zize 10 mb</p>
                            <p>Format file : PNG/ JPG/ PDF</p>
                            <button type="button" class="btn btn-primary" id="upload-btn" style="background: 0; border: 1px solid #BDBDBD; color: #414242" >Unggah</button>                                    
                        </div>
                    </div>
                    {{-- <div class="col-6 mb-3">
                        <p class="m-0">Cover Kelas</p>
                        <input type="file" id="imageUpload" name="cover" accept="image/*" class="" />
                        @error('cover')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="col-md-12">
                        <div>
                            <label for="tools">Pilih Tools<span class="required-field"></span></label>
                            <button type="button" id="add-tools-btn" class="btn btn-primary" style="background: 0; border: 1px solid #BDBDBD; color: #414242">Tambah Tools</button>
                        </div>
                        <div id="selected-tools" class="col-12 d-flex align-items-center mb-3">
                        </div>
    
                        <input type="hidden" name="tools[]" id="selected-tools-input">
    
                        <div id="tools-popup" class="tools-popup" style="display: none;">
                            <div>
                                <input type="text" id="tool-search" class="form-control" placeholder="Cari tools">
                            </div>
    
                            <div id="tools-grid" class="row">
                                @foreach ($tools as $toolall)
                                    <div class="col-12 tool-item d-flex align-items-center mb-2"
                                        data-tool-name="{{ strtolower($toolall->name_tools) }}"
                                        data-tool-id="{{ $toolall->id }}">
                                        <input class="form-check-input tool-checkbox me-2" type="checkbox"
                                            value="{{ $toolall->id }}" id="tool-{{ $toolall->id }}" />
                                        <label class="form-check-label" for="tool-{{ $toolall->id }}">
                                            {{ $toolall->name_tools }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @error('tools')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="col-md-6">
                        <div>
                            <label for="resources">Asset</label>
                            <input type="text" id="resources" class="form-control"
                                value = "{{ $course->resources != 'null' ? $course->resources : '' }}" name="resources"
                                placeholder="" />
                            <div class="labelline" for="link">Asset</div>
                            @error('resources')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="link_grub">Link Grup Kursus<span class="required-field"></span></label>
                            <input type="text" id="link_grub" name="link_grub" class="form-control" value="{{ $course->link_grub }}"
                                placeholder="" />
                            @error('link_grub')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div>
                            <label for="level">Level<span class="required-field"></span></label>
                            <select class="form-select" id="level" name="level">
                                <option value="beginner" {{ $course->level == 'beginner' ? 'selected' : '' }}>Pemula
                                </option>
                                <option value="intermediate" {{ $course->level == 'intermediate' ? 'selected' : '' }}>
                                    Menengah</option>
                                <option value="expert" {{ $course->level == 'expert' ? 'selected' : '' }}>Ahli</option>
                            </select>
                            @error('level')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-orange w-100 py-2" >Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

    @endsection

@push('addon-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const type = document.getElementById('type');
            const price = document.getElementById('price');
            const form = document.querySelector('form');
            const toolsPopup = document.getElementById('tools-popup');
            const addToolsBtn = document.getElementById('add-tools-btn');
            toolsGrid = document.getElementById('tools-grid'); 
            const toolSearch = document.getElementById('tool-search');
            selectedToolsContainer = document.getElementById('selected-tools'); 
            const imageUpload = document.getElementById('imageUpload');
            const inputContainer = imageUpload.parentNode;
            inputContainer.className = 'image-upload-container';

            const leftSide = document.createElement('div');
            leftSide.className = 'image-upload-left';
            const rightSide = document.createElement('div');
            rightSide.className = 'image-upload-right';

            const existingElements = [...inputContainer.children];
            existingElements.forEach(el => leftSide.appendChild(el));

            const previewContainer = document.createElement('div');
            previewContainer.className = 'image-preview-container';

            rightSide.appendChild(previewContainer);

            inputContainer.appendChild(leftSide);
            inputContainer.appendChild(rightSide);

            // Function to handle file preview
            function handleFilePreview(file, imageUrl = null) {
                previewContainer.innerHTML = '';
                
                const img = document.createElement('img');
                if (imageUrl) {
                    img.src = imageUrl;
                } else if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }

                const removeButton = document.createElement('button');
                removeButton.textContent = 'Hapus';
                removeButton.className = 'btn btn-danger btn-sm';
                removeButton.onclick = function(e) {
                    e.preventDefault();
                    previewContainer.innerHTML = '';
                    imageUpload.value = '';
                };

                previewContainer.appendChild(img);
                previewContainer.appendChild(removeButton);
            }

            imageUpload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (!file.type.startsWith('image/')) {
                        alert('Please upload an image file');
                        e.target.value = '';
                        return;
                    }
                    handleFilePreview(file);
                }
            });

            updateSelectedToolsInput = () => {
                const selectedToolIds = Array.from(selectedToolsContainer.querySelectorAll('.selected-tool'))
                    .map(selectedTool => selectedTool.dataset.toolId);
                
                const existingInputs = document.querySelectorAll('input[name="tools[]"]');
                existingInputs.forEach(input => input.remove());

                selectedToolIds.forEach(toolId => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'tools[]';
                    input.value = toolId;
                    form.appendChild(input);
                });
            };

            var valuePrice = 0;

            if (type.value == 'premium') {
                price.classList.replace('d-none', 'd-block');
                valuePrice = document.querySelector('input[name="price"]').value
            } else {
                price.classList.replace('d-block', 'd-none');
                price.querySelector('input[name="price"]').value = '0';
            }

            type.addEventListener('change', (e) => {
                if (e.target.value == 'premium') {
                    price.classList.replace('d-none', 'd-block');
                    price.querySelector('input[name="price"]').value = valuePrice
                } else if (e.target.value == 'free') {
                    price.classList.replace('d-block', 'd-none');
                    price.querySelector('input[name="price"]').value = '0';
                }
            });

            form.addEventListener('submit', function(e) {
                if (toolsPopup.style.display === 'block') {
                    e.preventDefault();
                }
            });

            addToolsBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                toolsPopup.style.display = 'block';
            });

            document.addEventListener('click', (e) => {
                if (!toolsPopup.contains(e.target) && 
                    e.target.id !== 'add-tools-btn' && 
                    !e.target.classList.contains('remove-tool-btn')) {
                    toolsPopup.style.display = 'none';
                }
            });

            toolsPopup.addEventListener('click', (e) => {
                e.stopPropagation();
            });

            toolsGrid.addEventListener('change', (e) => {
                if (e.target.classList.contains('tool-checkbox')) {
                    const toolItem = e.target.closest('.tool-item');
                    const toolId = e.target.value;
                    const toolName = toolItem.dataset.toolName;

                    if (e.target.checked) {
                        toolItem.style.display = 'none';

                        const selectedTool = document.createElement('div');
                        selectedTool.classList.add('selected-tool', 'd-flex', 'align-items-center', 'ms-2', 'mb-2');
                        selectedTool.dataset.toolId = toolId;
                        selectedTool.innerHTML = `
                            <span class="me-2">${toolName}</span>
                            <button type="button" class="btn btn-danger btn-sm remove-tool-btn" data-tool-id="${toolId}">
                                X
                            </button>
                        `;

                        selectedToolsContainer.appendChild(selectedTool);
                        updateSelectedToolsInput();
                    } else {
                        const removeButton = selectedToolsContainer.querySelector(`.remove-tool-btn[data-tool-id="${toolId}"]`);
                        if (removeButton) {
                            removeButton.click();
                        }
                    }
                }
            });

            selectedToolsContainer.addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-tool-btn')) {
                    const toolId = e.target.dataset.toolId;
                    const toolItem = toolsGrid.querySelector(`.tool-item[data-tool-id="${toolId}"]`);
                    const selectedTool = e.target.closest('.selected-tool');
                    
                    if (toolItem) {
                        const toolCheckbox = toolItem.querySelector(`input[value="${toolId}"]`);
                        if (toolCheckbox) {
                            toolCheckbox.checked = false;
                        }
                        toolItem.style.display = '';
                    }
                    
                    selectedTool.remove();
                    updateSelectedToolsInput();
                }
            });

            toolSearch.addEventListener('input', () => {
                const query = toolSearch.value.trim().toLowerCase();
                console.log('Searching for:', query);

                toolsGrid.querySelectorAll('.tool-item').forEach((toolItem) => {
                    const toolName = toolItem.dataset.toolName.toLowerCase();
                    const checkbox = toolItem.querySelector('.tool-checkbox');
                    
                    if (query === '') {
                        toolItem.setAttribute("style","")
                    } else {
                        toolItem.setAttribute("style",toolName.includes(query) ?"": "display:none !important")
                    }
                    
                    console.log(`Tool: ${toolName}, Query: ${query}, Visible: ${toolItem.style.display === ''}`);
                });
            });
        });
    </script>

@if($course->cover)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageUpload = document.getElementById('imageUpload');
            const previewContainer = document.querySelector('.image-preview-container');

            // Get original filename and extension
            const originalFileName = "{{ basename($course->cover) }}".substring(10);
            const extension = originalFileName.split('.').pop().toLowerCase();
            
            // Fetch the existing image
            fetch("{{ url('storage/images/covers/' . $course->cover) }}")
                .then(response => response.blob())
                .then(blob => {
                    // Create proper mime type based on extension
                    let mimeType;
                    switch(extension) {
                        case 'jpg':
                        case 'jpeg':
                            mimeType = 'image/jpeg';
                            break;
                        case 'png':
                            mimeType = 'image/png';
                            break;
                        case 'gif':
                            mimeType = 'image/gif';
                            break;
                        default:
                            mimeType = 'image/jpeg';
                    }

                    // Create a File object with proper mime type
                    const file = new File([blob], originalFileName, { type: mimeType });
                    
                    // Set the file input value
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    imageUpload.files = dataTransfer.files;
                    
                    // Create and display preview
                    const img = document.createElement('img');
                    img.src = "{{ url('storage/images/covers/' . $course->cover) }}";
                    
                    const removeButton = document.createElement('button');
                    removeButton.textContent = 'Hapus';
                    removeButton.className = 'btn btn-danger btn-sm';
                    removeButton.onclick = function(e) {
                        e.preventDefault();
                        previewContainer.innerHTML = '';
                        imageUpload.value = '';
                    };

                    previewContainer.innerHTML = '';
                    previewContainer.appendChild(img);
                    previewContainer.appendChild(removeButton);
                })
                .catch(error => {
                    console.error('Error loading existing image:', error);
                });
        });
    </script>
@endif

@if(isset($course->tools) && $course->tools->count() > 0)
    @foreach($course->tools as $tool)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toolItem = toolsGrid.querySelector(`.tool-item[data-tool-id="{{ $tool->id }}"]`);
            if (toolItem) {
                const checkbox = toolItem.querySelector('.tool-checkbox');
                checkbox.checked = true;
                toolItem.style.display = 'none';

                const selectedTool = document.createElement('div');
                selectedTool.classList.add('selected-tool', 'd-flex', 'align-items-center', 'ms-2', 'mb-2');
                selectedTool.dataset.toolId = "{{ $tool->id }}";
                selectedTool.innerHTML = `
                    <span class="me-2">{{ $tool->name_tools }}</span>
                    <button type="button" class="btn btn-danger btn-sm remove-tool-btn" data-tool-id="{{ $tool->id }}">
                        X
                    </button>
                `;
                selectedToolsContainer.appendChild(selectedTool);
            }
        });
    </script>    
    @endforeach
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateSelectedToolsInput();
        });
    </script>
@endif
@endpush
