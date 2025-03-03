<header>
    <nav class="navbar fixed-top bg-white px-2 px-md-5" id="navbar-id">
        <div class="container-fluid" style="flex-wrap: nowrap">
            <div class="sidebar" id="sidebar">
                <div class="me-3">
                    @if (Auth::user()->role == 'superadmin')
                        <p class="tittle-list-sidebar my-3">Lihat Data</p>
                        <a href="{{ route('admin.student') }}" style="background-color: transparent"
                            class="list-sidebar d-flex text-decoration-none text-black {{ request()->is('admin/data-users/student') ? 'active-sidebar' : '' }}">
                            <img src="{{ asset(request()->is('admin/data-users/student') ? 'nemolab/admin/img/datamember-active.svg' : 'nemolab/admin/img/datamember.svg') }}"
                                alt="" width="20" />
                            <p class="m-0">Data Student</p>
                        </a>
                        <a href="{{ route('admin.mentor') }}" style="background-color: transparent"
                            class="list-sidebar d-flex text-decoration-none text-black {{ request()->is('admin/data-users/mentor') ? 'active-sidebar' : '' }}">
                            <img src="{{ asset(request()->is('admin/data-users/mentor') ? 'nemolab/admin/img/datamentor-active.svg' : 'nemolab/admin/img/datamentor.svg') }}"
                                alt="" width="20" />
                            <p class="m-0">Data Mentor</p>
                        </a>
                        <a href="{{ route('admin.submissions') }}" style="background-color: transparent"
                            class="list-sidebar d-flex text-decoration-none text-black {{ request()->is('admin/data-users/submission') ? 'active-sidebar' : '' }}">
                            <img src="{{ asset(request()->is('admin/data-users/submission') ? 'nemolab/admin/img/datapengajuanmentor-active.svg' : 'nemolab/admin/img/datapengajuanmentor.svg') }}"
                                alt="" width="20" />
                            <p class="m-0">Pengajuan Mentor</p>
                        </a>
                    @endif
                    <p class="tittle-list-sidebar mt-3">Kursus</p>
                    <a href="{{ route('admin.course') }}" style="background-color: transparent"
                        class="list-sidebar d-flex text-decoration-none text-black {{ request()->is('admin/course') || request()->is('admin/course/create') || request()->is('admin/course/edit') || request()->is('admin/course/*/chapters') || request()->is('admin/course/*/chapter/*/lesson') ? 'active-sidebar' : '' }}">
                        <img src="{{ asset(request()->is('admin/course') || request()->is('admin/course/create') || request()->is('admin/course/edit') || request()->is('admin/course/*/chapters') || request()->is('admin/course/*/chapter/*/lesson') ? 'nemolab/admin/img/datakursus-active.svg' : 'nemolab/admin/img/datakursus.svg') }}"
                            alt="" width="20" />
                        <p class="m-0">Kursus Video</p>
                    </a>
                    <a href="{{ route('admin.ebook') }}" style="background-color: transparent"
                        class="list-sidebar d-flex text-decoration-none text-black {{ route('admin.ebook') }}" class="list-sidebar {{ request()->is('admin/ebooks') || request()->is('admin/ebooks/create') || request()->is('admin/ebooks/edit') ? 'active-sidebar' : '' }}">
                        <img src="{{ asset(request()->is('admin/ebooks') || request()->is('admin/ebooks/create') || request()->is('admin/ebooks/edit') ? 'nemolab/admin/img/dataebook-active.svg' : 'nemolab/admin/img/dataebook.svg') }}"
                            alt="" width="20" />
                        <p class="m-0">Kursus Ebook</p>
                    </a>

                    <a href="{{ route('admin.paket-kelas') }}" style="background-color: transparent"
                        class="list-sidebar d-flex text-decoration-none text-black {{ request()->is('admin/paket-kelas') ? 'active-sidebar' : '' }}">
                        <img src="{{ asset(request()->is('admin/paket-kelas') ? 'nemolab/admin/img/datapaket-active.svg' : 'nemolab/admin/img/datapaket.svg') }}"
                            alt="" width="20" />
                        <p class="m-0">Paket Video Ebook</p>
                    </a>

                    <a href="{{ route('admin.tools') }}" style="background-color: transparent"
                        class="list-sidebar d-flex text-decoration-none text-black {{ request()->is('admin/tools') ? 'active-sidebar' : '' }}">
                        <img src="{{ asset(request()->is('admin/tools') ? 'nemolab/admin/img/datatools-active.svg' : 'nemolab/admin/img/datatools.svg') }}"
                            alt="" width="20" />
                        <p class="m-0">Tools</p>
                    </a>

                    <a href="{{ route('admin.diskon-kelas') }}" style="background-color: transparent"
                        class="list-sidebar d-flex text-decoration-none text-black {{ request()->is('admin/diskon-kelas') ? 'active-sidebar' : '' }}">
                        <img src="{{ asset(request()->is('admin/diskon-kelas') ? 'nemolab/admin/img/datadiskon-active.svg' : 'nemolab/admin/img/datadiskon.svg') }}"
                            alt="" width="20" />
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
                            <p class="m-0 p-0 fw-bold">Nemolab</p>
                            <p class="m-0 p-0 ">Kursus Online Terbaik</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="dropdown d-block">
                <button class="btn d-flex align-items-center ms-2 border-0 " type="button" data-bs-toggle="dropdown">
                    <p class="fw-semibold m-0" style="font-size: 14px">{{ Auth::user()->name }}</p>
                    @if (Auth::user()->avatar != null)
                        <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}"
                            class="rounded-5 ms-1" 
                            style="width: 36px; height: 36px; object-fit: cover;" 
                            id="img-profile">
                    @else
                        <img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}"
                            class="rounded-5 ms-1" 
                            style="width: 36px; height: 36px; object-fit: cover;" 
                            id="img-profile">
                    @endif
                </button>

                <!-- Profile Menu -->
                <ul class="dropdown-menu mt-2 ">
                    <div class="content-submenu">
                            <a  href="{{ route('admin.logout') }}"
                                id="logout-btn">Logout</a>
                    </div>
                </ul>
            </div>
        </div>
        </div>
    </nav>

</header>
