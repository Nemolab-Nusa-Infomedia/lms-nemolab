@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Buat Member')

@section('content')

    <div class="container my-3 p-5 w-75">
        <div class="row">
            <form class="col-12" action="{{ route('admin.student.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <h2 class="fw-semibold mb-4" style="color: #faa907">Tambah Data</h2>
                    <div class="col-12 mb-3">
                        <div class="entryarea">
                            <input type="text" id="name" name="name" placeholder=""
                                value="{{ old('name') }}" />
                            <div class="labelline" for="name">Nama<span class="required-field"></span></div>
                        </div>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <div class="entryarea">
                            <input type="text" id="email" name="email" placeholder=""
                                value="{{ old('email') }}" />
                            <div class="labelline" for="email">Email<span class="required-field"></span></div>
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <div class="entryarea">
                            <div class="custom-entryarea">
                                <select id="profession" name="profession">
                                    <div class="mb-3">
                                        <option value="UI/UX Designer">UI/UX Designer</option>
                                        <option value="Frontend Developer">Frontend Developer</option>
                                        <option value="Backend Developer">Backend Developer</option>
                                        <option value="Wordpress Developer">Wordpress Developer</option>
                                        <option value="Graphics Designer">Graphics Designer</option>
                                        <option value="Fullstack Developer">Fullstack Developer</option>
                                    </div>
                                </select>
                                @error('profession')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="entryarea">
                            <input type="password" id="password" name="password" placeholder="" />
                            <div class="labelline" for="password">Password<span class="required-field"></span></div>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row col-12 mt-3">
                        <div class="col-6">
                            <button type="submit"
                                class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                                style="background-color: #faa907">Kirim</button>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.student') }}"
                                class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white btn-batal"
                                style="background-color: gray">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
