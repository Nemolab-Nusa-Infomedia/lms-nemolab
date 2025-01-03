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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const type = document.getElementById('type');
            const price = document.getElementById('price');
            const level = document.getElementById('level');

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
@endpush
