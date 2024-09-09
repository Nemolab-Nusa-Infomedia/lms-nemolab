@extends('components.layouts.member.dashboard')

@section('title', 'My Portofolio')


@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
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
                        <p class="m-0">My Courses</p>
                    </a>
                    <a href="#" class="list-sidebar active">
                        <img src="{{ asset('nemolab/member/img/portofolio active.png') }}" alt="" width="30" />
                        <p class="m-0">My Portofolio</p>
                    </a>
                    <a href="{{ route('member.transaction') }}" class="list-sidebar">
                        <img src="{{ asset('nemolab/member/img/transaksi.png') }}" alt="" width="30" />
                        <p class="m-0">Transactions</p>
                    </a>
                </div>
            </div>


            <div class="container-sm pt-3 pb-3 d-block d-lg-none" style="height: auto;">
                <div class="content2 row top justify-content-between mx-auto mt-1">
                    <div class="dropdown d-block d-lg-none">
                        <a class="dropdown-toggle text-black fs-5" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Sidebar
                        </a>

                        <ul class="dropdown-menu" id="dropdown">
                            @if (Auth::user()->avatar != 'default.png')
                            <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}"
                                style="border-radius: 100%;" alt="" width="70" height="70"
                                class="d-flex mx-auto mt-3" />
                            @else
                            <img src="{{ asset('nemolab/admin/img/avatar.png') }}"
                            style="border-radius: 100%;" alt="" width="70" height="70"
                            class="d-flex mx-auto mt-3" />
                            @endif
                            <h4 class="text-center mt-3 fw-semibold px-3">{{ Auth::user()->name }}</h4>
                            <p class="m-0 fw-light text-center">Status {{ Auth::user()->role }}</p>
                            <div class="ms-3 me-3">
                                <a href="{{ route('member.dashboard') }}"
                                    class="list-sidebar text-black ms-3 mt-4 text-decoration-none text-black {{ request()->is('admin/user/member') ? 'active' : '' }}">
                                    <img src="{{ asset('nemolab/member/img/course active.png') }}" alt=""
                                        width="30" />
                                    <p class="m-0">My Courses</p>
                                </a>
                                <a href="#"
                                    class="list-sidebar active-sidebar-responsive ms-3 text-decoration-none text-black {{ request()->is('admin/user/mentor') ? 'active' : '' }}">
                                    <img src="{{ asset(request()->is('admin/user/mentor') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember-active.png') }}"
                                        alt="" width="30" />
                                    <p class="m-0">My Portofolio</p>
                                </a>
                                <a href="{{ route('member.transaction') }}"
                                    class="list-sidebar ms-3 text-decoration-none text-black {{ request()->is('admin/course/transaction') ? 'active' : '' }}">
                                    <img src="{{ asset(request()->is('admin/course/transaction') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses-active.png') }}"
                                        alt="" width="30" />
                                    <p class="m-0">Transaction</p>
                                </a>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Sidebar -->

            <!-- My Profil -->
            <div class="col-lg-9 col-md-9 col-12 mx-auto mx-lg-0 ps-lg-5 ps-3">
                <div class="my-4">
                    <h3 class="fw-semibold" style="color: #faa907">My Portofolio</h3>
                </div>

                <div class="table-responsive p-3 border border-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 me-2 text-center">Show</p>
                            <form method="GET" action="{{ route('admin.member') }}" id="entries-form">
                                <select id="entries" name="entries" class="form-select form-select-sm"
                                    onchange="this.form.submit()">
                                    <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </form>
                            <p class="mb-0 me-2 text-center mx-2">entries</p>
                        </div>
                        <a href="{{ route('member.portofolio.create') }}"
                            class="tambah-data py-2 px-4 fw-semibold text-center"
                            style="width: max=content; !important">Tambah</a>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Link Portofolio</th>
                                <th>Status</th>
                                <th>Action</th>
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
                        <p class="show">Showing {{ $portofolio->firstItem() }} to {{ $portofolio->lastItem() }} of
                            {{ $portofolio->total() }}</p>
                        <div class="d-flex gap-3">
                            <!-- Custom Pagination -->
                            <button class="pagination mx-1 {{ $portofolio->onFirstPage() ? 'disabled' : '' }}"
                                id="prev-button" {{ $portofolio->onFirstPage() ? 'disabled' : '' }}
                                data-url="{{ $portofolio->previousPageUrl() }}">Previous</button>
                            <button class="pagination mx-1 {{ $portofolio->hasMorePages() ? '' : 'disabled' }}"
                                id="next-button" {{ $portofolio->hasMorePages() ? '' : 'disabled' }}
                                data-url="{{ $portofolio->nextPageUrl() }}">Next</button>
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
    </script>
@endsection
