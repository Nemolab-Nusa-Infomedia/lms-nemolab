@extends('components.layouts.member.auth')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/register.css') }} ">
@endpush

@section('title', 'Register Member')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="box rounded-5 bg-white text-center d-flex flex-column justify-content-center">
                    <div>
                        <img src="{{ asset('nemolab/member/img/logo.png') }}" alt="logo" width="130" />
                    </div>
                    <div>
                        <img src="{{ asset('nemolab/member/img/avatar.png') }}" alt="avatar" width="105" height="105"
                            style="border-radius: 50%; object-fit: cover" id="avatarPreview" />
                    </div>

                    <form action="{{ route('member.register.auth') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-col position-relative">
                            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" />
                            <span class="ikon"><img src="{{ asset('nemolab/member/img/user.png') }}"
                                    width="16" /></span>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-col position-relative mt-2">
                            <input type="file" name="avatar" id="fileInput" class="file-input"
                                onchange="updateFileName()" />
                            <label for="fileInput" class="file-label" data-placeholder="Pilih Foto Profil"></label>
                            <span class="ikon"><img src="{{ asset('nemolab/member/img/avatar_2.png') }}"
                                    width="16" /></span>
                            @error('avatar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-col position-relative mt-2">
                            <input type="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" />
                            <span class="ikon"><img src="{{ asset('nemolab/member/img/emailregister.png') }}"
                                    width="16" /></span>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-col position-relative mt-2">
                            <input type="password" name="password" placeholder="Password" id="password" />
                            <span class="ikon"><img src="{{ asset('nemolab/member/img/password.png') }}"
                                    width="16" /></span>
                            <span class="eye">
                                <img src="{{ asset('nemolab/member/img/eye.png') }}" width="20"
                                    class="pass-icon opacity-25" id="pass-icon" onclick="pass()" />
                            </span>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" class="btn text-white fw-semibold">Buat</button>
                            <a href="{{ route('member.login') }}" class="btn text-white fw-semibold">Sudah Punya Akun?</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        function updateFileName() {
            const fileInput = document.getElementById('fileInput');
            const avatarPreview = document.getElementById('avatarPreview');

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
@endpush
