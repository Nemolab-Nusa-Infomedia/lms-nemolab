@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Tambah eBook')

@section('content')
    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Tambah eBook</h2>
            <a href="{{ route('admin.ebook') }}" class="btn btn-orange"> Kembali </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" action="{{ route('admin.ebook.create.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <p class="m-0">Kategori</p>
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
                        </div>
                    </div>
                    <div class="col-6">
                        <p class="m-0">Judul Ebook</p>
                        <div class="entryarea">
                            <input type="text" id="name" name="name" placeholder="" value="{{ old('name') }}" />

                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="m-0">Deskripsi</p>
                        <div class="entryarea">
                            <textarea id="description" name="description" placeholder="" style="height: 173px">{{ old('description') }}</textarea>

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
                    <div class="col-6 mt-2">
                        <p class="m-0">Status</p>
                        <div class="custom-entryarea">
                            <select id="status" name="status">
                                <option value="draft">Draf</option>
                                <option value="published">Publik</option>
                            </select>
                            @error('status')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mt-2">
                        <p class="m-0">Tipe</p>
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
                    <div class="col-6 d-none" id="price">
                        <p class="m-0">Harga</p>
                        <div class="entryarea">
                            <input type="number" id="name" name="price" placeholder="" value="0" />
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12" id="level">
                        <p class="m-0">Level</p>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';
    </script>
    <script>
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
    </script>
@endpush
