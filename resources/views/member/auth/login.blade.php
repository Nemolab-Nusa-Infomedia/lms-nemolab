@extends('components.layouts.member.auth')

@section('title', 'Masuk dengan akunmu untuk mengakses kelas')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/auth.css') }} ">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card login-card d-flex flex-row">
                <div class="img-container">
                    <img src="{{ asset('nemolab/member/img/bismen.jpeg') }}" alt="Team collaboration" class="img-fluid rounded-start">
                </div>
                <div class="card-body">
                    <a href="{{ route('home') }}" class="btn-back mb-4">
                        <img src="{{ asset('nemolab/member/img/icon/arrow.png') }}" alt="Back" class="back-icon">
                    </a>
                    <div class="px-3 text-center">
                        <h3 class="mb-4" data-aos="fade-left" data-aos-delay="100">MASUK DENGAN AKUNMU!</h3>
                        <p class="fw-bold" data-aos="fade-left" data-aos-delay="200">Masuk untuk mengakses akun anda, dengan mengisi email dan password dibawah ini</p>
                    </div>
                    <form id="loginForm" method="POST" action="{{ route('member.login.auth') }}" class="signin-form">
                        @csrf
                        <div class="mb-1" >
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" name="email" placeholder="Masukan email anda"  value="{{ old('email') }}" class="form-control fw-bold py-2" required>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-5" >
                            <label for="password" class="form-label fw-bold">Kata sandi</label>
                            <div class="position-relative w-100">
                                <input type="password" name="password" placeholder="Masukan kata sandi disini"
                                       id="password" class="form-control py-2 fw-bold" required>
                                <button type="button" id="toggle-password" class="btn btn-light position-absolute end-0 top-50 translate-middle-y px-3" style="background-color: transparent">
                                    <img src="{{ asset('nemolab/member/img/mdi_show.png') }}" width="20" height="20" alt="Show Password Icon" id="toggle-icon">
                                </button>
                            </div>
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3" >
                            <button type="submit" class="btn btn-primary w-100 rounded-start py-2 fw-bold">Masuk</button>
                        </div>
                    </form>
                    <p class="text-center fw-bold">tidak memiliki akun? <a href="{{ route('member.register') }}">daftar disini</a></p>
                    <p class="text-center fw-bold">lupa kata sandi? <a href="{{ route('member.forget-password') }}">ganti sandi disini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('loginForm');
        form.querySelectorAll('input[required]').forEach(input => {
            input.addEventListener('invalid', function() {
                switch (this.type) {
                    case 'text':
                        this.setCustomValidity("Harap masukkan nama pengguna.");
                        break;
                    case 'email':
                        this.setCustomValidity("Harap masukkan email yang valid.");
                        break;
                    case 'password':
                        this.setCustomValidity("Harap masukkan kata sandi.");
                        break;
                    default:
                        this.setCustomValidity("Field ini wajib diisi.");
                }
            });

            input.addEventListener('input', function() {
                this.setCustomValidity("");
            });
        });
    });
</script>
<script>
    document.getElementById('toggle-password').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const toggleIcon = document.getElementById('toggle-icon');
        const isPasswordVisible = passwordField.type === 'password';

        passwordField.type = isPasswordVisible ? 'text' : 'password';
        toggleIcon.src = isPasswordVisible 
            ? '{{ asset("nemolab/member/img/mdi_hide.png") }}' 
            : '{{ asset("nemolab/member/img/mdi_show.png") }}';
    });
</script>
@endpush
