<div class="container">
    <nav class="navbar navbar-expand-lg fixed-top bg-white px-5 z-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('nemolab/admin/img/Logo Nemolab.png') }}" alt="Logo" width="100"
                    class="d-inline-block align-text-top">
            </a>
            <div class="menu-toggle d-inline-flex d-lg-none" id="menuToggle">
                <div class="bar1 rounded-3"></div>
                <div class="bar2 rounded-3"></div>
                <div class="bar3 rounded-3"></div>
            </div>
            <div class="navtoggle navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item pt-lg-0 pt-4">
                        <a class="nav-link" href="{{ route('home') }}#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('member.course') }}#course">Kursus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#testimonial">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#aboutus">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#contactus">Kontak Kami</a>
                    </li>
                </ul>
                <hr />
                <div class="user-login d-flex align-items-center gap-2 my-3 my-md-1">
                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <p class="fw-semibold m-0 mx-2 order-last order-lg-first">{{ Auth::user()->name }}</p>
                            @if (Auth::user()->avatar != 'default.png')
                                <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" alt=""
                                    width="45" height="45" class="border border-2 rounded-circle" id="myProfile"
                                    style="cursor: pointer" />
                            @else
                                <img src="{{ asset('nemolab/admin/img/avatar.png') }}" alt="" width="45" height="45"
                                    class="d-none d-lg-block border border-2 rounded-circle" id="myProfile"
                                    style="cursor: pointer" />
                            @endif
                        </div>
                        <div class="profile-ikon d-flex d-lg-none text-decoration-none me-3 gap-3">
                            <a href="{{ route('member.dashboard') }}">
                                <img src="{{ asset('nemolab/member/img/dashboard.png') }}" width="25">
                            </a>
                            <a href="{{ route('member.setting') }}">
                                <img src="{{ asset('nemolab/member/img/settings.png') }}" width="25">
                            </a>
                            <a href="{{ route('member.logout') }}">
                                <img src="{{ asset('nemolab/member/img/exit.png') }}" width="20">
                            </a>
                        </div>
                    </div>
                    <!-- Profile Menu -->
                    <div class="profile-user border border-2 rounded-2 overflow-hidden" id="profileMenu">
                        <a href="{{ route('member.dashboard') }}"
                            class="bg-white px-3 py-2 d-flex align-items-center text-decoration-none text-black-50 item fw-semibold m-0 w-100 fw-bold">
                            Dasbhoard
                        </a>
                        <a href="{{ route('member.setting') }}"
                            class="bg-white px-3 py-2 d-flex align-items-center text-decoration-none text-black-50 item fw-semibold m-0 w-100 fw-bold">
                            Pengaturan
                        </a>
                        <a href="{{ route('member.logout') }}"
                            class="bg-white px-3 py-2 d-flex align-items-center text-decoration-none text-black-50 item fw-semibold m-0 w-100 fw-bold">
                            Keluar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
