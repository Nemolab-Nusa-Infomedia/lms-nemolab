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
                    <p class="m-0 mb-1 mt-3">Pilih Tools</p>
                    <div class="col-12 d-flex align-items-center mb-3">
                        @foreach ($tools as $toolall)
                            <div class="form-check d-flex align-items-center ms-2">
                                <input class="form-check-input p-0 p-2 border-0"
                                    style="float: none; border: 2px solid #faa907 !important;" type="checkbox"
                                    value="{{ $toolall->id }}" id="flexCheckDefault" name="tools[]"
                                    {{ in_array($toolall->id, $coursetool->tools->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="flexCheckDefault">
                                    {{ $toolall->name_tools }}
                                </label>
                            </div>
                        @endforeach
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
        document.addEventListener('DOMContentLoaded', function() {
            const type = document.getElementById('type');
            const price = document.getElementById('price');

            var valuePrice = 0;

            if (type.value == 'premium') {
                price.classList.replace('d-none', 'd-block');
                valuePrice = document.querySelector('input[name="price"]').value
            } else {
                price.classList.replace('d-block', 'd-none');
                price.querySelector('input[name="price"]').value = '0';
            }

            type.addEventListener('change', (e) => {
                if (e.target.value == 'premium') {
                    price.classList.replace('d-none', 'd-block');
                    price.querySelector('input[name="price"]').value = valuePrice
                } else if (e.target.value == 'free') {
                    price.classList.replace('d-block', 'd-none');
                    price.querySelector('input[name="price"]').value = '0';
                }
            });
        });
    </script>
@endpush
