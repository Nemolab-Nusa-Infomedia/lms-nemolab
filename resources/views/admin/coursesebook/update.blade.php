@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Edit eBook')

@section('content')
    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Edit eBook</h2>
            <a href="{{ route('admin.ebook') }}" class="btn btn-orange"> Back </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" action="{{ route('admin.ebook.edit.update', $ebook->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <label for="course_id">Course (Optional)</label>
                            <select id="course_id" name="course_id">
                                <option value="">Select Course</option>
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
                        <div class="custom-entryarea">
                            <label for="category">Category</label>
                            <select id="category" name="category">
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->name }}" {{ old('category', $ebook->category) == $cat->name ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="entryarea">
                            <label for="name">Title</label>
                            <input type="text" id="name" name="name" placeholder=" " value="{{ old('name', $ebook->name) }}" />
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <label for="ebook">Perbarui Sampul</label>
                            <input type="file" id="imageUpload" name="cover" accept="image/*" class="" />
                            @error('cover')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="entryarea">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" placeholder=" " style="height: 173px">{{ old('description', $ebook->description) }}</textarea>
                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="custom-entryarea">
                            <label for="status">Status</label>
                            <select id="status" name="status">
                                <option value="draft" {{ old('status', $ebook->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $ebook->status) == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="custom-entryarea">
                            <label for="type">Type</label>
                            <select id="type" name="type" onchange="handleTypeChange()">
                                <option value="free" {{ old('type', $ebook->type) == 'free' ? 'selected' : '' }}>Free</option>
                                <option value="premium" {{ old('type', $ebook->type) == 'premium' ? 'selected' : '' }}>Premium</option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="entryarea">
                            <label for="price">Price</label>
                            <input type="number" id="price" name="price" placeholder=" " value="{{ old('price', $ebook->price) }}" />
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="entryarea">
                            <label for="ebook">Update eBook (PDF)</label>
                            <input type="file" id="ebook" name="ebook" accept="application/pdf" />
                            @error('ebook')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit"
                            class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                            style="background-color: #faa907">Update</button>
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
