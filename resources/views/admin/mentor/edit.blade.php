@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Update Mentor')

@section('content')

    <div class="container my-3 p-5 w-75">
        <div class="row">
            <form class="col-12" action="{{ route('admin.mentor.update', $mentor->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <h2 class="fw-semibold mb-4" style="color: #faa907">Perbarui Mentor</h2>
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
                        <div class="entryarea">
                            <select class="form-control pt-3 pb-3 shadow-none" name="role" style="border: 1px solid rgb(0, 0, 0) !important;">
                                <option value="students" {{ $mentor->role == 'students' ? 'selected' : '' }}>Anggota</option>
                                <option value="mentor" {{ $mentor->role == 'mentor' ? 'selected' : '' }}>Mentor</option>
                                <option value="superadmin" {{ $mentor->role == 'superadmin' ? 'selected' : '' }}>Superadmin
                                </option>
                            </select>
                        </div>
                        @error('role')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <div class="entryarea">
                            <input type="password" id="password" name="password" placeholder="" />
                            <div class="labelline" for="password">Password<span class="required-field"></span> (biarkan kosong jika tidak berubah)</div>
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
