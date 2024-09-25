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
            <form class="col-12" action="{{ route('admin.ebook.edit.update', $ebook->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="course_id" name="course_id">
                                <option value="">Select Kursus (Opsional)</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id', $ebook->course_id) == $course->id ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" id="name" name="name" placeholder=" " value="{{ old('name', $ebook->name) }}" />
                            <div class="labelline" for="name">Judul</div>
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="entryarea">
                            <textarea id="description" name="description" placeholder=" " style="height: 173px">{{ old('description', $ebook->description) }}</textarea>
                            <div class="labelline-textarea" for="description">Deskripsi</div>
                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="status" name="status">
                                <option value="draft" {{ old('status', $ebook->status) == 'draft' ? 'selected' : '' }}>Draf</option>
                                <option value="published" {{ old('status', $ebook->status) == 'published' ? 'selected' : '' }}>Publik</option>
                            </select>
                            @error('status')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="type" name="type" onchange="handleTypeChange()">
                                <option value="free" {{ old('type', $ebook->type) == 'free' ? 'selected' : '' }}>Gratis</option>
                                <option value="premium" {{ old('type', $ebook->type) == 'premium' ? 'selected' : '' }}>Berbayar</option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="number" id="price" name="price" placeholder=" " value="{{ old('price', $ebook->price) }}" />
                            <div class="labelline" for="price">Harga</div>
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" id="link" name="link" placeholder=" " value="{{ old('link', $ebook->link) }}" />
                            <div class="labelline" for="link">Link</div>
                            @error('link')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit"
                            class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                            style="background-color: #faa907">Perbarui</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function handleTypeChange() {
            var typeSelect = document.getElementById('type');
            var priceInput = document.getElementById('price');
            if (typeSelect.value === 'free') {
                priceInput.value = '0';
                priceInput.disabled = true;
            } else {
                priceInput.disabled = false;
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            handleTypeChange();
        });
    </script>
@endsection
