<div class="col-3 d-none d-lg-block p-4 rounded-4 text-white scroll-sidebar" style="background-color: #faa907"
    id="sidebar-id">
    @if (Auth::user()->role == 'superadmin')
        <p class="tittle-list-sidebar my-3">Lihat Data</p>
        <a href="{{ route('admin.student') }}"
            class="list-sidebar {{ request()->is('admin/data-users/student') ? 'active' : '' }}">
            <img src="{{ asset(request()->is('admin/data-users/student') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember.png') }}"
                alt="" width="30" />
            <p class="m-0">Data student</p>
        </a>
        <a href="{{ route('admin.mentor') }}"
            class="list-sidebar {{ request()->is('admin/data-users/mentor') ? 'active' : '' }}">
            <img src="{{ asset(request()->is('admin/data-users/mentor') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember.png') }}"
                alt="" width="30" />
            <p class="m-0">Data Mentor</p>
        </a>
        <a href="{{ route('admin.superadmin') }}"
            class="list-sidebar {{ request()->is('admin/data-users/superadmin') ? 'active' : '' }}">
            <img src="{{ asset(request()->is('admin/data-users/superadmin') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember.png') }}"
                alt="" width="30" />
            <p class="m-0">Data Super Admin</p>
        </a>
        <a href="{{ route('admin.pengajuan') }}"
            class="list-sidebar {{ request()->is('admin/kirim-pengajuan/users') ? 'active' : '' }}">
            <img src="{{ asset(request()->is('admin/kirim-pengajuan/users') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember.png') }}"
                alt="" width="30" />
            <p class="m-0">Pengajuan Mentor</p>
        </a>
    @endif
    <p class="title-list-sidebar mt-3">Kursus</p>
    <a href="{{ route('admin.course') }}" class="list-sidebar {{ request()->is('admin/course') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin/course') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}"
            alt="" width="30" />
        <p class="m-0">Kursus Video</p>
    </a>

    <a href="{{ route('admin.ebook') }}" class="list-sidebar {{ request()->is('admin/ebooks') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin/ebooks') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}"
            alt="" width="30" />
        <p class="m-0">Kursus Ebook</p>
    </a>

    <a href="{{ route('admin.paket-kelas') }}"
        class="list-sidebar {{ request()->is('admin/paket-kelas') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin/paket-kelas') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}"
            alt="" width="30" />
        <p class="m-0">Paket Video Ebook</p>
    </a>

    <a href="{{ route('admin.tools') }}" class="list-sidebar {{ request()->is('admin/tools') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin/tools') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}"
            alt="" width="30" />
        <p class="m-0">Tools</p>
    </a>

    <a href="{{ route('admin.diskon-kelas') }}"
        class="list-sidebar {{ request()->is('admin/diskon-kelas') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin/diskon-kelas') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}"
            alt="" width="30" />
        <p class="m-0">Atur Diskon</p>
    </a>

</div>
