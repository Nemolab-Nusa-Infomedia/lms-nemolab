<div class="col-3 d-none d-lg-block rounded-4 px-0 text-white scroll-sidebar"
    id="sidebar-id">
    @if (Auth::user()->role == 'superadmin')
        <p class="tittle-list-sidebar my-3">Lihat Data</p>
        <a href="{{ route('admin.student') }}"
            class="list-sidebar {{ request()->is('admin/data-users/student') ? 'active-sidebar' : '' }}">
            <img src="{{ asset(request()->is('admin/data-users/student') ? 'nemolab/admin/img/datamember-active.svg' : 'nemolab/admin/img/datamember.svg') }}"
                alt="" width="20" />
            <p class="m-0">Data student</p>
        </a>
        <a href="{{ route('admin.mentor') }}"
            class="list-sidebar {{ request()->is('admin/data-users/mentor') ? 'active-sidebar' : '' }}">
            <img src="{{ asset(request()->is('admin/data-users/mentor') ? 'nemolab/admin/img/datamentor-active.svg' : 'nemolab/admin/img/datamentor.svg') }}"
                alt="" width="20" />
            <p class="m-0">Data Mentor</p>
        </a>
        <a href="{{ route('admin.pengajuan') }}"
            class="list-sidebar {{ request()->is('admin/kirim-pengajuan/users') ? 'active-sidebar' : '' }}">
            <img src="{{ asset(request()->is('admin/kirim-pengajuan/users') ? 'nemolab/admin/img/datapengajuanmentor-active.svg' : 'nemolab/admin/img/datapengajuanmentor.svg') }}"
                alt="" width="20" />
            <p class="m-0">Pengajuan Mentor</p>
        </a>
    @endif
    <p class="tittle-list-sidebar mt-3">Kursus</p>
    <a href="{{ route('admin.course') }}" class="list-sidebar {{ request()->is('admin/course') || request()->is('admin/course/create') || request()->is('admin/course/edit') || request()->is('admin/course/*/chapters') || request()->is('admin/course/*/chapter/*/lesson') ? 'active-sidebar' : '' }}">
        <img src="{{ asset(request()->is('admin/course') || request()->is('admin/course/create') || request()->is('admin/course/edit') || request()->is('admin/course/*/chapters') || request()->is('admin/course/*/chapter/*/lesson') ? 'nemolab/admin/img/datakursus-active.svg' : 'nemolab/admin/img/datakursus.svg') }}"
            alt="" width="20" />
        <p class="m-0">Kursus Video</p>
    </a>

    <a href="{{ route('admin.ebook') }}" class="list-sidebar {{ request()->is('admin/ebooks') || request()->is('admin/ebooks/create') || request()->is('admin/ebooks/edit') ? 'active-sidebar' : '' }}">
        <img src="{{ asset(request()->is('admin/ebooks') || request()->is('admin/ebooks/create') || request()->is('admin/ebooks/edit') ? 'nemolab/admin/img/dataebook-active.svg' : 'nemolab/admin/img/dataebook.svg') }}"
            alt="" width="20" />
        <p class="m-0">Kursus Ebook</p>
    </a>

    <a href="{{ route('admin.paket-kelas') }}"
        class="list-sidebar {{ request()->is('admin/paket-kelas') ? 'active-sidebar' : '' }}">
        <img src="{{ asset(request()->is('admin/paket-kelas') ? 'nemolab/admin/img/datapaket-active.svg' : 'nemolab/admin/img/datapaket.svg') }}"
            alt="" width="20" />
        <p class="m-0">Paket Video Ebook</p>
    </a>

    <a href="{{ route('admin.tools') }}" class="list-sidebar {{ request()->is('admin/tools') ? 'active-sidebar' : '' }}">
        <img src="{{ asset(request()->is('admin/tools') ? 'nemolab/admin/img/datatools-active.svg' : 'nemolab/admin/img/datatools.svg') }}"
            alt="" width="20" />
        <p class="m-0">Tools</p>
    </a>

    <a href="{{ route('admin.diskon-kelas') }}"
        class="list-sidebar {{ request()->is('admin/diskon-kelas') ? 'active-sidebar' : '' }}">
        <img src="{{ asset(request()->is('admin/diskon-kelas') ? 'nemolab/admin/img/datadiskon-active.svg' : 'nemolab/admin/img/datadiskon.svg') }}"
            alt="" width="20" />
        <p class="m-0">Atur Diskon</p>
    </a>

</div>
