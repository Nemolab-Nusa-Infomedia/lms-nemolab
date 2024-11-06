@extends('components.layouts.member.setting')

@section('title', 'Ubah Profil Anda Di Sini')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/setting.css') }} ">
@endpush
@section('content')
    <section class="profile-saya-section" id="profile-saya-section">
        <div class="container-fluid mt-5 pt-5">
            <div class="row">

                <!-- Profile Form -->
                <div class="col-12 col-sm-9 mx-auto mt-2">
                    <div class="card profile-card ">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <a href="{{ route('member.setting') }}" class="btn-back">
                                    <img src="{{ asset('nemolab/member/img/icon/arrow.png') }}" alt="Back"
                                        class="back-icon btn-costum">
                                </a>
                                <h5 class="title p-0 ps-3 fw-bold m-0">Ubah profil anda</h5>
                            </div>
                            <form action="{{ route('member.setting.profile.updated') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="mb-4">
                                    <h6 class="fw-bold">Foto Profil</h6>

                                    <p>Ukuran Foto Maksimal (1 MB)</p>
                                    <img src="{{ Auth::user()->avatar !== null ? asset('storage/images/avatars/' . Auth::user()->avatar) : asset('nemolab/member/img/icon/Group 7.png') }}"
                                        alt="avatar" width="130" height="130" class="avatar mb-3"
                                        style="border-radius: 50%; object-fit: cover;" id="avatarPreview" />
                                    <input type="file" id="fileUpload" name="avatar" class="d-none">
                                    <label for="fileUpload" class="btn btn-secondary px-5">Pilih foto</label>
                                    @error('avatar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label fw-bold">Nama Pengguna</label>
                                        <input type="text" id="name" name="name" class="form-control fw-bold"
                                            placeholder="Masukan nama disini" value="{{ old('name', Auth::user()->name) }}"
                                            required>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label fw-bold">Email</label>
                                        <input type="email" id="email" name="email" class="form-control fw-bold"
                                            value="{{ Auth::user()->email }}" readonly
                                            style="cursor: pointer; background-color:#E8E8E8;">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="profession" class="form-label fw-bold">Karir Impian</label>
                                        <select name="profession" id="profession" class="form-select">
                                            <option value="Pelajar Jangka Panjang"
                                                {{ old('profession', Auth::user()->profession) == 'Pelajar Jangka Panjang' ? 'selected' : '' }}>
                                                Pelajar Jangka Panjang</option>
                                            <option value="UI/UX Designer"
                                                {{ old('profession', Auth::user()->profession) == 'UI/UX Designer' ? 'selected' : '' }}>
                                                UI/UX Designer</option>
                                            <option value="Frontend Developer"
                                                {{ old('profession', Auth::user()->profession) == 'Frontend Developer' ? 'selected' : '' }}>
                                                Frontend Developer</option>
                                            <option value="Backend Developer"
                                                {{ old('profession', Auth::user()->profession) == 'Backend Developer' ? 'selected' : '' }}>
                                                Backend Developer</option>
                                            <option value="Wordpress Developer"
                                                {{ old('profession', Auth::user()->profession) == 'Wordpress Developer' ? 'selected' : '' }}>
                                                Wordpress Developer</option>
                                            <option value="Graphic Designer"
                                                {{ old('profession', Auth::user()->profession) == 'Graphic Designer' ? 'selected' : '' }}>
                                                Graphic Designer</option>
                                        </select>
                                        @error('profession')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" class="btn btn-primary w-100 rounded-start fw-bold">Simpan
                                            Perubahan</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('addon-script')
    <script>
        document.getElementById('fileUpload').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        });

        document.getElementById('parent-sidebar').remove();
    </script>
@endpush
