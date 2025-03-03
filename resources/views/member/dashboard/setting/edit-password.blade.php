@extends('components.layouts.member.dashboard')

@section('title', 'Ubah Profil Anda Di Sini')
@section('hide_footer')
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar-dashboard.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/setting.css') }} ">
@endpush
@section('content')
    <section class="profile-saya-section" id="profile-saya-section">
        <div class="container-fluid mt-5 pt-5">
            <div class="row">

                @include('components.includes.member.sidebar-dashboard')

                <!-- Profile Form -->
                <div class="col-11 col-md-7 col-xl-9 mx-auto mt-2">
                    <div class="card profile-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <a href="{{ route('member.setting') }}" class="btn-back">
                                    <img src="{{ asset('nemolab/member/img/icon/arrow.png') }}" alt="Back"
                                        class="back-icon btn-costum">
                                </a>
                                <h5 class="title p-0 ps-3 fw-bold m-0">Ubah kata sandi anda</h5>
                            </div>
                            <form action="{{ route('member.setting.reset-password.updated') }}" id="profileForm"
                                method="POST" class="edit-form">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="mb-4">
                                        <label for="old_password" class="form-label fw-bold">Kata Sandi Lama</label>
                                        <div class="position-relative w-100">
                                            <input type="password" name="old_password"
                                                placeholder="Masukan kata sandi lama disini" id="old_password"
                                                class="fw-bold" required>
                                            <button type="button"
                                                class="toggle-password btn btn-light position-absolute end-0 top-50 translate-middle-y px-3"
                                                style="background-color: transparent">
                                                <img src="{{ asset('nemolab/member/img/mdi_show.png') }}" width="20"
                                                    height="20" alt="Show Password Icon">
                                            </button>
                                        </div>
                                        @error('old_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="new_password" class="form-label fw-bold">Kata Sandi Baru</label>
                                        <div class="position-relative w-100">
                                            <input type="password" name="new_password"
                                                placeholder="Masukan kata sandi baru disini" id="new_password"
                                                class="fw-bold" required>
                                            <button type="button"
                                                class="toggle-password btn btn-light position-absolute end-0 top-50 translate-middle-y px-3"
                                                style="background-color: transparent">
                                                <img src="{{ asset('nemolab/member/img/mdi_show.png') }}" width="20"
                                                    height="20" alt="Show Password Icon">
                                            </button>
                                        </div>
                                        @error('new_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="new_password_confirmation" class="form-label fw-bold">Konfirmasi Kata
                                            Sandi Baru</label>
                                        <div class="position-relative w-100">
                                            <input type="password" name="new_password_confirmation"
                                                placeholder="Masukan kata sandi disini" id="new_password_confirmation"
                                                class="fw-bold" required>
                                            <button type="button"
                                                class="toggle-password btn btn-light position-absolute end-0 top-50 translate-middle-y px-3"
                                                style="background-color: transparent">
                                                <img src="{{ asset('nemolab/member/img/mdi_show.png') }}" width="20"
                                                    height="20" alt="Show Password Icon">
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" id="submitButton"
                                            class="btn btn-primary w-100 rounded-start fw-bold">Simpan
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
        // document.addEventListener('DOMContentLoaded', () => {
        //     const form = document.getElementById('profileForm');
        //     const inputs = form.querySelectorAll('input, select');
        //     const submitButton = document.getElementById('submitButton');

        //     // Asal warna default
        //     const defaultBackground = '#fff';
        //     const changedBackground = '#E8E8E8';
        //     const defaultButtonColor = '#ce8e0e';
        //     const changedButtonColor = '#faa907';
        //     // Deteksi perubahan
        //     inputs.forEach(input => {
        //         input.addEventListener('input', () => {
        //             input.style.backgroundColor = changedBackground;
        //             submitButton.style.backgroundColor = changedButtonColor;
        //             submitButton.style.borderColor = changedButtonColor;
        //         });
        //     });

        //     // Reset tombol ke default setelah submit
        //     form.addEventListener('submit', () => {
        //         inputs.forEach(input => {
        //             input.style.backgroundColor = defaultBackground;
        //         });
        //         submitButton.style.backgroundColor = defaultButtonColor;
        //         submitButton.style.borderColor = defaultButtonColor;
        //     });
        // });
    </script>

    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling; // Ambil input sebelum tombol
                const icon = this.querySelector('img'); // Ambil ikon dalam tombol
                const isPasswordVisible = input.type === 'password';

                input.type = isPasswordVisible ? 'text' : 'password';
                icon.src = isPasswordVisible ?
                    '{{ asset('nemolab/member/img/mdi_hide.png') }}' :
                    '{{ asset('nemolab/member/img/mdi_show.png') }}';
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('profileForm');
            form.querySelectorAll('input[required]').forEach(input => {
                input.addEventListener('invalid', function() {
                    switch (this.type) {
                        case 'text':
                            this.setCustomValidity("Harap masukkan nama anda.");
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
@endpush
