@extends('components.layouts.member.app')

@push('prepend-style')
<link rel="stylesheet" href="{{ asset('nemolab/member/css/setting-profile.css') }}">
<link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar.css') }}">
@endpush

@section('content')
    <section id="setting">
        <div class="container" style="margin-top: 5rem">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-3 d-none d-xl-block p-4 pb-5 rounded-4 text-white px-5"
                    style="background-color: #faa907; width: max-content;">
                    @if (Auth::user()->avatar != 'default.png')
                        <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" style="border-radius: 100%;"
                            alt="" width="70" height="70" class="d-flex mx-lg-auto mt-3" />
                    @else
                        <img src="{{ asset('nemolab/admin/img/avatar.png') }}" style="border-radius: 100%;" alt=""
                            width="70" height="70" class="d-flex mx-lg-auto mt-3" />
                    @endif
                    <h4 class="m-0 mt-lg-5 mt-3 fw-semibold">{{ Auth::user()->name }}</h4>
                    <p class="m-0 fw-light">Status {{ Auth::user()->role }}</p>
                    <div class="mt-5">
                        <a href="{{ route('member.dashboard') }}" class="list-sidebar">
                            <img src="{{ asset('nemolab/member/img/course.png') }}" alt="" width="30" />
                            <p class="m-0">Kursus Saya</p>
                        </a>
                        <a href="{{ route('member.portofolio') }}" class="list-sidebar">
                            <img src="{{ asset('nemolab/member/img/portofolio.png') }}" alt="" width="30" />
                            <p class="m-0">Portofolio Saya</p>
                        </a>
                        <a href="{{ route('member.transaction') }}" class="list-sidebar">
                            <img src="{{ asset('nemolab/member/img/transaksi.png') }}" alt="" width="30" />
                            <p class="m-0">Transaksi Saya</p>
                        </a>
                    </div>
                </div>
                <!-- End Sidebar -->
    
                <!-- My Profil -->
                <div class="col-lg-5 col-md-10 col-12 mx-auto mx-lg-0 px-5 ms-lg-3">
                    <h3 class="fw-semibold mb-4" style="color: #faa907">My Profile</h3>
                    <form action="">
                        {{-- <div class="input">
                            <label for="">My Avatar</label><br />
                            <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" alt=""
                                width="90" />
                        </div> --}}
                        <div class="input">
                            <label for="name">Nama Lengkap</label><br />
                            <input type="text" id="name" value="{{ Auth::user()->name }}" readonly />
                        </div>
                        <div class="input">
                            <label for="email">Alamat Email</label><br />
                            <input type="email" id="email" value="{{ Auth::user()->email }}" readonly />
                        </div>
                        <div class="input">
                            <label for="username">Nama Pengguna</label><br />
                            <input type="text" id="username" value="{{ Auth::user()->username }}" readonly />
                        </div>
                        <div class="input d-flex gap-2">
                            <div class="input-password w-50">
                                <label for="password">Password</label><br />
                                <input type="password" id="password" value="{{ Auth::user()->password }}" readonly />
                            </div>
                            <div class="btn-password w-50" style="padding-top: 35px">
                                <a href="{{ route('member.edit-password') }}" class="edit-pass">Edit Pass<span
                                        class="d-none d-md-inline-block">word</span></a>
                            </div>
                        </div>
                        <div class="input mt-4">
                            <a href="{{ route('member.edit-profile') }}" class="edit-pass">Edit Profil</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
