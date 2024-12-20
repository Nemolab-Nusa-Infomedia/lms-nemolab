@extends('components.layouts.member.auth')

@section('title', 'Masuk dengan akunmu untuk mengakses kelas')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/auth.css') }} ">
@endpush

@section('content')
<form class="card" id="login-form" method="POST" action="{{ route('admin.login.auth') }}">
    @csrf
    <div class="card-title">
        <h1>Admin Login</h1>
        <p>Masuk untuk mengakses akun anda, dengan mengisi email dan kata sandi dibawah ini</p>
    </div>
    <div class="card-form">
        <div class="input-container mb">
            <label for="email">Email</label>
            <input required type="email" id="email" name="email" value="{{ old('email') }}">
            <p id="" class="error">
                @error('email')
                    {{ $message }}
                @enderror
            </p>
        </div>
        <div class="input-container">
            <label for="password">Kata Sandi</label>
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
    </div>
    <div class="card-foot">
        <button type="submit">Masuk</button>
    </div>
</form>
@endsection

@push('addon-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.querySelectorAll('input');
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
        input.forEach(input => {
            input.addEventListener('focus', (event) => {
                changePreviousElementStyle(event.target);
            });
            input.addEventListener('change', (event) => {
                changePreviousElementStyle(event.target);
            });
            input.addEventListener('blur', (event) => {
                removePreviousElementStyle(event.target);
            });
            if(input.value) {
                changePreviousElementStyle(input);                    
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('login-form');

                // form.querySelector('select[required]').addEventListener('invalid', function() {
                //     this.setCustomValidity("Harap pilih posisi impianmu.");
                // });

                // form.querySelector('select[required]').addEventListener('input', function() {
                //     this.setCustomValidity("");
                // })

                form.querySelectorAll('input[required]').forEach(input => {
                        input.addEventListener('invalid', function() {
                                switch (this.type) {
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
