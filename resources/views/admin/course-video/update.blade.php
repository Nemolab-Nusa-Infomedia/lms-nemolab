@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Edit Kelas')

@section('content')

    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Edit Data</h2>
            <a href="{{ route('admin.course') }}" class="btn btn-orange"> Kembali </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" action="{{ route('admin.course.edit.update', $course->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="category" name="category">
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
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" id="name" name="name" placeholder=""
                                value="{{ $course->name }}" />
                            <div class="labelline" for="name">Judul<span class="required-field"></span></div>
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="entryarea">
                            <textarea id="description" name="description" placeholder="" style="height: 173px">{{ $course->description }}</textarea>
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
                                <option value="draft" {{ $course->status == 'draft' ? 'selected' : '' }}>Draf</option>
                                <option value="published" {{ $course->status == 'published' ? 'selected' : '' }}>Publik
                                </option>
                            </select>
                            @error('status')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="type" name="type">
                                <option value="free" {{ $course->type == 'free' ? 'selected' : '' }}>Gratis</option>
                                <option value="premium" {{ $course->type == 'premium' ? 'selected' : '' }}>Berbayar
                                </option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mt-4 {{ $course->type == 'free' ? 'd-none' : 'd-block' }}" id="price">
                        <div class="entryarea">
                            <input type="number" id="name" name="price" placeholder=""
                                value="{{ $course->price }}" />
                            <div class="labelline" for="link">Harga</span></div>
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
                    <div class="d-flex align-items-center">
                        <p class="m-0 mb-1 mt-3">Pilih Tools</p>
                        <button type="button" class="btn btn-link text-primary p-0 ms-3" id="add-tools-btn">Tambah Tools</button>
                    </div>
                    <div id="selected-tools" class="col-12 d-flex align-items-center mb-3">
                        <!-- Default: no tools displayed here -->
                    </div>

                    <!-- Popup Tambah Tools -->
                    <div id="tools-popup" class="tools-popup shadow p-3 bg-white rounded" style="display: none; position: absolute; top: 50px; right: 20px; width: 300px; z-index: 1050;">
                        <!-- Search bar -->
                        <div class="input-group mb-3">
                            <input type="text" id="tool-search" class="form-control" placeholder="Cari tools">
                            <button class="btn btn-outline-secondary" id="search-tools-btn" type="button">Search</button>
                        </div>

                        <!-- Grid tools -->
                        <div id="tools-grid" class="row">
                            @foreach ($tools as $toolall)
                                <div class="col-12 tool-item d-flex align-items-center mb-2" data-tool-name="{{ strtolower($toolall->name_tools) }}" data-tool-id="{{ $toolall->id }}">
                                    <input class="form-check-input tool-checkbox me-2" type="checkbox" value="{{ $toolall->id }}" id="tool-{{ $toolall->id }}" />
                                    <label class="form-check-label" for="tool-{{ $toolall->id }}">
                                        {{ $toolall->name_tools }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error('tools')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="col-6 mt-2">
                        <div class="entryarea">
                            <input type="text" id="name"
                                value = "{{ $course->resources != 'null' ? $course->resources : '' }}" name="resources"
                                placeholder="" />
                            <div class="labelline" for="link">Asset</div>
                            @error('resources')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @error('resources')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="col-6 mt-2">
                        <div class="entryarea">
                            <input type="text" id="name" name="link_grub" value="{{ $course->link_grub }}"
                                placeholder="" />
                            <div class="labelline" for="link">Link Grup Kursus<span class="required-field"></span>
                            </div>
                            @error('link_grub')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @error('link_grub')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="col-12">
                        <div class="custom-entryarea">
                            <select id="category" name="level">
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

    // Define variables and functions in global scope
    let toolsGrid;
    let selectedToolsContainer;
    let updateSelectedToolsInput;

    document.addEventListener('DOMContentLoaded', function() {
        // Definisikan semua variabel di awal
        const type = document.getElementById('type');
        const price = document.getElementById('price');
        const form = document.querySelector('form');
        const toolsPopup = document.getElementById('tools-popup');
        const addToolsBtn = document.getElementById('add-tools-btn');
        toolsGrid = document.getElementById('tools-grid'); // Assign to global variable
        const toolSearch = document.getElementById('tool-search');
        const searchToolsBtn = document.getElementById('search-tools-btn');
        selectedToolsContainer = document.getElementById('selected-tools'); // Assign to global variable

        // Definisikan fungsi updateSelectedToolsInput
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

        // Handle price visibility
        var valuePrice = 0;

        if (type.value == 'premium') {
            price.classList.replace('d-none', 'd-block');
            valuePrice = document.querySelector('input[name="price"]').value
        } else {
            price.classList.replace('d-block', 'd-none');
            price.querySelector('input[name="price"]').value = '0';
        }

        // Type change event listener
        type.addEventListener('change', (e) => {
            if (e.target.value == 'premium') {
                price.classList.replace('d-none', 'd-block');
                price.querySelector('input[name="price"]').value = valuePrice
            } else if (e.target.value == 'free') {
                price.classList.replace('d-block', 'd-none');
                price.querySelector('input[name="price"]').value = '0';
            }
        });

        // Form submit prevention for tools popup
        form.addEventListener('submit', function(e) {
            if (toolsPopup.style.display === 'block') {
                e.preventDefault();
            }
        });

        // Tools popup toggle
        addToolsBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            toolsPopup.style.display = 'block';
        });

        // Close popup when clicking outside
        document.addEventListener('click', (e) => {
            if (!toolsPopup.contains(e.target) && e.target.id !== 'add-tools-btn') {
                toolsPopup.style.display = 'none';
            }
        });

        // Prevent popup close when clicking inside
        toolsPopup.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        // Tool checkbox change handler
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
                }
            }
        });

        // Remove tool handler
        selectedToolsContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-tool-btn')) {
                const toolId = e.target.dataset.toolId;
                const toolItem = toolsGrid.querySelector(`.tool-item[data-tool-id="${toolId}"]`);
                const selectedTool = e.target.closest('.selected-tool');

                const toolCheckbox = toolItem.querySelector('.tool-checkbox');
                toolCheckbox.checked = false;
                toolItem.style.display = '';
                selectedTool.remove();
                updateSelectedToolsInput();
            }
        });

        // Search functionality
        const filterTools = () => {
            const query = toolSearch.value.trim().toLowerCase();

            toolsGrid.querySelectorAll('.tool-item').forEach((toolItem) => {
                const toolName = toolItem.dataset.toolName;
                toolItem.style.display = toolName.includes(query) ? '' : 'none';
            });
        };

        toolSearch.addEventListener('input', filterTools);
        searchToolsBtn.addEventListener('click', filterTools);
        toolSearch.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                filterTools();
            }
        });
    });
    </script>

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
                console.log('tes') 
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
