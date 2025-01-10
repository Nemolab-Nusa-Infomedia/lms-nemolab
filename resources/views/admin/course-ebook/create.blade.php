@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Tambah eBook')

@section('content')
<div class="container-fluid px-2 px-sm-5 mt-5">
    <div class="row ">
        @include('components.includes.admin.sidebar')
        <div class="col-12 col-lg-9 ps-xl-3 d-flex flex-column justify-content-center">
        <div class="table-responsive shadow-lg rounded-3 p-5 w-100" style="background-color: #ffffff;">
            <div class="d-flex justify-content-between mb-3">
                <h2 class="fw-bolder">Tambah eBook</h2>
                <a class="btn btn-orange" href="{{ route('admin.ebook') }}"> Kembali </a>
            </div>
        <div>
            <form id="formAction" action="{{ route('admin.ebook.create.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <label for="category">Kategori<span class="required-field"></span></label>
                            <select id="category" name="category" class="form-select">
                                <option value="" disabled selected>--Pilih Kategori--</option>
                                <option value="UI/UX Designer">UI/UX Designer</option>
                                <option value="Frontend Developer">Frontend Developer</option>
                                <option value="Backend Developer">Backend Developer</option>
                                <option value="Wordpress Developer">Wordpress Developer</option>
                                <option value="Graphics Designer">Graphics Designer</option>
                                <option value="Fullstack Developer">Fullstack Developer</option>
                                @error('category')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="name">Judul<span class="required-field"></span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Judul" value="{{ old('name') }}" />

                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div>
                            <label for="description">Deskripsi<span class="required-field"></span></label>
                            <textarea id="description" class="form-control" name="description" placeholder="Masukan Deskripsi" style="height: 110px">{{ old('description') }}</textarea>
                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="col-6 mb-3">
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
                    </div> --}}
                    <div class="col-md-6">
                        <label for="">File Pdf<span class="required-field"></span></label>
                        <div class="cover-input" id="upload-btn">
                            <div id="upload-btn-img" class="upload-btn-img overflow-y-scroll rounded shadow mb-2" style="max-height: 300px">
                            </div>
                            <input type="file" id="pdfUpload" name="file_ebook" accept="application/pdf" class="form-control" hidden/>
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
                            <p class="mb-0">Maximum file size 10 mb</p>
                            <p>Format file : PDF</p>
                            <button type="button" class="btn btn-primary" id="" style="background: 0; border: 1px solid #BDBDBD; color: #414242" >Unggah</button>                                    
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="">Cover eBook<span class="required-field"></span></label>
                        <div class="cover-input" id="upload-btn">
                            <div id="upload-btn-img" class="upload-btn-img overflow-y-scroll rounded shadow mb-2" style="max-height: 300px">
                            </div>
                            <input type="file" id="imageUpload" name="cover" accept="image/*" class="form-control" hidden/>
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
                            <p class="mb-0">Maximum file size 10 mb</p>
                            <p>Format file : PNG/ JPG/ JPEG</p>
                            <button type="button" class="btn btn-primary" id="" style="background: 0; border: 1px solid #BDBDBD; color: #414242" >Unggah</button>                                    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="status">Status<span class="required-field"></span></label>
                            <select id="status" name="status" class="form-select">
                                <option value="" disabled selected>--Pilih Status--</option>
                                <option value="draft">Draf</option>
                                <option value="published">Publik</option>
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
                                <option value="" disabled selected>--Pilih Tipe--</option>
                                <option value="free" class="value_type">Gratis</option>
                                <option value="premium" class="value_type">Berbayar</option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 d-none" id="price">
                        <div>
                            <label for="price">Harga</label>
                            <input type="number" id="name" name="price" class="form-control" placeholder="" value="0" />
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12" id="level">
                        <div>
                            <label for="level">Level<span class="required-field"></span></label>
                            <select id="category" name="level" class="form-control">
                                <option value="" disabled selected>--Pilih Level--</option>
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
                            class="btn btn-orange w-100 py-2">Kirim</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';
        
        // Ambil elemen untuk file PDF
        const pdfUploadBtn = document.querySelectorAll('.cover-input')[0];
        const pdfUploadBtnImg = pdfUploadBtn.querySelector('.upload-btn-img');
        const pdfFileInput = pdfUploadBtn.querySelector('input[type="file"]');
        const pdfSvg = pdfUploadBtn.querySelector('svg');
        const pdfTexts = pdfUploadBtn.querySelectorAll('p');
        const pdfButton = pdfUploadBtn.querySelector('button');

        // Ambil elemen untuk image cover
        const imageUploadBtn = document.querySelectorAll('.cover-input')[1];
        const imageUploadBtnImg = imageUploadBtn.querySelector('.upload-btn-img');
        const imageFileInput = imageUploadBtn.querySelector('input[type="file"]');
        const imageSvg = imageUploadBtn.querySelector('svg');
        const imageTexts = imageUploadBtn.querySelectorAll('p');
        const imageButton = imageUploadBtn.querySelector('button');

        // Handler untuk PDF upload
        pdfFileInput.addEventListener('change', async function(e) {
            const file = e.target.files[0];
            
            if (file) {
                if (file.type !== 'application/pdf') {
                    alert('Please upload a PDF file');
                    e.target.value = '';
                    return;
                }

                if (file.size > 10 * 1024 * 1024) { // 10MB limit
                    alert('File size exceeds 10MB limit');
                    e.target.value = '';
                    return;
                }

                // Hide SVG
                if (pdfSvg) pdfSvg.style.display = 'none';

                try {
                    const arrayBuffer = await file.arrayBuffer();
                    const pdf = await pdfjsLib.getDocument(arrayBuffer).promise;
                    const page = await pdf.getPage(1);
                    const viewport = page.getViewport({ scale: 0.5 });
                    
                    const canvas = document.createElement('canvas');
                    canvas.className = 'preview-pdf';
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    
                    const context = canvas.getContext('2d');
                    await page.render({
                        canvasContext: context,
                        viewport: viewport
                    }).promise;

                    // Update preview container
                    pdfUploadBtnImg.innerHTML = '';
                    pdfUploadBtnImg.appendChild(canvas);

                    // Update file info text
                    const fileSize = (file.size / (1024 * 1024)).toFixed(2);
                    pdfTexts[0].textContent = `PDF, ${fileSize} MB`;
                    pdfTexts[1].style.display = 'none';

                    // Change upload button to delete button
                    pdfButton.textContent = 'Hapus';
                    pdfButton.onclick = function(e) {
                        e.stopPropagation();
                        pdfFileInput.value = '';
                        pdfUploadBtnImg.innerHTML = '';
                        pdfSvg.style.display = '';
                        pdfTexts[0].textContent = 'Maximum file size 10 mb';
                        pdfTexts[1].style.display = '';
                        pdfButton.textContent = 'Unggah';
                        pdfButton.onclick = null;
                    };

                } catch (error) {
                    console.error('Error loading PDF:', error);
                    alert('Error loading PDF preview');
                }
            }
        });

        // Handler untuk Image upload
        imageFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            
            if (file) {
                if (!file.type.startsWith('image/')) {
                    alert('Please upload an image file');
                    e.target.value = '';
                    return;
                }

                if (file.size > 10 * 1024 * 1024) { // 10MB limit
                    alert('File size exceeds 10MB limit');
                    e.target.value = '';
                    return;
                }

                // Hide SVG
                if (imageSvg) imageSvg.style.display = 'none';

                // Create/update preview image
                let previewImg = imageUploadBtnImg.querySelector('.preview-image');
                if (!previewImg) {
                    previewImg = document.createElement('img');
                    previewImg.className = 'preview-image';
                    previewImg.style.maxWidth = '100%';
                    previewImg.style.maxHeight = '100%';
                    previewImg.style.objectFit = 'cover';
                    previewImg.style.outline = '2px solid #faa907';
                    previewImg.style.outlineOffset = '2px';
                    imageUploadBtnImg.insertBefore(previewImg, imageUploadBtnImg.firstChild);
                }

                // Update file info text
                const fileSize = (file.size / (1024 * 1024)).toFixed(2);
                const fileType = file.type.split('/')[1].toUpperCase();
                imageTexts[0].textContent = `${fileType}, ${fileSize} MB`;
                imageTexts[1].style.display = 'none';

                // Change upload button to delete button
                imageButton.textContent = 'Hapus';
                imageButton.onclick = function(e) {
                    e.stopPropagation();
                    imageFileInput.value = '';
                    previewImg.remove();
                    imageSvg.style.display = '';
                    imageTexts[0].textContent = 'Maximum file size 10 mb';
                    imageTexts[1].style.display = '';
                    imageButton.textContent = 'Unggah';
                    imageButton.onclick = null;
                };

                // Create preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Click handlers untuk upload buttons
        pdfUploadBtn.addEventListener('click', function(e) {
            if (e.target === pdfUploadBtn || e.target === pdfButton) {
                pdfFileInput.click();
            }
        });

        imageUploadBtn.addEventListener('click', function(e) {
            if (e.target === imageUploadBtn || e.target === imageButton) {
                imageFileInput.click();
            }
        });

        // Handler untuk type select
        const type = document.getElementById('type');
        const price = document.getElementById('price');
        const level = document.getElementById('level');

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
