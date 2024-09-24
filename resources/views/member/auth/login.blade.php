@extends('components.layouts.member.auth')

@section('title', 'Login Member')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/login.css') }} ">
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="box rounded-5 bg-white text-center d-flex flex-column justify-content-center">
                    <div>
                        <img src="{{ asset('nemolab/member/img/logo.png') }}" alt="logo" width="130" />
                    </div>
                    <h3 class="fw-bold">Masuk ke <span>Nemolab</span></h3>
                    <form method="POST" action="{{ route('member.login.auth') }}">
                        @csrf
                        <div class="input-col position-relative">
                            <input type="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" />
                            <span class="ikon"><img src="{{ asset('nemolab/member/img/emaillogin.png') }}"
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
                            <button type="submit" class="btn text-white fw-semibold">Masuk</button>
                            <a href="{{ route('member.register') }}" class="btn text-white fw-semibold">Buat akun baru</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


