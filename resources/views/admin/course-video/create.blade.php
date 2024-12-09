@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Tambah Kelas')

@section('content')
    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Tambah Data</h2>
            <a href="{{ route('admin.course') }}" class="btn btn-orange"> Kembali </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" id="formAction" action="{{ route('admin.course.create.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="category" name="category">
                                <div class="mb-3">
                                    <option value="UI/UX Designer">UI/UX Designer</option>
                                    <option value="Frontend Developer">Frontend Developer</option>
                                    <option value="Backend Developer">Backend Developer</option>
                                    <option value="Wordpress Developer">Wordpress Developer</option>
                                    <option value="Graphics Designer">Graphics Designer</option>
                                    <option value="Fullstack Developer">Fullstack Developer</option>
                                    @error('category')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </select>
                            @error('category')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" id="name" name="name" placeholder=""
                                value="{{ old('name') }}" />
                            <div class="labelline" for="name">Judul<span class="required-field"></span></div>
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="entryarea">
                            <textarea id="description" name="description" placeholder="" style="height: 173px">{{ old('description') }}</textarea>
                            <div class="labelline-textarea" for="desc">Deskripsi<span class="required-field"></span>
                            </div>
                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="category" name="status">
                                <option value="draft">Draf</option>
                                <option value="published">Publik</option>
                            </select>
                            @error('status')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="type" name="type">
                                <option value="free" class="value_type">Gratis</option>
                                <option value="premium" class="value_type">Berbayar</option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mt-4 d-none" id="price">
                        <div class="entryarea">
                            <input type="number" id="name" name="price" placeholder="" value="0" />
                            <div class="labelline" for="link">Harga</div>
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <p class="m-0">Cover Kelas</p>
                        <input type="file" id="imageUpload" name="cover" accept="image/*" class="" />
                        @error('cover')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 d-block mb-3">
                        @if ($tools->isNotEmpty())
                            <div class="d-flex align-items-center">
                                <p class="m-0 mb-1 mt-3">Pilih Tools</p>
                                <button type="button" class="btn btn-link text-primary p-0 ms-3" id="add-tools-btn">Tambah
                                    Tools</button>
                            </div>
                            <div id="selected-tools" class="col-12 d-flex align-items-center mb-3">
                                <!-- Default: no tools displayed here -->
                            </div>

                            <!-- Hidden input to store selected tools -->
                            <input type="hidden" name="tools[]" id="selected-tools-input">

                            <!-- Popup Tambah Tools -->
                            <div id="tools-popup" class="tools-popup shadow p-3 bg-white rounded"
                                style="display: none; position: absolute; top: 50px; right: 20px; width: 300px; z-index: 1050;">
                                <!-- Search bar -->
                                <div class="mb-3">
                                    <input type="text" id="tool-search" class="form-control" placeholder="Cari tools">
                                </div>

                                <!-- Grid tools -->
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
                            @error('tools')
                                <p class="m-0 text-danger d-block mb-3">
                                    {{ $message }}
                                </p>
                            @enderror
                        @else
                            <p class="m-0 text-danger">
                                @if ($errors->has('tools'))
                                    {{ $errors->first('tools') }}
                                @else
                                    Maaf Tools Course Belum Tersedia, Silahkan Untuk Buat Alat Terlebih Dahulu
                                @endif
                            </p>
                        @endif
                    </div>
                    <div class="col-6 mt-2">
                        <div class="entryarea">
                            <input type="text" id="name" name="resources" placeholder=""
                                {{ old('resources') }} />
                            <div class="labelline" for="link">Asset</div>
                            @error('resources')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mt-2">
                        <div class="entryarea">
                            <input type="text" id="name" name="link_grub" placeholder="" />
                            <div class="labelline" for="link">Link Grup Kursus<span class="required-field"></span>
                            </div>
                            @error('link_grub')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="custom-entryarea">
                            <select id="category" name="level">
                                <option value="beginner">Pemula</option>
                                <option value="intermediate">Menengah</option>
                                <option value="expert">Ahli</option>
                            </select>
                            @error('level')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit"
                            class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                            style="background-color: #faa907">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        const type = document.getElementById('type');
        const price = document.getElementById('price');
        const form = document.querySelector('form');
        const toolsPopup = document.getElementById('tools-popup');
        const addToolsBtn = document.getElementById('add-tools-btn');
        const toolsGrid = document.getElementById('tools-grid');
        const toolSearch = document.getElementById('tool-search');
        const searchToolsBtn = document.getElementById('search-tools-btn');
        const selectedToolsContainer = document.getElementById('selected-tools');

        type.addEventListener('change', (e) => {
            if (e.target.value == 'premium') {
                price.classList.replace('d-none', 'd-block');
            } else if (e.target.value == 'free') {
                price.classList.replace('d-block', 'd-none');
                price.querySelector('input[name="price"]').value = '0';
            }
        });

        // Prevent form submission when interacting with the tools popup
        form.addEventListener('submit', function (e) {
                if (toolsPopup.style.display === 'block') {
                    e.preventDefault();
                }
            });

            // Show popup when "Tambah Tools" button is clicked
            addToolsBtn.addEventListener('click', (e) => {
                e.preventDefault(); // Prevent default button action
                toolsPopup.style.display = 'block'; // Show popup
            });
            
            // Open popup when "Tambah Tools" button is clicked
            addToolsBtn.addEventListener('click', (e) => {
                e.stopPropagation(); // Prevent triggering document click event
                toolsPopup.style.display = 'block'; // Show popup
            });

            // Close popup only if clicking outside both popup and "Tambah Tools" button
            document.addEventListener('click', (e) => {
                if (!toolsPopup.contains(e.target) && 
                    e.target.id !== 'add-tools-btn' && 
                    !e.target.classList.contains('remove-tool-btn')) {
                    toolsPopup.style.display = 'none';
                }
            });

            // Prevent popup from closing when clicking inside it
            toolsPopup.addEventListener('click', (e) => {
                e.stopPropagation(); // Prevent triggering document click event
            });

            // Add tool to selected tools when checkbox is checked
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
                        // Find and trigger the corresponding remove button
                        const removeButton = selectedToolsContainer.querySelector(`.remove-tool-btn[data-tool-id="${toolId}"]`);
                        if (removeButton) {
                            removeButton.click();
                        }
                    }
                }
            });

            const updateSelectedToolsInput = () => {
                const selectedToolIds = Array.from(selectedToolsContainer.querySelectorAll('.selected-tool'))
                    .map(selectedTool => selectedTool.dataset.toolId);

                document.getElementById('selected-tools-input').value = selectedToolIds.join(',');
            };

            // Remove tool from selected tools and add it back to popup when "X" is clicked
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

            // Filter tools based on search query
            toolSearch.addEventListener('input', () => {
            const query = toolSearch.value.trim().toLowerCase();
            console.log('Searching for:', query);

            toolsGrid.querySelectorAll('.tool-item').forEach((toolItem) => {
                const toolName = toolItem.dataset.toolName.toLowerCase();
                const checkbox = toolItem.querySelector('.tool-checkbox');
                
                if (query === '') {
                    // If search is empty, show all items except checked ones
                    toolItem.setAttribute("style","")
                } else {
                    // During search, show/hide based on match, regardless of checked status
                    toolItem.setAttribute("style",toolName.includes(query) ?"": "display:none !important")
                }
                
                console.log(`Tool: ${toolName}, Query: ${query}, Visible: ${toolItem.style.display === ''}`);
            });
        });
    </script>
@endpush
