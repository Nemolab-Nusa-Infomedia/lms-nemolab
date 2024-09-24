@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Create Course')

@section('content')
    <div class="card w-75 mt-5 mb-5 p-4 rounded-3" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Tambah Data</h2>
            <a href="{{ route('admin.course') }}" class="fw-semibold btn btn-primary d-block py-2 px-4" style="
            height: max-content;
            nt;"> Kembali </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" id="formAction" action="{{ route('admin.course.create.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="category" name="category">
                                @forelse ($category as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @empty
                                    <option value="">Tidak Ada Kategori</option>
                                @endforelse
                            </select>
                            @error('category')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" id="name" name="name" placeholder="" value="{{ old('name')}}" />
                            <div class="labelline" for="name">Judul<span class="required-field"></span></div>
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="entryarea">
                            <textarea id="description" name="description" placeholder="" style="height: 173px">{{ old('description')}}</textarea>
                            <div class="labelline-textarea" for="desc">Deskripsi<span class="required-field"></span></div>
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
                            <input type="text" id="name" name="price" placeholder="" value="0" />
                            <div class="labelline" for="link">Harga</div>
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <p class="m-0">Sampul</p>
                        <input type="file" id="imageUpload" name="cover" accept="image/*" class="" />
                        @error('cover')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <p class="m-0 mb-1">Pilih Alat</p>
                    <div class="col-12 d-block mb-3">
                        @if ($tools->isNotEmpty())
                            <div class="d-flex align-items-center">
                                @foreach ($tools as $tool)
                                    <div class="form-check d-flex align-items-center ms-2">
                                        <input class="form-check-input p-0 p-2 border-0"
                                            style="float: none; border: 2px solid #faa907 !important;" type="checkbox"
                                            value="{{ $tool->id }}" id="flexCheckDefault" name="tools[]">
                                        <label class="form-check-label ms-2" for="flexCheckDefault">
                                            {{ $tool->name_tools }}
                                        </label>
                                    </div>
                                @endforeach
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
                            <input type="text" id="name" name="resources" placeholder="" {{ old('resources')}}/>
                            <div class="labelline" for="link">Asset</div>
                            @error('resources')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mt-2">
                        <div class="entryarea">
                            <input type="text" id="name" name="link_grub" placeholder="" />
                            <div class="labelline" for="link">Link Grup Kursus<span class="required-field"></span></div>
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
                            >Kirim</button>
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

        type.addEventListener('change', (e) => {
            if (e.target.value == 'premium') {
                price.classList.replace('d-none', 'd-block');
            } else if (e.target.value == 'free') {
                price.classList.replace('d-block', 'd-none');
                price.querySelector('input[name="price"]').value = '0';
            }
        });
    </script>
@endpush
