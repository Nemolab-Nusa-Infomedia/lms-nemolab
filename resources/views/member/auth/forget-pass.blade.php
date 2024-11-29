@extends('components.layouts.member.auth')

@section('title', 'Login Member')

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
                        <a href="{{ route('member.login') }}" class="btn-back mb-4">
                            <img src="{{ asset('nemolab/member/img/icon/arrow.png') }}" alt="Back" class="back-icon">
                        </a>
                        <div class="px-3 text-center">
                            <h3 class="mb-4" data-aos="fade-left" data-aos-delay="100">Lupa Kata Sandi</h3>
                            <p class="fw-bold" data-aos="fade-left" data-aos-delay="200">Masukan alamat email anda
                                dibawah</p>
                        </div>
                        <form id="signin-form" method="POST" action="{{ route('member.forget-password.check') }}"
                            class="signin-form">
                            <div class="mb-5">
                                @csrf
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" id="email" name="email" class="form-control fw-bold py-2"
                                    placeholder="masukan email disini" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                @if (session('statusSend') != 'limit')
                                    <button type="submit" class="btn btn-primary py-2 w-100 rounded-start fw-bold">Reset
                                        Password</button>
                                @else
                                    <button class="btn btn-orange py-2 w-100 rounded-start fw-bold" disabled>Reset
                                        Password</button>
                                @endif
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
@endpush