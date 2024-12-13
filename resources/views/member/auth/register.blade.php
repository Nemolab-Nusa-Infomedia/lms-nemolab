@extends('components.layouts.member.auth')

@section('title', 'Daftarkan akunmu untuk mengakses kelas')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/auth.css') }} ">
@endpush

@section('content')
    <form class="card" id="register-form" action="{{ route('member.register.store') }}" method="POST">
        @csrf
        <div class="card-title">
            <h1>Daftar Akun Baru</h1>
            <p>Bergabunglah dengan <strong>Nemolab</strong> Sekarang</p>
        </div>
        <div class="card-form">
            <div class="input-container">
                <label for="name">Nama Pengguna</label>
                <input required type="text" id="name" name="name">
                <p id="" class="error">
                    @error('name')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="input-container">
                <label for="email">Email</label>
                <input required type="email" id="email" name="email">
                <p id="" class="error">
                    @error('email')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="input-container">
                <label for="password">Password</label>
                <input required type="password" id="password" name="password" minlength="8">
                <button type="button"
                    class="btn btn-light position-absolute end-0 top-50 translate-middle-y px-3 toggle-password"
                    style="background-color: transparent" data-target="password">
                    <img src="{{ asset('nemolab/member/img/mdi_show.png') }}" width="20" height="20"
                        alt="Show Password Icon" id="toggle-icon">
                </button>
                <p id="passwordError" class="error">
                    @error('password')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="input-container">
                <label for="password_confirmation">Confirmasi Password</label>
                <input required type="password" id="password_confirmation" name="password_confirmation">
                <button type="button"
                    class="btn btn-light position-absolute end-0 top-50 translate-middle-y px-3 toggle-password"
                    style="background-color: transparent" data-target="password_confirmation">
                    <img src="{{ asset('nemolab/member/img/mdi_show.png') }}" width="20" height="20"
                        alt="Show Password Icon" id="toggle-icon">
                </button>
                <p id="passwordConfirmationError" class="error">
                    @error('password_confirmation')
                        {{ $message }}
                    @enderror
                </p>
            </div>
        </div>
        <div class="card-foot">
            <button type="submit">Daftar</button>
            <p>Sudah punya akun? <a href="{{ route('member.login') }}">Login</a></p>
        </div>
    </form>
@endsection

@push('addon-script')
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const avatarPreview = document.getElementById('avatarPreview');
        //     const fileUpload = document.getElementById('fileUpload');

        //     // Fungsi untuk memperbarui gambar pratinjau
        //     fileUpload.addEventListener('change', (event) => {
        //         const file = event.target.files[0];
        //         if (file) {
        //             const reader = new FileReader();
        //             reader.onload = function(e) {
        //                 avatarPreview.src = e.target.result; // Memperbarui sumber gambar pratinjau
        //             };
        //             reader.readAsDataURL(file);
        //         }
        //     });
        // });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');

            // Fungsi untuk mengubah gaya elemen sebelumnya
            function changePreviousElementStyle(currentElement) {
                const previousElement = currentElement.previousElementSibling;
                if (previousElement) {
                    previousElement.classList.add('highlight');
                }
            }

            // Fungsi untuk menghapus gaya elemen sebelumnya
            function removePreviousElementStyle(currentElement) {
                const previousElement = currentElement.previousElementSibling;
                if (previousElement && !currentElement.value) {
                    previousElement.classList.remove('highlight');
                }
            }

            // Menambahkan event listener untuk setiap input
            inputs.forEach(input => {
                input.addEventListener('focus', (event) => {
                    changePreviousElementStyle(event.target);
                });
                input.addEventListener('input', (event) => {
                    changePreviousElementStyle(event.target);
                });
                input.addEventListener('blur', (event) => {
                    removePreviousElementStyle(event.target);
                });
                input.addEventListener('animationstart', (event) => {
                    if (event.animationName === 'onAutoFillStart') {
                        changePreviousElementStyle(event.target);
                    }
                });
                if (input.value) {
                    changePreviousElementStyle(input);
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('register-form');

            // form.querySelector('select[required]').addEventListener('invalid', function() {
            //     this.setCustomValidity("Harap pilih posisi impianmu.");
            // });

            // form.querySelector('select[required]').addEventListener('input', function() {
            //     this.setCustomValidity("");
            // })

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
                            this.setCustomValidity(
                                "Harap masukkan kata sandi, minimal 8 karakter.");
                            break;
                        default:
                    }
                });

                input.addEventListener('input', function() {
                    this.setCustomValidity("");
                });
            });

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                let isValid = true; // Reset error messages 
                // document.getElementById('nameError').textContent = '';
                // document.getElementById('emailError').textContent = '';
                // document.getElementById('professionError').textContent = '';
                document.getElementById('passwordError').textContent = '';
                document.getElementById('passwordConfirmationError').textContent =
                    ''; // Validate password 
                const password = document.getElementById('password').value;
                const passwordRegex = /^(?=.*[a-z])(?=.*[0-9]).{8,}$/;
                if (!passwordRegex.test(password)) {
                    document.getElementById('passwordError').textContent =
                        'Password harus berisi kombinasi huruf dan angka.';
                    isValid = false;
                } // Validate password confirmation 
                const passwordConfirmation = document.getElementById('password_confirmation').value;
                if (password !== passwordConfirmation) {
                    document.getElementById('passwordConfirmationError').textContent =
                        'Konfirmasi password tidak cocok.';
                    isValid = false;
                }
                if (isValid) {
                    this.submit();
                }
            });
        });
    </script>
    <script>
        const tooglePassword = document.querySelectorAll('.toggle-password');

        tooglePassword.forEach(element => {
            element.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                const passwordField = document.getElementById(target);
                const toggleIcon = document.getElementById('toggle-icon');
                const isPasswordVisible = passwordField.type === 'password';

                passwordField.type = isPasswordVisible ? 'text' : 'password';
                this.querySelector('img').src = isPasswordVisible ?
                    '{{ asset('nemolab/member/img/mdi_hide.png') }}' :
                    '{{ asset('nemolab/member/img/mdi_show.png') }}';
            });
        });
    </script>
@endpush
