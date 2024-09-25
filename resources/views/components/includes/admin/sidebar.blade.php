<div class="col-3 d-none d-lg-block p-4 rounded-4 text-white scroll-sidebar" style="background-color: #faa907"
    id="sidebar-id">
    @if (Auth::user()->role == 'superadmin')
        <p class="tittle-list-sidebar my-3">Lihat Data</p>
        <a href="{{ route('admin.member') }}"
            class="list-sidebar {{ request()->is('admin/user/member') ? 'active' : '' }}">
            <img src="{{ asset(request()->is('admin/user/member') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember.png') }}"
                alt="" width="30" />
            <p class="m-0">Data Anggota</p>
        </a>
        <a href="{{ route('admin.mentor') }}"
            class="list-sidebar {{ request()->is('admin/user/mentor') ? 'active' : '' }}">
            <img src="{{ asset(request()->is('admin/user/mentor') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember.png') }}"
                alt="" width="30" />
            <p class="m-0">Data Mentor</p>
        </a>
        <a href="{{ route('admin.superadmin') }}"
            class="list-sidebar {{ request()->is('admin/user/superadmin') ? 'active' : '' }}">
            <img src="{{ asset(request()->is('admin/user/superadmin') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember.png') }}"
                alt="" width="30" />
            <p class="m-0">Data Super Admin</p>
        </a>
        <a href="{{ route('admin.submissions') }}"
            class="list-sidebar {{ request()->is('admin/submission') ? 'active' : '' }}">
            <img src="{{ asset(request()->is('admin/submission') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember.png') }}"
                alt="" width="30" />
            <p class="m-0">Pengajuan Mentor</p>
        </a>
    @endif
    <p class="tittle-list-sidebar mt-3">Kursus</p>
    <a href="{{ route('admin.course') }}" class="list-sidebar {{ request()->is('admin') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}"
            alt="" width="30" />
        <p class="m-0">Kursus Video</p>
    </a>

    <a href="{{ route('admin.category') }}"
        class="list-sidebar {{ request()->is('admin/category') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin/category') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}"
            alt="" width="30" />
        <p class="m-0">Kategori</p>
    </a>
    <a href="{{ route('admin.transaction') }}"
        class="list-sidebar {{ request()->is('admin/course/transaction') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin/course/transaction') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}"
            alt="" width="30" />
        <p class="m-0">Transaksi</p>
    </a>
    <a href="{{ route('admin.tools') }}" class="list-sidebar {{ request()->is('admin/tools') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin/tools') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}"
            alt="" width="30" />
        <p class="m-0">Alat</p>
    </a>
    <a href="{{ route('admin.forum') }}" class="list-sidebar {{ request()->is('admin/course/forum') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin/course/forum') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}"
            alt="" width="30" />
        <p class="m-0">Forum</p>
    </a>
    <p class="tittle-list-sidebar mt-3">Lihat Data</p>
    <a href="{{ route('admin.portofolio') }}"
        class="list-sidebar {{ request()->is('admin/portofolio') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin/portofolio') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember.png') }}"
            alt="" width="30" />
        <p class="m-0">Data Portofolio</p>
    </a>
</div>

{{-- <div class="container-sm pt-3 pb-3 d-block d-lg-none" style="height: auto;">
    <div class="content2 row top justify-content-between mx-auto mt-1">
        <div class="dropdown d-block d-lg-none">
            <a class="dropdown-toggle text-black fs-5" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Sidebar
            </a>

            <ul class="dropdown-menu" id="dropdown">
                <div class="ms-3 me-3">
                    @if (Auth::user()->role == 'superadmin')
                        <p class="tittle-list-sidebar my-3">View Data</p>
                        <a href="{{ route('admin.member') }}"
                            class="list-sidebar ms-3 text-decoration-none text-black {{ request()->is('admin/user/member') ? 'active' : '' }}">
                            <img src="{{ asset(request()->is('admin/user/member') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                                alt="" width="30" />
                            <p class="m-0">Member Data</p>
                        </a>
                        <a href="{{ route('admin.mentor') }}"
                            class="list-sidebar ms-3 text-decoration-none text-black {{ request()->is('admin/user/mentor') ? 'active' : '' }}">
                            <img src="{{ asset(request()->is('admin/user/mentor') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                                alt="" width="30" />
                            <p class="m-0">Mentor Data</p>
                        </a>
                        <a href="{{ route('admin.superadmin') }}"
                            class="list-sidebar ms-3 text-decoration-none text-black {{ request()->is('admin/user/superadmin') ? 'active' : '' }}">
                            <img src="{{ asset(request()->is('admin/user/superadmin') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                                alt="" width="30" />
                            <p class="m-0">Super Admin Data</p>
                        </a>
                        <a href="{{ route('admin.submissions') }}"
                            class="list-sidebar ms-3 text-decoration-none text-black {{ request()->is('admin/submission') ? 'active' : '' }}">
                            <img src="{{ asset(request()->is('admin/submission') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                                alt="" width="30" />
                            <p class="m-0">Mentor Submission</p>
                        </a>
                    @endif
                    <p class="tittle-list-sidebar mt-3">Course</p>
                    <a href="{{ route('admin.course') }}"
                        class="list-sidebar ms-3 text-decoration-none text-black {{ request()->is('admin') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Video Courses</p>
                    </a>

                    <a href="{{ route('admin.category') }}"
                        class="list-sidebar ms-3 text-decoration-none text-black {{ request()->is('admin/category') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin/category') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Category</p>
                    </a>
                    <a href="{{ route('admin.transaction') }}"
                        class="list-sidebar ms-3 text-decoration-none text-black {{ request()->is('admin/course/transaction') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin/course/transaction') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Transactions</p>
                    </a>
                    <a href="{{ route('admin.tools') }}"
                        class="list-sidebar ms-3 text-decoration-none text-black {{ request()->is('admin/tools') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin/tools') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Tools</p>
                    </a>
                    <a href="{{ route('admin.forum') }}"
                    class="list-sidebar ms-3 text-decoration-none text-black {{ request()->is('admin/course/forum') ? 'active' : '' }}">
                    <img src="{{ asset(request()->is('admin/course/forum') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses-active.png') }}"
                        alt="" width="30" />
                    <p class="m-0">Forums</p>
                    </a>
                    <p class="tittle-list-sidebar mt-3">View Data</p>
                    <a href="{{ route('admin.portofolio') }}"
                        class="list-sidebar ms-3 text-decoration-none text-black {{ request()->is('admin/portofolio') ? 'active' : '' }}">
                        <img src="{{ asset(request()->is('admin/portofolio') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                            alt="" width="30" />
                        <p class="m-0">Portofolio Data</p>
                    </a>
                </div>
            </ul>
        </div>
    </div>
</div> --}}
