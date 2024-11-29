@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Edit Mentor')

@section('content')

    <div class="container my-3 p-5 w-75">
        <div class="row">
            <form class="col-12" action="{{ route('admin.mentor.update', $mentor->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <h2 class="fw-semibold mb-4" style="color: #faa907">Perbarui Data</h2>
                    <div class="col-12 mb-3">
                        <div class="entryarea">
                            <input type="text" id="name" name="name" value="{{ old('name', $mentor->name) }}"
                                placeholder="" required />
                            <div class="labelline" for="name">Nama<span class="required-field"></span></div>
                        </div>
                        @error('name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <div class="entryarea">
                            <input type="text" id="email" name="email" value="{{ old('email', $mentor->email) }}"
                                placeholder="" required />
                            <div class="labelline" for="email">Email<span class="required-field"></span></div>
                        </div>
                        @error('email')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <div class="custom-entryarea">
                            <select id="profession" name="profession">
                                <option value="UI/UX Designer"
                                    {{ 'UI/UX Designer' == $mentor->profession ? 'selected' : '' }}>UI/UX Designer</option>
                                <option value="Frontend Developer"
                                    {{ 'Frontend Developer' == $mentor->profession ? 'selected' : '' }}>Frontend Developer
                                </option>
                                <option value="Backend Developer"
                                    {{ 'Backend Developer' == $mentor->profession ? 'selected' : '' }}>Backend Developer
                                </option>
                                <option value="Wordpress Developer"
                                    {{ 'Wordpress Developer' == $mentor->profession ? 'selected' : '' }}>Wordpress Developer
                                </option>
                                <option value="Graphics Designer"
                                    {{ 'Graphic Designer' == $mentor->profession ? 'selected' : '' }}>Graphics Designer
                                </option>
                                <option value="Fullstack Developer"
                                    {{ 'Fullstack Developer' == $mentor->profession ? 'selected' : '' }}>Fullstack
                                    Developer
                                </option>
                            </select>
                            @error('profession')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="custom-entryarea">
                            <select id="role" name="role">
                                <option value="mentor"
                                    {{ 'mentor' == $mentor->role ? 'selected' : '' }}>Mentor
                                </option>
                                <option value="superadmin"
                                    {{ 'superadmin' == $mentor->role ? 'selected' : '' }}>Superadmin
                                </option>
                            </select>
                            @error('role')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="entryarea">
                            <input type="password" id="password" name="password" placeholder="" />
                            <div class="labelline" for="password">Password<span class="required-field"></span> (biarkan
                                kosong jika tidak berubah)</div>
                        </div>
                        @error('password')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="row col-12 mt-3">
                        <div class="col-6">
                            <button type="submit"
                                class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                                style="background-color: #faa907">Perbarui</button>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.mentor') }}"
                                class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white btn-batal"
                                style="background-color: gray">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
