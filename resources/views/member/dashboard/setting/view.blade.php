@extends('components.layouts.member.dashboard')

@section('title', 'Nemolab - Lihat informasi dan perkembangan anda disini')
@section('hide_footer')
@endsection


@push('addon-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar-dashboard.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/setting.css') }} ">
@endpush

@section('content')
    <section class="setting-section" id="setting-section">
        <div class="container-fluid mt-4 mt-sm-5 pt-0 pt-sm-5">
            <div class="row">

                @include('components.includes.member.sidebar-dashboard')

                <!-- Setting Cards -->
                <div class="col-11 col-md-7 col-xl-9 mx-auto ">
                    <h5 class="mb-4 mt-4 title-pengaturan">Pengaturan</h5>
                    <div class="row gy-4">
                        <div class="col-md-12 col-xl-6 ">
                            <a href="{{ route('member.setting.profile') }}" class="text-decoration-none">
                                <div class="setting-item">
                                    <div class="icon py-2 px-3 mx-3">
                                        <img src="{{ asset('nemolab/member/img/icon/card-profile.png') }}" alt="">
                                    </div>
                                    <div class="content ms-1 mt-3">
                                        <h3 class="text-black">Ubah profil anda</h3>
                                        <p class="">Ketuk untuk mengubah data diri anda disini</p>
                                    </div>
                                    <div class="toggle me-3">
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-12 col-xl-6">
                            <a href="{{ route('member.setting.reset-password') }}" class="text-decoration-none">
                                <div class="setting-item">
                                    <div class="icon py-2 px-3 mx-3">
                                        <img src="{{ asset('nemolab/member/img/icon/auth.png') }}" alt="">
                                    </div>
                                    <div class="content ms-1 mt-3">
                                        <h3 class="text-black">Ubah kata sandi anda</h3>
                                        <p>Ketuk untuk mengubah kata sandi anda disini</p>
                                    </div>
                                    <div class="toggle me-3">
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-12 col-xl-6">
                            <a href="{{ route('member.setting.change-email') }}" class="text-decoration-none">
                                <div class="setting-item">
                                    <div class="icon py-2 px-3 mx-3">
                                        <img src="{{ asset('nemolab/member/img/icon/message.png') }}" alt="">
                                    </div>
                                    <div class="content ms-1 mt-3">
                                        <h3 class="text-black">Ubah email anda</h3>
                                        <p>Ketuk untuk mengubah email anda disini</p>
                                    </div>
                                    <div class="toggle me-3">
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.includes.member.sidebar-dashboard-mobile')
@endsection