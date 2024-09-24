@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Edit Chapter')

@section('content')

    <div class="card card-custom-width p-4 rounded-3" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Edit Data</h2>
            <a href="{{ route('admin.chapter', $slug) }}" class="fw-semibold btn btn-primary d-block py-2 px-4" style="
            height: max-content;
            nt;"> Kembali </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" action="{{ route('admin.chapter.edit.update', $chapters->id) }}" method="post">
                @csrf
                @method('put')
                <div class="entryarea">
                    <input type="text" id="name" name="name" placeholder="" value="{{ $chapters->name }}" />
                    <div class="labelline" for="name">Bab<span class="required-field"></span></div>
                    @error('name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 pt-2">
                    <button type="submit"
                        class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                        >Kirim</button>
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
