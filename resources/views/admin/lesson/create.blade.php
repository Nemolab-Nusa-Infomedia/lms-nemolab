@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Create Lesson')

@section('content')

    <div class="card card-custom-width" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Tambah Data</h2>
            <a href="{{ route('admin.lesson', ['slug' => $slug, 'id_chapter' => $id_chapter]) }}" class="btn btn-orange">
                Kembali </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" action="{{ route('admin.lesson.create.store', $id_chapter) }}" method="post">
                @csrf
                <div class="entryarea">
                    <input type="text" id="name" name="name" placeholder="" />
                    <div class="labelline" for="name">Judul Video<span class="required-field"></span></div>
                    @error('name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="entryarea mt-2">
                    <input type="text" id="name" name="video" placeholder=""/>
                    <div class="labelline" for="name">Link Video<span class="required-field"></span></div>
                    @error('video')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 pt-2">
                    <button type="submit"
                        class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                        style="background-color: #faa907">Kirim</button>
                </div>
                <div class="col-6">
                    {{-- <a href=""
                            class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white btn-batal"
                            style="background-color: gray">Reset</a> --}}
                </div>
            </form>
        </div>
    </div>

@endsection
