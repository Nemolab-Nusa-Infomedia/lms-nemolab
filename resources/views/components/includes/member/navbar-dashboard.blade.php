<!-- navbar -->
<header class="ps-3 pe-3 pt-2 pb-2 w-100 fixed-top position-fixed bg-white shadow-sm">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-transparent">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a href="{{ route('home') }}" style="text-decoration: none;">
                        <div class="brand-nemolab-icon d-flex align-items-center">
                            <img src="{{ asset('nemolab/member/img/logo-nemolab.png') }}" alt="Logo" width="40" height="40"
                                class="d-inline-block align-text-top">
                            <div class="title-navbar-brand ms-2 d-block">
                                <p class="m-0 p-0 fw-bold">Nemolab</p>
                                <p class="m-0 p-0 ">Kursus Online Terbaik</p>
                            </div>
                        </div>
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation" id="navbarToggler">
                    <span class="navbar-icon">
                        <img src="{{ asset('nemolab/member/img/icon-nav.png') }}" alt="Icon" id="navbarIcon">
                    </span>
                </button>

                <div class="collapse navbar-collapse justify-content-end my-3 my-md-0" id="navbarNavAltMarkup">
                    <ul class="navbar-nav d-lg-flex align-items-lg-center gap-lg-4 ps-xl-5">
                        <div class="dropdown dropdown-pilih-kelas">
                            <button
                                class="btn btn-secondary dropdown-toggle d-flex align-items-center p-0 pt-2 pt-lg-0 pb-2 pb-lg-0"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pilih Kelas
                                <box-icon name='chevron-down' color="#414142"></box-icon>
                            </button>
                            <ul class="dropdown-menu mt-lg-3 mb-3">
                                <div class="head-submenu d-flex justify-content-between align-items-center">
                                    <p class="m-0 p-0 fw-bold">Pilihan Kelas</p>
                                    <a href="{{ route('member.course') }}" class="m-0 p-0">Lihat Semua</a>
                                </div>
                                <div class="content-submenu mt-2 ">
                                    <div class="row m-0 ">
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a href="{{ route('member.course', ['filter-kelas' => 'UI/UX Designer']) }}">UI UX Designer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a href="{{ route('member.course', ['filter-kelas' => 'Frontend Developer']) }}">Frontend Developer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a href="{{ route('member.course', ['filter-kelas' => 'Wordpress Developer']) }}">Wordpress Developer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a href="{{ route('member.course', ['filter-kelas' => 'Backend Developer']) }}">Backend Developer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'Grapics Designer']) }}">Grapics
                                                Designer</a>
                                        </div>
                                        <div class="col-12 col-sm-6 ps-0 pl-1 mb-1">
                                            <a
                                                href="{{ route('member.course', ['filter-kelas' => 'Fullstack Developer']) }}">Fullstack Developer</a>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <div class="dropdown dropdown-pilih-paket-kelas">
                            <button class="btn btn-secondary dropdown-toggle d-flex align-items-center p-0 pb-2 pb-lg-0"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Paket Kelas
                                <box-icon name='chevron-down' color="#414142"></box-icon>
                            </button>
                            <ul class="dropdown-menu mt-lg-3 mb-3">
                                <div class="head-submenu d-flex justify-content-between align-items-center">
                                    <p class="m-0 p-0 fw-bold">Pilihan Paket Kelas</p>
                                    <a href="{{ route('member.course') }}" class="m-0 p-0">Lihat Semua</a>
                                </div>
                                <div class="content-submenu mt-2 ">
                                    <div class="row m-0">
                                        <div class="col-sm-12 ps-0 pl-1 mb-1">
                                            <a href="{{ route('member.course', ['filter-paket' => 'paket-kursus']) }}">Course</a>
                                        </div>
                                        <div class="col-sm-12 ps-0 pl-1 mb-1">
                                            <a href="{{ route('member.course', ['filter-paket' => 'paket-ebook']) }}">Ebook</a>
                                        </div>
                                        <div class="col-sm-12 ps-0 pl-1 mb-1">
                                            <a href="{{ route('member.course', ['filter-paket' => 'paket-bundling']) }}">Paket Combo</a>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <a href="https://blog.nemolab.id/" class="text-decoration-none  pb-2 pb-lg-0">Artikel</a>

                        <div class="register-login d-flex align-items-center justify-content-end gap-2 ms-lg-5">
                            <a href="{{ route('member.register') }}" class="btn btn-primary px-4 py-2">Daftar</a>
                            <a href="{{ route('member.login') }}" class="btn btn-secondary px-4 py-2">Masuk</a>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- end navbar -->