@extends('components.layouts.member.dashboard')

@section('title', 'My Course')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/dashboard/mycourse.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar.css') }} ">
@endpush

@section('content')

    <div class="container" style="margin-top: 5rem;">
        @if (Auth::user()->role == 'students')
            @if (!$submission && $total_course >= 5)
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
                        <p class="m-0">Kursus Saya</p>
                    </a>
                    <a href="{{ route('member.portofolio') }}" class="list-sidebar">
                        <img src="{{ asset('nemolab/member/img/portofolio.png') }}" alt="" width="30" />
                        <p class="m-0">Portofolio Saya</p>
                    </a>
                    <a href="{{ route('member.transaction') }}" class="list-sidebar">
                        <img src="{{ asset('nemolab/member/img/transaksi.png') }}" alt="" width="30" />
                        <p class="m-0">Transaksi Saya</p>
                    </a>
                </div>
            </div>

            <!-- End Sidebar -->

            <!-- Content -->
            <div class="col-lg-9 col-md-12 ps-5">
                {{-- Sidebar Mobile --}}
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
                            <a href="#" class="nav-item active">
                                <img
                                    src="{{ asset('nemolab/member/img/course active.png') }}"
                                    alt=""
                                    width="30"
                                    class="me-2"
                                />Kursus Saya
                            </a>
                            <a href="{{ route('member.portofolio') }}" class="nav-item">
                                <img
                                    src="{{ asset('nemolab/member/img/portofolio active.png') }}"
                                    alt=""
                                    width="30"
                                    class="me-2"
                                />Profil Saya
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

                <h3 class="fw-bold tittle mt-3">Kursus Saya</h3>
                <div class="course row row-course mt-3 w-100">
                    @foreach ($courses as $course)
                        @if ($course->transactions->isNotEmpty())
                            <div class="col-lg-4 col-md-6 col-lg-4 col-course mt-1 mb-2">
                                <a href="{{ route('member.course.join', $course->slug) }}" class="text-black">
                                    <div class="card-course h-100 d-flex flex-row flex-md-column position-relative">
                                        <div class="position-absolute d-block d-md-none" style="bottom: 5px; right: 10px;">
                                            @if ($course->users->avatar != 'default.png')
                                                <img
                                                    src="{{ asset('storage/images/avatars/' . $course->users->avatar) }}"
                                                    alt="" width="16" height="16"
                                                    style="border-radius: 100%" />
                                            @else
                                                <img
                                                    src="{{ asset('nemolab/admin/img/avatar.png') }}"
                                                    alt="" width="16" height="16"
                                                    style="border-radius: 100%" />
                                            @endif
                                        </div>
                                        <div class="img-card">
                                            <img src="{{ asset('storage/images/covers/' . $course->cover) }}"
                                                alt="">
                                        </div>
                                        <div class="deskripsi px-2 px-md-3">
                                            <div class="category my-2 d-none d-md-block">
                                                <p class="m-0">{{ $course->category }}</p>
                                            </div>
                                            <div class="tittle-card fw-semibold mt-2 mt-md-0">
                                                <p>{{ $course->name }}</p>
                                            </div>
                                            <div class="category d-block d-md-none">
                                                <p class="m-0 text-center">{{ $course->category }}</p>
                                            </div>
                                            <div class="profile-card mt-2 d-none d-md-block">
                                                <a href="" class="fw-medium">
                                                    @if ($course->users->avatar != 'default.png')
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
                                            <div class="status d-flex justify-content-between mt-2 my-md-2">
                                                <div class="d-flex">
                                                    <p class="txt-start" style="font-size: 15px">Sudah dibayar</p>
                                                    <img class="ms-2 ms-md-3 me-0 "
                                                        src="{{ asset('nemolab/member/img/check-mycourse.png') }}"
                                                        alt="" width="20" height="20">
                                                </div>
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

        document.getElementById("profile").addEventListener("click", function(){
        document.querySelector(".sidebar-mobile").classList.add("active");
        })
        document.getElementById("tutup").addEventListener("click", function(){
        document.querySelector(".sidebar-mobile").classList.remove("active");
        })
    </script>
@endpush
