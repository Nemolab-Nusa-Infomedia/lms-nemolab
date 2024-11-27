<!-- navbar -->
<header class="ps-3 pe-3 pt-2 pb-2 w-100 fixed-top position-fixed bg-white shadow-sm">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-transparent">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a href="{{ route('home') }}" style="text-decoration: none;">
                        <div class="brand-nemolab-icon d-flex align-items-center">
                            <img src="{{ asset('nemolab/member/img/logo-nemolab.png') }}" alt="Logo" width="40"
                                height="40" class="d-inline-block align-text-top">
                            <div class="title-navbar-brand ms-2 d-block">
                                <p class="m-0 p-0 fw-bold">Nemolab</p>
                                <p class="m-0 p-0 fw-bold">Kursus Online Terbaik</p>
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

                <div class="collapse navbar-collapse  my-3 my-md-0" id="navbarNavAltMarkup">
                    <ul class="navbar-nav d-flex mx-auto">
                        <form action="{{ route('member.course') }}" method="GET" class="d-lg-flex d-none"
                            role="search">
                            <div class="search-group d-flex">
                                <input class="" type="text" name="search-input" placeholder="Cari Kelas Disini"
                                    id="search-input" value="{{ request('search-input') }}" aria-label="Search">
                                <button class="btn p-0 m-0" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"
                                            fill="#414142">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </ul>
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

                        <div class="profile-auth ms-lg-5 mx-lg-0">
                            <div class="dropdown d-flex justify-content-end">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown">
                                    <span class="fw-bold">
                                        {{ Auth::user()->name }}
                                    </span>
                                    @if (Auth::user()->avatar != null)
                                        <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}"
                                            class="rounded-5 ms-1" style="width: 42px; height: 42px;"
                                            id="img-profile">
                                    @else
                                        <img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}"
                                            class="rounded-5 ms-1" style="width: 42px; height: 42px;"
                                            id="img-profile">
                                    @endif
                                </button>

                                <ul class="dropdown-menu w-100 mt-2 dropdown-logout">
                                    @if (!Request::routeIs('member.setting') && !Request::routeIs('member.setting.*'))
                                        <li><a class="dropdown-item" href="{{ route('member.dashboard') }}">Kelas
                                                Saya</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('member.transaction') }}">Transaksi
                                                Saya</a></li>
                                        <li class="border-bottom pb-3"><a class="dropdown-item"
                                                href="{{ route('member.setting') }}">Pengaturan</a>
                                        </li>
                                    @endif
                                    <li class="mt-2">
                                        <a class="dropdown-item" href="{{ route('member.logout') }}"
                                            id="logout-btn">Logout</a>
                                    </li>
                                </ul>

                            </div>
                        </div>

                    </ul>
                </div>
            </div>
        </nav>

    </div>
</header>
