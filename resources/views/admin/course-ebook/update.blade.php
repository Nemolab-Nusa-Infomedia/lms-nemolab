@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Edit eBook')

@section('content')
    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Edit eBook</h2>
            <a href="{{ route('admin.ebook') }}" class="btn btn-orange"> Kembali </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" action="{{ route('admin.ebook.edit.update', $ebooks->id) }}" method="post"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-6">
                        <p class="m-0">Kategori</p>
                        <div class="custom-entryarea">
                            <select id="category" name="category">
                                <option value="UI/UX Designer"
                                    {{ 'UI/UX Designer' == $ebooks->category ? 'selected' : '' }}>UI/UX Designer</option>
                                <option value="Frontend Developer"
                                    {{ 'Frontend Developer' == $ebooks->category ? 'selected' : '' }}>Frontend Developer
                                </option>
                                <option value="Backend Developer"
                                    {{ 'Backend Developer' == $ebooks->category ? 'selected' : '' }}>Backend Developer
                                </option>
                                <option value="Wordpress Developer"
                                    {{ 'Wordpress Developer' == $ebooks->category ? 'selected' : '' }}>Wordpress Developer
                                </option>
                                <option value="Graphics Designer"
                                    {{ 'Graphics Designer' == $ebooks->category ? 'selected' : '' }}>Graphics Designer
                                </option>
                                <option value="Fullstack Developer"
                                    {{ 'Fullstack Developer' == $ebooks->category ? 'selected' : '' }}>Fullstack Developer
                                </option>
                            </select>
                            @error('category')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <p class="m-0">Judul Ebook</p>
                        <div class="entryarea">
                            <input type="text" id="name" name="name" placeholder=""
                                value="{{ old('name', $ebooks->name) }}" />
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="m-0">Deskripsi</p>
                        <div class="entryarea">
                            <textarea id="description" name="description" placeholder="" style="height: 173px">{{ old('description', $ebooks->description) }}</textarea>

                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <p class="m-0">File Pdf</p>
                        <input type="file" name="file_ebook" accept="application/pdf" class="" />
                        @error('file_ebook')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-6 mb-3">
                        <p class="m-0">Cover Ebook</p>
                        <input type="file" id="imageUpload" name="cover" accept="image/*" class="" />
                        @error('cover')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-6">
                        <p class="m-0">Status</p>
                        <div class="custom-entryarea">
                            <select id="category" name="status">
                                <option value="draft" {{ $ebooks->status == 'draft' ? 'selected' : '' }}>Draf</option>
                                <option value="published" {{ $ebooks->status == 'published' ? 'selected' : '' }}>Publik
                                </option>
                            </select>
                            @error('status')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <p class="m-0">Tipe</p>
                        <div class="custom-entryarea">
                            <select id="type" name="type">
                                <option value="free" {{ $ebooks->type == 'free' ? 'selected' : '' }}>Gratis</option>
                                <option value="premium" {{ $ebooks->type == 'premium' ? 'selected' : '' }}>Berbayar
                                </option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mt-4 {{ $ebooks->type == 'free' ? 'd-none' : 'd-block' }}" id="price">
                        <div class="entryarea">
                            <input type="number" id="name" name="price" placeholder=""
                                value="{{ $ebooks->price }}" />
                            <div class="labelline" for="link">Harga</span></div>
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12" id="level">
                        <p class="m-0">Level</p>
                        <div class="custom-entryarea">
                            <select id="category" name="level">
                                <option value="beginner" {{ $ebooks->level == 'beginner' ? 'selected' : '' }}>Pemula
                                </option>
                                <option value="intermediate" {{ $ebooks->level == 'intermediate' ? 'selected' : '' }}>
                                    Menengah</option>
                                <option value="expert" {{ $ebooks->level == 'expert' ? 'selected' : '' }}>Ahli</option>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const type = document.getElementById('type');
            const price = document.getElementById('price');
            const level = document.getElementById('level');
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

            imageUpload.addEventListener('change', function(e) {
                previewContainer.innerHTML = '';
                
                const file = e.target.files[0];
                if (file) {
                    if (!file.type.startsWith('image/')) {
                        alert('Please upload an image file');
                        e.target.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    const img = document.createElement('img');

                    reader.onload = function(e) {
                        img.src = e.target.result;
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
                    reader.readAsDataURL(file);
                }
            });

            // PDF Preview Script
            const pdfUpload = document.querySelector('input[name="file_ebook"]'); // Changed selector to match the input name
            const pdfContainer = pdfUpload.parentNode;
            pdfContainer.className = 'pdf-upload-container';

            const pdfLeftSide = document.createElement('div');
            pdfLeftSide.className = 'pdf-upload-left';
            const pdfRightSide = document.createElement('div');
            pdfRightSide.className = 'pdf-upload-right';

            const pdfExistingElements = [...pdfContainer.children];
            pdfExistingElements.forEach(el => pdfLeftSide.appendChild(el));

            const pdfPreviewContainer = document.createElement('div');
            pdfPreviewContainer.className = 'pdf-preview-container';
            pdfRightSide.appendChild(pdfPreviewContainer);

            pdfContainer.appendChild(pdfLeftSide);
            pdfContainer.appendChild(pdfRightSide);

            pdfUpload.addEventListener('change', async function(e) {
                pdfPreviewContainer.innerHTML = '';
                
                const file = e.target.files[0];
                if (file) {
                    if (file.type !== 'application/pdf') {
                        alert('Please upload a PDF file');
                        e.target.value = '';
                        return;
                    }

                    const previewWrapper = document.createElement('div');
                    previewWrapper.className = 'pdf-preview-wrapper';

                    const canvas = document.createElement('canvas');
                    canvas.className = 'pdf-thumbnail';

                    try {
                        const arrayBuffer = await file.arrayBuffer();
                        const pdf = await pdfjsLib.getDocument(arrayBuffer).promise;
                        const page = await pdf.getPage(1);
                        const viewport = page.getViewport({ scale: 0.5 });
                        
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        
                        const context = canvas.getContext('2d');
                        await page.render({
                            canvasContext: context,
                            viewport: viewport
                        }).promise;

                        const fileInfo = document.createElement('div');
                        fileInfo.className = 'pdf-info';
                        fileInfo.innerHTML = `
                            <p class="pdf-name">${file.name}</p>
                            <p class="pdf-size">${(file.size / (1024 * 1024)).toFixed(2)} MB</p>
                        `;

                        const removeButton = document.createElement('button');
                        removeButton.textContent = 'Hapus';
                        removeButton.className = 'btn btn-danger btn-sm';
                        removeButton.onclick = function(e) {
                            e.preventDefault();
                            pdfPreviewContainer.innerHTML = '';
                            pdfUpload.value = '';
                        };

                        previewWrapper.appendChild(canvas);
                        previewWrapper.appendChild(fileInfo);
                        pdfPreviewContainer.appendChild(previewWrapper);
                        pdfPreviewContainer.appendChild(removeButton);
                    } catch (error) {
                        console.error('Error loading PDF:', error);
                        alert('Error loading PDF preview');
                    }
                }
            });

            // Pastikan elemen "type" sudah ada sebelum melanjutkan
            if (type) {
                if (type.value == 'premium') {
                    price.classList.replace('d-none', 'd-block');
                    level.classList.replace('col-12', 'col-6');
                } else if (type.value == 'free') {
                    price.classList.replace('d-block', 'd-none');
                    level.classList.replace('col-6', 'col-12');
                    price.querySelector('input[name="price"]').value = '0';
                }

                // Event listener untuk perubahan nilai pada "type"
                type.addEventListener('change', (e) => {
                    if (e.target.value == 'premium') {
                        price.classList.replace('d-none', 'd-block');
                        level.classList.replace('col-12', 'col-6');
                    } else if (e.target.value == 'free') {
                        price.classList.replace('d-block', 'd-none');
                        level.classList.replace('col-6', 'col-12');
                        price.querySelector('input[name="price"]').value = '0';
                    }
                });
            }
        });
    </script>
    
