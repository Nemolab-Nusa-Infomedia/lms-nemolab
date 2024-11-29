@extends('components.layouts.member.auth')

@section('title', 'reset Password Anda Sekarang!!!')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/auth.css') }} ">
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card login-card d-flex flex-row">
                    <div class="img-container">
                        <img src="{{ asset('nemolab/member/img/bismen.jpeg') }}" alt="Team collaboration"
                            class="img-fluid rounded-start">
                    </div>
                    <div class="card-body ps-4">
                        <a href="{{ route('member.forget-password') }}" class="btn-back mb-4">
                            <img src="{{ asset('nemolab/member/img/icon/arrow.png') }}" alt="Back" class="back-icon">
                        </a>
                        <div class="px-3 text-center">
                            <h3 class="mb-4" data-aos="fade-left" data-aos-delay="100">Reset Password Akunmu Di Sini!</h3>
                        </div>
                        <form action="{{ route('member.reset-password.updated') }}" class="signin-form" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="mb-1">
                                <label for="new-password" class="form-label fw-bold py-2">Kata sandi baru</label>
                                <input type="password" id="new-password" name="password" class="form-control fw-bold"
                                    placeholder="Masukan kata sandi disini" required>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label fw-bold py-2">Konfirmasi kata sandi</label>
                                <div class="position-relative w-100">
                                    <input type="password" name="confirm_pass" placeholder="Masukan kata sandi disini"
                                           id="confirm-password-field" class="form-control py-2 fw-bold" required>
                                    <button type="button" id="confirm-password" class="btn btn-light position-absolute end-0 top-50 translate-middle-y px-3" style="background-color: transparent">
                                        <img src="{{ asset('nemolab/member/img/mdi_show.png') }}" width="20" height="20" alt="Show Password Icon" id="toggle-icon">
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100 py-2 rounded-start fw-bold"
                                    id="submitBtn">Ubah Kata Sandi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- include sweetalert --}}
    @include('sweetalert::alert')

@endsection

@push('addon-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('new-password');
            const confirmPasswordInput = document.getElementById('confirm-password-field');
            const submitButton = document.getElementById('submitBtn');

            submitButton.disabled = true;

            function validatePasswords() {
                // Enable the button only if both fields are filled and passwords match
                if (passwordInput.value === confirmPasswordInput.value) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            }

            // Add event listeners to both password fields
            passwordInput.addEventListener('input', validatePasswords);
            confirmPasswordInput.addEventListener('input', validatePasswords);
        })
    </script>

    <script>
        document.getElementById('confirm-password').addEventListener('click', function () {
            const confirmPasswordField = document.getElementById('confirm-password-field');
            const toggleIcon = document.getElementById('toggle-icon');
            const isPasswordVisible = confirmPasswordField.type === 'password';

            confirmPasswordField.type = isPasswordVisible ? 'text' : 'password';
            toggleIcon.src = isPasswordVisible 
                ? '{{ asset("nemolab/member/img/mdi_hide.png") }}' 
                : '{{ asset("nemolab/member/img/mdi_show.png") }}';
        });
    </script>
@endpush
