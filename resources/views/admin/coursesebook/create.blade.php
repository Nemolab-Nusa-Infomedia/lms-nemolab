@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Create eBook')

@section('content')
    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Tambah e-book</h2>
            <a href="{{ route('admin.ebook') }}" class="btn btn-orange"> Back </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" action="{{ route('admin.ebook.create.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <label for="ebook">Buat Bundling</label>
                            <select id="course_id" name="course_id">
                            @forelse ($courses as $course)
                                <option value="">Tidak Ada Kursus Dipilih</option>
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @empty
                                <option value="">Tidak Ada Kursus Dipilih</option>
                            @endforelse
                            
                            </select>
                            @error('course_id')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <label for="ebook">Pilih Kategori</label>
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
                    <div class="col-6 mt-4">
                        <div class="entryarea">
                            <input type="text" id="name" name="name" placeholder="" />
                            <div class="labelline" for="name">Judul</div>
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <label for="ebook">Sampul</label>
                            <input type="file" id="imageUpload" name="cover" accept="image/*" class="" />
                            @error('cover')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="entryarea">
                            <textarea id="description" name="description" placeholder="" style="height: 173px"></textarea>
                            <div class="labelline-textarea" for="description">Deskripsi</div>
                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="status" name="status">
                                <option value="draft">Draft</option>
                                <option value="published">Terbitkan</option>
                            </select>
                            @error('status')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="type" name="type" onchange="handleTypeChange()">
                                <option value="free">Gratis</option>
                                <option value="premium">Premium</option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div class="entryarea">
                            <input type="number" id="price" name="price" placeholder=" " />
                            <div class="labelline" for="price">Harga</div>
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <label for="ebook">Upload eBook (PDF)</label>
                            <input type="file" id="ebook" name="ebook" accept="application/pdf" />
                            @error('ebook')
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

    <script>
        function handleTypeChange() {
            const type = document.getElementById('type').value;
            const priceInput = document.getElementById('price');
            
            if (type === 'free') {
                priceInput.value = '';
                priceInput.disabled = true;
            } else {
                priceInput.disabled = false;
            }
        }

        // Initialize the form with the correct state
        document.addEventListener('DOMContentLoaded', function() {
            handleTypeChange();
        });
    </script>
@endsection
