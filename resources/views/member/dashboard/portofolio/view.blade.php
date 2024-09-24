@extends('components.layouts.member.dashboard')

@section('title', 'My Portofolio')


@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
    <style>
        @media only screen and (max-width: 992px) {
    .profile-btn.btn {
        background-color: #faa907;
    }
    .profile-btn.btn:active {
        background-color: #d89309;
    }
    .sidebar-mobile {
        display: none !important;
    }
    .sidebar-mobile.active {
        display: block !important;
        z-index: 999;
        position: absolute;
        width: 100%;
        bottom: 0;
        left: 0;
        max-height: 60vh;
        border-radius: 50px 50px 0 0;
        background: #fff;
    }
    .nav a {
        color: #6c757d !important;
    }
    .nav-item img {
        filter: grayscale(100%) brightness(70%);
    }
    .nav-item.active,
    .nav-item.active img {
        filter: none;
        color: #faa907 !important;
        font-weight: 600;
        padding: 0;
        gap: 0;
    }

}
    </style>
@endpush

@section('content')
    <div class="container" style="margin-top: 5rem;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-3 d-none d-lg-block p-4 pb-5 rounded-4 text-white px-5 flex-wrap"
                style="background-color: #faa907;">
                @if (Auth::user()->avatar != 'default.png')
                    <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" style="border-radius: 100%;"
                        alt="" width="70" height="70" class="d-flex mx-lg-auto mt-3" />
                @else
                    <img src="{{ asset('nemolab/admin/img/avatar.png') }}" style="border-radius: 100%;" alt=""
                        width="70" height="70" class="d-flex mx-lg-auto mt-3" />
                @endif
                <h4 class="m-0 mt-lg-5 mt-3 fw-semibold">{{ Auth::user()->name }}</h4>
                <p class="m-0 fw-light">Status {{ Auth::user()->role }}</p>
                <div class="mt-5">
                    <a href="{{ route('member.dashboard') }}" class="list-sidebar">
                        <img src="{{ asset('nemolab/member/img/course.png') }}" alt="" width="30" />
                        <p class="m-0">Kursus Saya</p>
                    </a>
                    <a href="#" class="list-sidebar active">
                        <img src="{{ asset('nemolab/member/img/portofolio active.png') }}" alt="" width="30" />
                        <p class="m-0">Portofolio Saya</p>
                    </a>
                    <a href="{{ route('member.transaction') }}" class="list-sidebar">
                        <img src="{{ asset('nemolab/member/img/transaksi.png') }}" alt="" width="30" />
                        <p class="m-0">Transaksi Saya</p>
                    </a>
                </div>
            </div>
            <!-- End Sidebar -->

            <!-- My Profil -->
            <div class="col-lg-9 col-md-9 col-12 mx-auto mx-lg-0 ps-lg-5 ps-3">
                <div class="d-block d-lg-none">
                    <div id="profile" class="fw-medium">
                        <button class="profile-btn btn fw-medium text-white">Profil Saya</button>
                    </div>
                    <div class="sidebar-mobile p-5 d-none border border-2">
                        <div class="d-flex gap-3 align-items-center">
                            <div>
                                @if (Auth::user()->avatar != 'default.png')
                                <img
                                    src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}"
                                    alt=""
                                    width="60" height="60" class="rounded-circle"
                                />
                                @else
                                <img
                                    src="{{ asset('nemolab/member/img/avatar.png') }}"
                                    alt=""
                                    width="60" height="60"
                                />
                                @endif
                            </div>
                            <div class="text-dark">
                                <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                                <p class="m-0 fw-light">Status {{ Auth::user()->role }}</p>
                            </div>
                        </div>
                        <div class="nav mt-4 d-flex flex-column gap-3 fw-medium text-secondary">
                            <a href="{{ route('member.dashboard') }}" class="nav-item">
                                <img
                                    src="{{ asset('nemolab/member/img/course active.png') }}"
                                    alt=""
                                    width="30"
                                    class="me-2"
                                /> Kursus Saya
                            </a>
                            <a href="#" class="nav-item active">
                                <img
                                    src="{{ asset('nemolab/member/img/portofolio active.png') }}"
                                    alt=""
                                    width="30"
                                    class="me-2"
                                />Portofolio Saya
                            </a>
                            <a href="{{ route('member.transaction') }}" class="nav-item">
                                <img
                                    src="{{ asset('nemolab/member/img/transaksi active.png') }}"
                                    alt=""
                                    width="30"
                                    class="me-2"
                                />Transaksi Saya
                            </a>
                        </div>
                        <div class="mt-4">
                            <button id="tutup"
                                class="profile-btn btn rounded-5 w-100 fw-medium text-white"
                                type="button"
                            >
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
                <div class="my-4">
                    <h3 class="fw-semibold" style="color: #faa907">Portofolio Saya</h3>
                </div>

                <div class="table-responsive p-3 border border-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 me-2 text-center">Menampilkan</p>
                            <form method="GET" action="{{ route('admin.member') }}" id="entries-form">
                                <select id="entries" name="entries" class="form-select form-select-sm"
                                    onchange="this.form.submit()">
                                    <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </form>
                            <p class="mb-0 me-2 text-center mx-2">entri</p>
                        </div>
                        <a href="{{ route('member.portofolio.create') }}"
                            class="tambah-data py-2 px-4 fw-semibold text-center"
                            style="width: max=content; !important">Tambah</a>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Link Portofolio</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($portofolio as $porto)
                                <tr>
                                    <td class="text-capitalize">
                                        {{ $porto->name }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $porto->description }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $porto->link }}
                                    </td>
                                    <td class="text-capitalize">
                                        @if ($porto->status == 'accepted')
                                            <p class="m-0 text-success ">
                                                {{ $porto->status }}
                                            </p>
                                        @elseif($porto->status == 'deaccepted')
                                            <p class="m-0 text-danger">
                                                {{ $porto->status }}
                                            </p>
                                        @else
                                            <p class="m-0">
                                                {{ $porto->status }}
                                            </p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($porto->status == 'check')
                                            <a href="{{ route('member.portofolio.edit', $porto->id) }}" class="me-2">
                                                <img src="{{ asset('nemolab/member/img/edit.png') }}" alt=""
                                                    width="35" height="35">
                                            </a>
                                            <a href="{{ route('member.portofolio.delete', $porto->id) }}">
                                                <img src="{{ asset('nemolab/member/img/delete.png') }}" alt=""
                                                    width="35" height="35">
                                            </a>
                                        @else
                                            <p>-</p>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <p style="text-align: center">Maaf Belum Ada Portofolio Yang Di Upload </p>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between p-1">
                        <p class="show">Menampilkan {{ $portofolio->firstItem() }} hingga {{ $portofolio->lastItem() }} dari
                            {{ $portofolio->total() }}</p>
                        <div class="d-flex gap-3">
                            <!-- Custom Pagination -->
                            <button class="pagination mx-1 {{ $portofolio->onFirstPage() ? 'disabled' : '' }}"
                                id="prev-button" {{ $portofolio->onFirstPage() ? 'disabled' : '' }}
                                data-url="{{ $portofolio->previousPageUrl() }}">Sebelumnya</button>
                            <button class="pagination mx-1 {{ $portofolio->hasMorePages() ? '' : 'disabled' }}"
                                id="next-button" {{ $portofolio->hasMorePages() ? '' : 'disabled' }}
                                data-url="{{ $portofolio->nextPageUrl() }}">Berikutnya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('prev-button').addEventListener('click', function() {
            if (!this.classList.contains('disabled')) {
                window.location.href = this.getAttribute('data-url');
            }
        });

        document.getElementById('next-button').addEventListener('click', function() {
            if (!this.classList.contains('disabled')) {
                window.location.href = this.getAttribute('data-url');
            }
        });
        
        document.getElementById("profile").addEventListener("click", function(){
        document.querySelector(".sidebar-mobile").classList.add("active");
        })
        document.getElementById("tutup").addEventListener("click", function(){
        document.querySelector(".sidebar-mobile").classList.remove("active");
        })
    </script>
@endsection
