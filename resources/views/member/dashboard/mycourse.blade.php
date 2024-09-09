@extends('components.layouts.member.dashboard')

@section('title', 'My Course')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/dashboard/mycourse.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar.css') }} ">
@endpush

@section('content')

    <div class="container" style="margin-top: 5rem;">
        @if (!$submission && $total_course > 5)
            <div class="alert alert-warning alert-dismissible fade show text-black position-fixed fixed-top d-flex justify-center align-items-center"
                role="alert">
                Ingin jadi Mentor? klik
                <form action="{{ route('member.pengajuan', Auth::user()->id) }}" method="post">
                    @csrf
                    <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="disini text-black ps-1 btn p-0 m-0 shadow-none"
                        style="text-decoration: underline !important">Disini
                    </button>
                </form>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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
                    <a href="#" class="list-sidebar active">
                        <img src="{{ asset('nemolab/member/img/course active.png') }}" alt="" width="30" />
                        <p class="m-0">My Courses</p>
                    </a>
                    <a href="{{ route('member.portofolio') }}" class="list-sidebar">
                        <img src="{{ asset('nemolab/member/img/portofolio.png') }}" alt="" width="30" />
                        <p class="m-0">My Portofolio</p>
                    </a>
                    <a href="{{ route('member.transaction') }}" class="list-sidebar">
                        <img src="{{ asset('nemolab/member/img/transaksi.png') }}" alt="" width="30" />
                        <p class="m-0">Transactions</p>
                    </a>
                </div>
            </div>

            {{-- SIDEBAR RESPONSIVE --}}
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
                                <img src="{{ asset('nemolab/admin/img/avatar.png') }}" style="border-radius: 100%;"
                                    alt="" width="70" height="70" class="d-flex mx-auto mt-3" />
                            @endif
                            <h4 class="text-center mt-3 fw-semibold px-3">{{ Auth::user()->name }}</h4>
                            <p class="m-0 fw-light text-center">Status {{ Auth::user()->role }}</p>
                            <div class="ms-3 me-3">
                                <a href="#"
                                    class="list-sidebar active-sidebar-responsive text-black ms-3 mt-4 text-decoration-none text-black {{ request()->is('admin/user/member') ? 'active' : '' }}">
                                    <img src="{{ asset('nemolab/member/img/course active.png') }}" alt=""
                                        width="30" />
                                    <p class="m-0">My Courses</p>
                                </a>
                                <a href="{{ route('member.portofolio') }}"
                                    class="list-sidebar ms-3 text-decoration-none text-black {{ request()->is('admin/user/mentor') ? 'active' : '' }}">
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

            <!-- Content -->
            <div class="col-lg-9 col-md-12 ps-5">
                <h3 class="fw-bold tittle">My Courses</h3>
                <div class="course row row-course mt-3 w-100">
                    @foreach ($courses as $course)
                        @if ($course->transactions->isNotEmpty())
                            <div class="col-lg-4 col-md-6 col-lg-4 col-course mt-1 mb-2">
                                <a href="{{ route('member.course.join', $course->slug) }}" class="text-black">
                                    <div class="card-course h-100 d-flex flex-row flex-md-column">
                                        <div class="img-card">
                                            <img src="{{ asset('storage/images/covers/' . $course->cover) }}"
                                                alt="">
                                        </div>
                                        <div class="deskripsi px-3">
                                            <div class="category my-2 d-none d-md-block">
                                                <p class="m-0">{{ $course->category }}</p>
                                            </div>
                                            <div class="tittle-card fw-semibold mt-3 mt-md-0">
                                                {{ $course->name }}
                                            </div>
                                            <div class="category my-3 d-block d-md-none">
                                                <p class="m-0">{{ $course->category }}</p>
                                            </div>
                                            <div class="profile-card mt-2">
                                                <a href="" class="fw-medium">
                                                    @if (Auth::user()->avatar != 'default.png')
                                                        <img class="me-2"
                                                            src="{{ asset('storage/images/avatars/' . $course->users->avatar) }}"
                                                            alt="" width="35" height="35"
                                                            style="border-radius: 100%" />
                                                    @else
                                                        <img class="me-2"
                                                            src="{{ asset('nemolab/admin/img/avatar.png') }}"
                                                            alt="" width="35" height="35"
                                                            style="border-radius: 100%" />
                                                    @endif
                                                    {{ $course->users->name }}
                                                </a>
                                            </div>
                                            <div class="status d-flex justify-content-between my-2">
                                                <div class="d-flex flex-direction-costum">
                                                    <p class="txt-start" style="font-size: 15px">Sudah dibayar</p>
                                                </div>
                                                <img class="ms-0 ms-md-auto me-0 "
                                                    src="{{ asset('nemolab/member/img/check-mycourse.png') }}"
                                                    alt="" width="25" height="25">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
@push('addon-script')
    <script>
        var message = document.querySelectorAll('#message');
        for (let index = 1; index < message.length; index++) {
            message[index].remove();
        }
    </script>
@endpush
