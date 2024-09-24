@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Create Member')

@section('content')

    <div class="container my-3 p-5 w-75">
        <div class="row">
            <form class="col-12" action="{{ route('admin.member.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <h2 class="fw-semibold mb-4" style="color: #faa907">Tambah Data</h2>
                    <div class="col-12 mb-3">
                        <div class="entryarea">
                            <input type="text" id="name" name="name" placeholder=""  value="{{old('name')}}" />
                            <div class="labelline" for="name">Nama<span class="required-field"></span></div>
                        </div>
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <div class="entryarea">
                            <input type="text" id="email" name="email" placeholder="" value="{{old('email')}}" />
                            <div class="labelline" for="email">Email<span class="required-field"></span></div>
                        </div>
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <div class="entryarea">
                            <input type="password" id="password" name="password" placeholder="" />
                            <div class="labelline" for="password">Password<span class="required-field"></span></div>
                        </div>
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="row col-12 mt-3">
                        <div class="col-6">
                            <button type="submit"
                                class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                                style="background-color: #faa907">Kirim</button>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.member') }}"
                                class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white btn-batal"
                                style="background-color: gray">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
