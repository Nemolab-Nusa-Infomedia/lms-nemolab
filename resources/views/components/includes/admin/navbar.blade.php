<header>
    <nav class="navbar fixed-top bg-white px-5" id="navbar-id">
        <div class="container-fluid py-2" style="flex-wrap: nowrap">
            <div class="sidebar" id="sidebar">
                <div class="ms-3 me-3">
                    @if (Auth::user()->role == 'superadmin')
                        <p class="tittle-list-sidebar my-3">Lihat Data</p>
                        <a href="{{ route('admin.student') }}" style="background-color: transparent"
                            class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/data-users/student') ? 'active' : '' }}">
                            <img src="{{ asset(request()->is('admin/data-users/student') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                                alt="" width="30" />
                            <p class="m-0">Data Anggota</p>
                        </a>
                        <a href="{{ route('admin.mentor') }}" style="background-color: transparent"
                            class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/data-users/mentor') ? 'active' : '' }}">
                            <img src="{{ asset(request()->is('admin/data-users/mentor') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                                alt="" width="30" />
                            <p class="m-0">Data Mentor</p>
                        </a>
                        <a href="{{ route('admin.superadmin') }}" style="background-color: transparent"
                            class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/data-users/superadmin') ? 'active' : '' }}">
                            <img src="{{ asset(request()->is('admin/data-users/superadmin') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                                alt="" width="30" />
                            <p class="m-0">Data Super Admin</p>
                        </a>
                        <a href="{{ route('admin.submissions') }}" style="background-color: transparent"
                            class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/data-users/submission') ? 'active' : '' }}">
                            <img src="{{ asset(request()->is('admin/data-users/submission') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                                alt="" width="30" />
                            <p class="m-0">Pengajuan Mentor</p>
                        </a>
                    @endif
                    <p class="title-list-sidebar mt-3">Kursus</p>
                    <a href="{{ route('admin.course') }}" style="background-color: transparent"
                        class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/course') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin/course') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Kursus Video</p>
                    </a>
                    <a href="{{ route('admin.ebook') }}" style="background-color: transparent"
                        class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/ebooks') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin/ebooks') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Kursus Ebook</p>
                    </a>

                    <a href="{{ route('admin.paket-kelas') }}" style="background-color: transparent"
                        class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/paket-kelas') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin/paket-kelas') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Paket Video Ebook</p>
                    </a>

                    <a href="{{ route('admin.tools') }}" style="background-color: transparent"
                        class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/tools') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin/tools') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Tools</p>
                    </a>

                    <a href="{{ route('admin.diskon-kelas') }}" style="background-color: transparent"
                        class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/diskon-kelas') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin/diskon-kelas') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Atur Diskon</p>
                    </a>
                </div>
            </div>
            <button class="toggle-btn d-block d-lg-none" id="toggleBtn" onclick="toggleSidebar()">
                <span class="">
                    <img src="/nemolab/member/img/icon-nav.png" alt="">
                </span>
            </button>
            <div class="d-none d-lg-flex align-items-center" id="logo-group">
                <a href="{{ route('home') }}" style="text-decoration: none;">
                    <div class="brand-nemolab-icon d-flex align-items-center">
                        <img src="{{ asset('nemolab/member/img/logo-nemolab.png') }}" alt="Logo" width="40"
                            height="40" class="d-inline-block align-text-top">
                        <div class="title-navbar-brand ms-2 d-block">
                            <p class="m-0 p-0 fw-bold" style="font-size: 20px;">Nemolab</p>
                            <p class="m-0 p-0 ">Kursus Online Terbaik</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="dropdown d-block">
                <button class="btn d-flex align-items-center ms-2 border-0 " type="button" data-bs-toggle="dropdown">
                    <p class="fw-semibold m-0">{{ Auth::user()->name }}</p>
                    @if (Auth::user()->avatar != null)
                        <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" class="rounded-5 ms-1"
                            style="width: 42px; height: 42px;" id="img-profile">
                    @else
                        <img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}" class="rounded-5 ms-1"
                            style="width: 42px; height: 42px;" id="img-profile">
                    @endif
                </button>

                <!-- Profile Menu -->
                <ul class="dropdown-menu mt-2 ">
                    <li class="mt-2">
                        <a class="dropdown-item" href="{{ route('member.logout') }}" id="logout-btn">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        </div>
    </nav>

</header>