@if($ebooks->cover)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageUpload = document.getElementById('imageUpload');
            const previewContainer = document.querySelector('.image-preview-container');

            // Fetch the existing image
            fetch("{{ asset('storage/' . $ebooks->cover) }}")
                .then(response => response.blob())
                .then(blob => {
                    // Create a File object
                    const fileName = "{{ basename($ebooks->cover) }}".substring(10);
                    const file = new File([blob], fileName, { type: blob.type });
                    
                    // Set the file input value
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    imageUpload.files = dataTransfer.files;
                    
                    // Create and display preview
                    const img = document.createElement('img');
                    img.src = "{{ url('storage/images/covers/' . $ebooks->cover) }}";
                    
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

@if($ebooks->file_ebook)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pdfUpload = document.querySelector('input[name="file_ebook"]');
            const pdfPreviewContainer = document.querySelector('.pdf-preview-container');

            // Create preview elements
            const previewWrapper = document.createElement('div');
            previewWrapper.className = 'pdf-preview-wrapper';

            const canvas = document.createElement('canvas');
            canvas.className = 'pdf-thumbnail';

            const fileInfo = document.createElement('div');
            fileInfo.className = 'pdf-info';

            const fileName = "{{ basename($ebooks->file_ebook) }}".substring(15);
            
            // Create a temporary URL for the PDF file
            const pdfUrl = "{{ url('storage/file_pdf/' . $ebooks->file_ebook) }}";

            // Load and display the PDF preview
            pdfjsLib.getDocument(pdfUrl).promise.then(async function(pdf) {
                const page = await pdf.getPage(1);
                const viewport = page.getViewport({ scale: 0.5 });
                
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                
                const context = canvas.getContext('2d');
                
                await page.render({
                    canvasContext: context,
                    viewport: viewport
                }).promise;

                // Get file size using fetch
                const response = await fetch(pdfUrl);
                const blob = await response.blob();
                const fileSize = (blob.size / (1024 * 1024)).toFixed(2);

                fileInfo.innerHTML = `
                    <p class="pdf-name">${fileName}</p>
                    <p class="pdf-size">${fileSize} MB</p>
                `;

                const removeButton = document.createElement('button');
                removeButton.textContent = 'Hapus';
                removeButton.className = 'btn btn-danger btn-sm';
                removeButton.onclick = function(e) {
                    e.preventDefault();
                    pdfPreviewContainer.innerHTML = '';
                    pdfUpload.value = '';
                };

                previewWrapper.appendChild(canvas);
                previewWrapper.appendChild(fileInfo);
                pdfPreviewContainer.innerHTML = '';
                pdfPreviewContainer.appendChild(previewWrapper);
                pdfPreviewContainer.appendChild(removeButton);

                // Set the file input value
                fetch(pdfUrl)
                    .then(response => response.blob())
                    .then(blob => {
                        const file = new File([blob], fileName, { type: 'application/pdf' });
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        pdfUpload.files = dataTransfer.files;
                    });
            }).catch(error => {
                console.error('Error loading PDF:', error);
                pdfPreviewContainer.innerHTML = '<p class="text-danger">Error loading PDF preview</p>';
            });
        });
    </script>
@endif

@endpush
