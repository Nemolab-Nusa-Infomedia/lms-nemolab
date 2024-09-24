{{-- @push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/admin/navbar.css') }} ">
@endpush --}}

<nav class="navbar fixed-top bg-white px-5" id="navbar-id">
    <div class="container-fluid py-2" style="flex-wrap: nowrap">
        <div class="sidebar" id="sidebar">
            <div class="ms-3 me-3">
                @if (Auth::user()->role == 'superadmin')
                    <p class="tittle-list-sidebar my-3">Lihat Data</p>
                    <a href="{{ route('admin.member') }}" style="background-color: transparent"
                        class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/user/member') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin/user/member') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Data Anggota</p>
                    </a>
                    <a href="{{ route('admin.mentor') }}" style="background-color: transparent"
                        class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/user/mentor') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin/user/mentor') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Data Mentor</p>
                    </a>
                    <a href="{{ route('admin.superadmin') }}" style="background-color: transparent"
                        class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/user/superadmin') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin/user/superadmin') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Data Super Admin</p>
                    </a>
                    <a href="{{ route('admin.submissions') }}" style="background-color: transparent"
                        class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/submission') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin/submission') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Pengajuan Mentor</p>
                    </a>
                @endif
                <p class="tittle-list-sidebar mt-3">Kursus</p>
                <a href="{{ route('admin.course') }}" style="background-color: transparent"
                    class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin') ? 'active' : '' }}">
                    <img src="{{ asset(request()->is('admin') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses-active.png') }}"
                        alt="" width="30" />
                    <p class="m-0">Kursus Video</p>
                </a>

                <a href="{{ route('admin.category') }}" style="background-color: transparent"
                    class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/category') ? 'active' : '' }}">
                    <img src="{{ asset(request()->is('admin/category') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses-active.png') }}"
                        alt="" width="30" />
                    <p class="m-0">Kategori</p>
                </a>
                <a href="{{ route('admin.transaction') }}" style="background-color: transparent"
                    class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/course/transaction') ? 'active' : '' }}">
                    <img src="{{ asset(request()->is('admin/course/transaction') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses-active.png') }}"
                        alt="" width="30" />
                    <p class="m-0">Transaksi</p>
                </a>
                <a href="{{ route('admin.tools') }}" style="background-color: transparent"
                    class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/tools') ? 'active' : '' }}">
                    <img src="{{ asset(request()->is('admin/tools') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses-active.png') }}"
                        alt="" width="30" />
                    <p class="m-0">Alat</p>
                </a>
                <a href="{{ route('admin.forum') }}" style="background-color: transparent"
                class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/course/forum') ? 'active' : '' }}">
                <img src="{{ asset(request()->is('admin/course/forum') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses-active.png') }}"
                    alt="" width="30" />
                <p class="m-0">Forum</p>
                </a>
                <p class="tittle-list-sidebar mt-3">Lihat Data</p>
                <a href="{{ route('admin.portofolio') }}" style="background-color: transparent"
                    class="list-sidebar d-flex ms-3 text-decoration-none text-black {{ request()->is('admin/portofolio') ? 'active' : '' }}">
                    <img src="{{ asset(request()->is('admin/portofolio') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                        alt="" width="30" />
                    <p class="m-0">Data Portofolio</p>
                </a>
            </div>
        </div>
            <button class="toggle-btn d-block d-lg-none" id="toggleBtn" onclick="toggleSidebar()">
                <img id="openIcon" src="{{asset('nemolab/admin/img/menus.png')}}" alt="Open Sidebar">
                <img id="closeIcon" src="{{asset('nemolab/admin/img/close2.png')}}" alt="Close Sidebar" class="hidden">
            </button>
        <div class="d-none d-lg-flex align-items-center gap-4">
            <a href="{{ route('home') }}"><img src="{{ asset('nemolab/admin/img/Logo Nemolab.png') }}" alt="Logo" width="110" /></a>
        </div>

        <div class="user-login ms-5 d-flex align-items-center gap-3">
            <p class="fw-semibold m-0">{{ Auth::user()->name }}</p>
            @if (Auth::user()->avatar != 'default.png')
            <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" alt="" width="40" height="40"
                class="d-md-block  border border-2 rounded-circle" id="myProfile" style="cursor: pointer"/>
            @else
            <img src="{{ asset('nemolab/admin/img/avatar.png') }}" alt="" width="40" height="40"
                class="d-md-block border border-2 rounded-circle" id="myProfile"/>
            @endif
            <!-- Profile Menu -->
            <div class="profile-user border border-2 rounded-2 overflow-hidden" id="profileMenu">
                {{-- <a href="{{ route('admin.setting') }}"
                    class="bg-white px-3 py-2 d-flex align-items-center text-decoration-none text-black-50 item fw-semibold m-0 w-100 fw-bold">
                    Setting
                </a> --}}
                <a href="{{ route('admin.logout') }}"
                    class="bg-white px-3 py-2 d-flex align-items-center text-decoration-none text-black-50 item fw-semibold m-0 w-100 fw-bold">
                    Keluar
                </a>
            </div>
        </div>
    </div>
</nav>
