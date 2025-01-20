<!-- navbar -->
<div class="backdrop-header d-md-none" style="display: none"></div>
<header class="w-100 fixed-top position-fixed bg-transparent">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md bg-transparent">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-center" id="navbar-brand">
                    <a href="{{ route('home') }}" style="text-decoration: none;">
                        <div class="brand-nemolab-icon d-flex align-items-center">
                            <img src="{{ asset('nemolab/member/img/logo-nemolab.png') }}" alt="Logo" width="40"
                                height="40" class="d-inline-block align-text-top">
                            <div class="title-navbar-brand ms-2 d-block">
                                <p class="m-0 p-0 title">Nemolab</p>
                                <p class="m-0 p-0 subtitle">Kursus Online Terbaik</p>
                            </div>
                        </div>
                    </a>
                </div>
                <button class="navbar-toggler d-flex d-md-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation" id="navbarToggler">
                    <span class="navbar-icon">
                        <svg width="29" height="27" viewBox="0 0 29 27" fill="none" id="navbar-closed"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect width="29" height="27" rx="7" fill="#FFF7E7" />
                            <path d="M7 8H22" stroke="#FAA907" stroke-width="2" stroke-linecap="round" />
                            <path d="M10.5 14H18.5" stroke="#FAA907" stroke-width="2" stroke-linecap="round" />
                            <path d="M7 20H22" stroke="#FAA907" stroke-width="2" stroke-linecap="round" />
                        </svg>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" style="display: none"
                            xmlns="http://www.w3.org/2000/svg" id="navbar-opened">
                            <path
                                d="M3.7 3.69987C3.93437 3.46579 4.25208 3.33431 4.58333 3.33431C4.91458 3.33431 5.23229 3.46579 5.46666 3.69987L9.99999 8.23154L14.5333 3.69987C14.6493 3.58387 14.787 3.49185 14.9386 3.42908C15.0902 3.3663 15.2526 3.33398 15.4167 3.33398C15.5807 3.33398 15.7432 3.3663 15.8947 3.42908C16.0463 3.49185 16.184 3.58387 16.3 3.69987C16.416 3.81587 16.508 3.95359 16.5708 4.10515C16.6336 4.25671 16.6659 4.41916 16.6659 4.58321C16.6659 4.74726 16.6336 4.9097 16.5708 5.06126C16.508 5.21283 16.416 5.35054 16.3 5.46654L11.7683 9.99987L16.3 14.5332C16.5343 14.7675 16.6659 15.0852 16.6659 15.4165C16.6659 15.7479 16.5343 16.0656 16.3 16.2999C16.0657 16.5341 15.748 16.6658 15.4167 16.6658C15.0853 16.6658 14.7676 16.5341 14.5333 16.2999L9.99999 11.7682L5.46666 16.2999C5.23239 16.5341 4.91464 16.6658 4.58333 16.6658C4.25201 16.6658 3.93427 16.5341 3.7 16.2999C3.46572 16.0656 3.33411 15.7479 3.33411 15.4165C3.33411 15.0852 3.46572 14.7675 3.7 14.5332L8.23166 9.99987L3.7 5.46654C3.46591 5.23216 3.33443 4.91446 3.33443 4.58321C3.33443 4.25196 3.46591 3.93425 3.7 3.69987Z"
                                fill="#8F8F8F" />
                        </svg>
                    </span>
                </button>

                <div class="collapse navbar-collapse  my-3 my-md-0" style="flex-grow: 0 !important"
                    id="navbarNavAltMarkup">
                    <ul class="navbar-nav d-md-flex align-items-md-center gap-md-4 ps-xl-5">
                        <div class="dropdown dropdown-pilih-kelas">
                            <button
                                class="btn btn-secondary dropdown-toggle d-flex align-items-center p-0 pt-2 pt-md-0 pb-2 pb-md-0"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pilih Kelas
                                <box-icon name='chevron-down' color="#000000"></box-icon>
                            </button>
                            <ul class="dropdown-menu mt-md-3 mb-3">
                                <div class="head-submenu d-flex justify-content-between align-items-center">
                                    <p class="m-0 p-0 fw-bold">Pilihan Kelas</p>
                                    <a href="{{ route('member.course') }}" class="m-0 p-0">Lihat Semua</a>
                                </div>
                                <div class="content-submenu mt-2 ">
                                    <div class="row m-0 ">
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'UI/UX Designer']) }}">UI
                                                UX Designer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'Frontend Developer']) }}">Frontend
                                                Developer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'Wordpress Developer']) }}">Wordpress
                                                Developer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'Backend Developer']) }}">Backend
                                                Developer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'Grapics Designer']) }}">Grapics
                                                Designer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'Fullstack Developer']) }}">Fullstack
                                                Developer</a>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <div class="dropdown dropdown-pilih-paket-kelas">
                            <button class="btn btn-secondary dropdown-toggle d-flex align-items-center p-0 pb-2 pb-md-0"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Paket Kelas
                                <box-icon name='chevron-down' color="#00000 "></box-icon>
                            </button>
                            <ul class="dropdown-menu mt-md-3 mb-3">
                                <div class="head-submenu d-flex justify-content-between align-items-center">
                                    <p class="m-0 p-0 fw-bold">Pilihan Paket Kelas</p>
                                    <a href="{{ route('member.course') }}" class="m-0 p-0">Lihat Semua</a>
                                </div>
                                <div class="content-submenu mt-2 ">
                                    <div class="row m-0">
                                        <div class="col-sm-12 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-paket' => 'paket-kursus']) }}">Course</a>
                                        </div>
                                        <div class="col-sm-12 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-paket' => 'paket-ebook']) }}">Ebook</a>
                                        </div>
                                        <div class="col-sm-12 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-paket' => 'paket-bundling']) }}">Paket
                                                Combo</a>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <a href="https://blog.nemolab.id/" class="text-decoration-none  pb-2 pb-md-0">Artikel</a>
                        @auth

                            <div id="auth-section" class="profile-auth ms-md-5 mx-md-0">
                                <div class="dropdown d-flex justify-content-end">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown">
                                        <span class="fw-bold">
                                            {{ Auth::user()->name }}
                                        </span>
                                        @if (Auth::user()->avatar != null)
                                            <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}"
                                                class="rounded-5 ms-1" 
                                                style="width: 42px; height: 42px; object-fit: cover;" 
                                                id="img-profile">
                                        @else
                                            <img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}"
                                                class="rounded-5 ms-1" 
                                                style="width: 42px; height: 42px; object-fit: cover;" 
                                                id="img-profile">
                                        @endif
                                    </button>

                                    <ul class="dropdown-menu mt-2 dropdown-logout">
                                        <div class="content-submenu">
                                        @if (!Request::routeIs('member.setting') && !Request::routeIs('member.setting.*') && !Request::routeIs('member.transaction') && !Request::routeIs('member.transaction.*') && !Request::routeIs('member.dashboard') && !Request::routeIs('member.dashboard.*'))
                                        <div class="col-sm-12 ps-0 pl-1 mb-1">
                                            <a href="{{ route('member.dashboard') }}">Kelas
                                                Saya</a>
                                        </div>
                                        <div class="col-sm-12 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.transaction') }}">Transaksi
                                                Saya</a>
                                        </div>
                                        <div class="col-sm-12 ps-0 pl-1 mb-1 pb-1 border-bottom">
                                            <a
                                                href="{{ route('member.setting') }}">Pengaturan</a>
                                        </div>
                                        @endif

                                        @if (auth::user()->role == 'superadmin' || auth::user()->role == 'mentor')
                                        <div class="col-sm-12 ps-0 pl-1 mb-1 pb-1 border-bottom">
                                            <a
                                                href="{{ route('admin.course') }}">Dashboard
                                                Admin</a>
                                        </div>
                                        @endif

                                        <div class="col-sm-12 ps-0 pl-1">
                                            <a href="{{ route('member.logout') }}"
                                                id="logout-btn">Logout</a>
                                        </div>
                                        </div>
                                    </ul>

                                </div>
                            </div>
                        @else
                            <div id="auth-section"
                                class="register-login d-flex align-items-center justify-content-end gap-2 ms-md-5">
                                <a href="{{ route('member.register') }}" class="btn btn-warning px-4 py-2">Daftar</a>
                                <a href="{{ route('member.login') }}" class="btn btn-secondary px-4 py-2">Masuk</a>
                            </div>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('navbarToggler').addEventListener('click', function() {
            console.log(this.ariaExpanded == 'false');
            if (this.ariaExpanded == 'true') {
                document.querySelector('header').setAttribute('style',
                    'background: white !important; box-shadow: 4px 0 8px black')
                document.querySelector('.backdrop-header').setAttribute('style', 'display: block')
            } else {
                document.querySelector('header').setAttribute('style', '')
                document.querySelector('.backdrop-header').setAttribute('style', 'display: none')
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggler = document.getElementById('navbarToggler');
        const iconOpened = document.getElementById('navbar-opened');
        const iconClosed = document.getElementById('navbar-closed');

        toggler.addEventListener('click', () => {
            // Toggle class "active" pada gambar
            if (toggler.getAttribute('aria-expanded') === 'true') {
                iconClosed.setAttribute('style', 'display: none');
                iconOpened.setAttribute('style', 'display: block');
            } else {
                iconClosed.setAttribute('style', 'display: block');
                iconOpened.setAttribute('style', 'display: none');
            }
        });
    });
</script>
<!-- end navbar -->
