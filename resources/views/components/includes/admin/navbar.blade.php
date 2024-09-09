{{-- @push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/admin/navbar.css') }} ">
@endpush --}}

<nav class="navbar fixed-top bg-white px-5" id="navbar-id">
    <div class="container-fluid py-2">
        <div class="d-flex align-items-center gap-4">
            <a href="{{ route('home') }}"><img src="{{ asset('nemolab/admin/img/Logo Nemolab.png') }}" alt="Logo" width="110" /></a>
        </div>

        <div class="user-login d-flex align-items-center gap-3">
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
                    Logout
                </a>
            </div>
        </div>
    </div>
</nav>
