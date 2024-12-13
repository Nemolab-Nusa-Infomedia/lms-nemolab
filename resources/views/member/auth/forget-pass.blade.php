@extends('components.layouts.member.auth')

@section('title', 'Lupa Sandi')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/auth.css') }} ">
@endpush

@section('content')
<form class="card" id="signin-form" method="POST" action="{{ route('member.forget-password.check') }}">
    @csrf
    <div class="card-title">
        <h1>Lupa Kata Sandi</h1>
        <p>Masukan nama email anda dibawah</p>
    </div>
    <div class="card-form">
        <div class="input-container">
            <label for="email">Email</label>
            <input required type="email" id="email" name="email">
            <p id="" class="error">
                @error('email')
                    {{ $message }}
                @enderror
            </p>
        </div>
    </div>
    <div class="card-foot">
        @if (session('statusSend') != 'limit')
            <button type="submit" >Konfirmasi</button>
        @else
            <button disabled >Konfirmasi</button>
        @endif
    </div>
</form>

    {{-- include sweetalert --}}
    @include('sweetalert::alert')

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
                const form = document.getElementById('signin-form');

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
                                    default:
                                }
                                });
                            
                            input.addEventListener('input', function() {
                                this.setCustomValidity("");
                            });
                        });
                });
</script>
@endpush