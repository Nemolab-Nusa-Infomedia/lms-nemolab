@extends('components.layouts.member.app')

@section('title', 'Belajar Kursus Online Kapan Saja dan Dimanapun')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/home.css') }} ">
@endpush

@section('content')
    <!-- Section Hero -->
    <section class="section-hero-img d-flex align-items-center mb-5 position-relative" id="section-hero-img">
        <div class="row">
            <div class="col-md-6 row align-items-center" style="z-index: 1">
                <div class="text-center text-md-start me-md-3 mx-4" style="margin-top: -4rem">
                    <h1 class="fw-bold mt-4 mt-md-0">BELAJAR KURSUS ONLINE GRATIS, KAPANPUN DAN DIMANAPUN</h1>
                    <div class="paragraph">
                        <p class=" my-3 ">Belajar keahlian seputar teknologi dari pemula hingga ahli, dapatkan berbagai macam
                            kelas mulai
                            yang gratis hingga yang berbayar</p>
                    </div>
                    <a href="{{ route('member.course') }}" class="btn btn-warning px-4 py-2 mt-2">Mulai Belajar</a>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block align-items-center">
                <div class="image-wrapper">
                    <div data-aos="fade-down-left">
                        <div class="circle1"></div>
                    </div>
                    <div data-aos="fade-down-left" data-aos-delay="50">
                        <div class="circle2"></div>
                    </div>
                    <div class="main-image">
                        <img src="{{ asset('nemolab/member/img/lp-hero-pisah-1.png') }}" alt="" data-aos="fade-up"
                            data-aos-delay="200">
                    </div>
                    <div class="image-overlay1">
                        <img src="{{ asset('nemolab/member/img/lp-hero-pisah-2.png') }}" alt="" data-aos-delay="400"
                            data-aos="fade-down">
                    </div>
                    <div class="dot">
                        <img src="{{ asset('nemolab/member/img/dot.png') }}" alt="" data-aos-delay="600"
                            data-aos="fade-left">
                    </div>
                    <div class="image-overlay2">
                        <img src="{{ asset('nemolab/member/img/lp-hero-pisah-3.png') }}" alt="" data-aos-delay="600"
                            data-aos="fade-left">
                    </div>
                </div>
            </div>
        </div>
        <div class="circle3">
            <div>
                <img class="dots" src="{{ asset('nemolab/member/img/dot.png') }}" alt="">
            </div>
        </div>
    </section>

    <section class="section-pilh-kelas" id="section-pilih-kelas" data-aos="fade-up">
        <div class="d-flex flex-column align-items-center p-0 m-0">
            <div class="title-pilih-kelas d-flex justify-content-center align-items-center pt-5">
                <div class="title-group text-center ">
                    <h1 class="title-kelas fw-bold">Pilihan Kelas</h1>
                    <p class="subtitle-kelas">Beralih menjadi profesional dari sekarang dengan memilih kelas dan mulai
                        belajar</p>
                </div>
                
            </div>

            <div class="courses-wrapper">
                <button class="scroll-course" data-direction="left">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z" />
                    </svg>
                </button>
                <div class="courses-scroll">
                    @foreach ($courses as $course)
                        @if ($course)
                            <div class="course-card">
                                <div class="card">
                                    @if ($course->cover != null)
                                        <img src="{{ asset('storage/images/covers/' . $course->cover) }}"
                                            class="card-img-top" alt="{{ $course->name }}" />
                                    @else
                                        <img src="{{ asset('nemolab/member/img/NemolabBG.jpg') }}" class="card-img-top"
                                            alt="{{ $course->name }}" />
                                    @endif
                                    <div class="card-body">
                                        <div class="paket d-flex">
                                            @if (in_array($course->id, $InBundle))
                                                <a
                                                    href="{{ route('member.course', ['filter-paket' => 'paket-bundling']) }}">
                                                    <p class="paket-item">Paket Combo</p>
                                                </a>
                                            @else
                                                <a href="{{ route('member.course', ['filter-paket' => 'paket-kursus']) }}">
                                                    <p class="paket-item">Kursus</p>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="title-card">
                                            <a href="{{ route('member.course.join', $course->slug) }}">
                                                <p>{{ $course->category }}</p>
                                                <h5 class="fw-bold truncate-text">{{ $course->name }}</h5>
                                            </a>
                                            <p class="avatar m-0 fw-bold me-1">
                                                @if ($course->users->avatar != null)
                                                    <img class="me-2"
                                                        src="{{ asset('storage/images/avatars/' . $course->users->avatar) }}"
                                                        alt="" />
                                                @else
                                                    <img class="me-2"
                                                        src="{{ asset('nemolab/member/img/icon/Group 7.png') }}"
                                                        alt="" />
                                                @endif
                                                {{ $course->users->name }}
                                            </p>
                                        </div>
                                        <div class="btn-group-harga d-flex justify-content-between align-items-center mt-3">
                                            <div class="harga">
                                                <p class="p-0 m-0 fw-semibold">Harga</p>
                                                <p class="p-0 m-0 fw-bold">
                                                    {{ $course->price == 0 ? 'Gratis' : 'Rp' . number_format($course->price, 0, ',', '.') }}
                                                </p>
                                            </div>
                                            <a href="{{ route('member.course.join', $course->slug) }}"
                                                class="btn btn-warning">Mulai Belajar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <button class="scroll-course" data-direction="right">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z" />
                    </svg>
                </button>
            </div>

            <a href="{{ route('member.course') }}" class="btn btn-light fw-bold d-none d-md-block">Lihat Kelas
                Lainnya</a>
        </div>
    </section>

    <section class="section-tentang-nemolab" id="section-tentang-nemolab">
        <div class="container-fluid">
            <div class="row my-5 mx-md-3">
                <div class="col-md-6 justify-content-center d-none d-md-flex" id="service" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="col-8 align-items-center">
                        <img src="{{ asset('nemolab/member/img/lp-hero-2.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-4 flex-column mt-4" id="menu-service">
                        <div class="ms-lg-5">
                            <div class="card-service mb-4 py-2" id="item-service" data-aos="zoom-out"
                                data-aos-delay="200">
                                <h4 class="fw-bold">Video</h4>
                                <a href="{{ route('member.course', ['filter-paket' => 'paket-kursus']) }}"
                                    class="btn btn-secondary py-1 px-2 mt-2">belajar sekarang</a>
                            </div>
                            <div class="card-service mb-4 py-2" id="item-service" data-aos="zoom-out"
                                data-aos-delay="300">
                                <h4 class="fw-bold">E-book</h4>
                                <a href="{{ route('member.course', ['filter-paket' => 'paket-ebook']) }}"
                                    class="btn btn-primary py-1 px-2 mt-2">belajar sekarang</a>
                            </div>
                            <div class="card-service mb-4 py-2" id="item-service" data-aos="zoom-out"
                                data-aos-delay="400">
                                <h4 class="fw-bold">Video + E-book</h4>
                                <a href="{{ route('member.course', ['filter-paket' => 'paket-bundling']) }}"
                                    class="btn btn-warning py-1 px-2 mt-2">belajar sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 row align-items-center">
                    <div class="ms-md-4 text-center text-md-start" data-aos="fade-up" data-aos-delay="200">
                        <h1 class="fw-bold">Mengapa Harus Belajar Keahlian Di Nemolab?</h1>
                        <p class="my-4 my-md-3">Kamu bisa belajar berbagai macam keahlian di sini. Kami juga menyediakan
                            kelas video dan e-book
                            yang bisa menyesuaikan tipe pembelajaran kamu. Jadi, mulailah menjadi ahli dari sekarang!</p>
                        <div class="link-href-group d-flex justify-content-center justify-content-md-start">
                            <!-- Center buttons on mobile -->
                            <a href="{{ route('member.course', ['filter-paket' => 'paket-kursus']) }}"
                                class="btn btn-warning fw-bold px-4 me-3 py-2" data-aos="fade-up"
                                data-aos-delay="300">Coba Kursus</a>
                            <a href="{{ route('member.course', ['filter-paket' => 'paket-ebook']) }}"
                                class="btn btn-light fw-bold px-4 py-2" data-aos="fade-up" data-aos-delay="400">Coba
                                Ebook</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- section 4 -->
    <section class="section-benefit-kelas my-5" id="section-benefit-kelas" data-aos="fade-up">
        <div class="container-fluid">
            <div class="row align-items-center my-5 mx-md-3">
                <div class="col-md-6">
                    <div class="me-md-4 text-center text-md-start">
                        <h1 class="fw-bold">Benefit Yang Bisa Kamu Dapatkan Jika Belajar Disini</h1>
                        <ul class="check-active-group mt-3 list-unstyled"> <!-- Changed to ul and added list-unstyled -->
                            <li class="check-active d-flex align-items-center" data-aos="zoom-out">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" class="bi bi-check-square-fill"
                                    style="color: hsl(100, 96%, 42.5%);" viewBox="0 0 16 16">
                                    <path
                                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                </svg>
                                <p class="m-0 p-0 ms-2">Akses kelas selamanya</p>
                            </li>
                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                data-aos-delay="100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" class="bi bi-check-square-fill"
                                    style="color: hsl(100, 96%, 42.5%);" viewBox="0 0 16 16">
                                    <path
                                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                </svg>
                                <p class="m-0 p-0 ms-2">Mendapat sertifikat pembelajaran resmi</p>
                            </li>
                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                data-aos-delay="200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" class="bi bi-check-square-fill"
                                    style="color: hsl(100, 96%, 42.5%);" viewBox="0 0 16 16">
                                    <path
                                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                </svg>
                                <p class="m-0 p-0 ms-2">Grup diskusi private</p>
                            </li>
                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                data-aos-delay="300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" class="bi bi-check-square-fill"
                                    style="color: hsl(100, 96%, 42.5%);" viewBox="0 0 16 16">
                                    <path
                                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                </svg>
                                <p class="m-0 p-0 ms-2">Konsultasi dengan mentor secara langsung</p>
                            </li>
                        </ul>
                        <a href="{{ route('member.course') }}" class="btn btn-warning px-4 py-2 mt-4">Gabung Kelas</a>
                    </div>
                </div>

                <div class="col-md-6 justify-content-center d-none d-md-flex image" id="service" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="benefit-images my-3">
                        <div class="person-image">
                            <img src="{{ asset('nemolab/member/img/lp-person-1.png') }}" class="img-fluid"
                                alt="Person">
                        </div>
                        <div class="grid-images">
                            <img src="{{ asset('nemolab/member/img/lp-person-3.png') }}" class="grid-img col-sm-6 px-0"
                                alt="Image 1" data-aos="zoom-in" data-aos-delay="100">
                            <img src="{{ asset('nemolab/member/img/lp-person-2.png') }}" class="grid-img col-sm-6 px-0"
                                alt="Image 2" data-aos="zoom-in" data-aos-delay="200">
                            <img src="{{ asset('nemolab/member/img/lp-person-4.png') }}" class="grid-img col-sm-6 px-0"
                                alt="Image 3" data-aos="zoom-in" data-aos-delay="300">
                            <img src="{{ asset('nemolab/member/img/lp-person-5.png') }}" class="grid-img col-sm-6 px-0"
                                alt="Image 4" data-aos="zoom-in" data-aos-delay="400">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- end section 4 -->


    <!-- section 5 -->
    <section class="section-testimoni-kelas mt-5" id="section-testimoni-kelas" data-aos="fade-up">
        <div class="container-fluid">
            <div class="testimoni-title pb-5">
                <h1 class="fw-bold m-0">Selangkah Lebih Maju menjadi <br> Professional!!</h1>
                <p class="fs-6 my-4 my-md-3">Jangan ragu untuk bergabung di kelas-kelas kami! Banyak pengguna <br> sudah
                    membuktikan dengan belajar di kelas kami</p>
                <a href="{{ route('member.course') }}" class="btn btn-warning py-2 px-4">Coba Kursus</a>
            </div>
            <div class="row p-0 mx-md-3" id="testimonials">
                <div class="col-md-4 scroll-up d-none d-md-block">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-1.jpg') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                        <p class="m-0">UI/UX Designer</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Kelas UI/UX ini memberi saya wawasan baru tentang cara
                                    memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-14.png') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Vindra Arya Yulian</h5>
                                        <p class="m-0">Frontend Develeoper</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Belajar Frontend di sini benar-benar mengubah cara
                                    saya mengembangkan aplikasi web. Materinya langsung bisa diterapkan ke proyek nyata!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-3.jpg') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Muhammad Fathur</h5>
                                        <p class="m-0">Wordpress Develeoper</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Dari kelas WordPress Development, saya sekarang bisa
                                    membuat dan mengelola website dengan mudah. Sangat membantu meningkatkan bisnis
                                    online
                                    saya!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-16.png') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Pramudya Fachri</h5>
                                        <p class="m-0">Wordpress Developer</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Saya akhirnya bisa membuat website profesional
                                    menggunakan WordPress berkat kursus ini. Mulai dari instalasi hingga cara menggunakan
                                    plugin dan tema, semuanya dijelaskan dengan sangat detail dan mudah diikuti.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-15.png') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Udin Oktafian</h5>
                                        <p class="m-0">Backend Develeoper</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Materi tentang PHP dan Laravel di kursus ini sangat
                                    lengkap. Saya bisa memahami konsep MVC dengan baik, dan sekarang saya sedang mengerjakan
                                    proyek website saya sendiri menggunakan Laravel!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-13.png') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Denis Rizkyan</h5>
                                        <p class="m-0">Backend Develeoper</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Materi tentang PHP dan Laravel di kursus ini sangat
                                    lengkap. Saya bisa memahami konsep MVC dengan baik, dan sekarang saya sedang mengerjakan
                                    proyek website saya sendiri menggunakan Laravel!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 scroll-down">

                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-9.jpg') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Naufal Haidar Azhar</h5>
                                        <p class="m-0">UI/UX Designer</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Setelah mengikuti kursus UI/UX di sini, saya berhasil
                                    membuat desain yang lebih user-friendly. Ini sangat membantu karir saya sebagai
                                    desainer! Kamu harus coba!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-5.jpg') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Novi Amelia</h5>
                                        <p class="m-0">Graphic Designer</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Materi di kursus graphic design ini sangat menarik. Saya
                                    belajar menggunakan Adobe Photoshop dan Illustrator dari nol hingga mahir.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-4.jpg') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Naufal Dzaky</h5>
                                        <p class="m-0">Fullstack Develeoper</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Belajar fullstack di sini sangat memuaskan karena semua
                                    materi, mulai dari frontend, backend, hingga deployment dijelaskan dengan jelas. Saya
                                    sekarang bisa membuat aplikasi web lengkap dari awal hingga akhir.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-6.jpg') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Sarah Azizah</h5>
                                        <p class="m-0">Wordpress Developer</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Materi tentang pengembangan plugin di kursus ini
                                    benar-benar bermanfaat. Saya berhasil membuat plugin sederhana untuk menambahkan fitur
                                    khusus di website saya. Terima kasih atas penjelasannya
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-18.png') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Vebrian Nikola Saputra</h5>
                                        <p class="m-0">Fullstack Developer</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Kelas Backend ini mengajarkan saya cara membuat sistem
                                    yang scalable dan aman. Cocok banget buat kamu yang ingin jadi developer
                                    profesional!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card  mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-13.png') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Emilia Putri</h5>
                                        <p class="m-0">Graphic Design</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Kursus Graphic Design ini benar-benar membantu saya
                                    menghasilkan desain yang lebih menarik dan profesional. Materinya mudah dipahami,
                                    bahkan untuk pemula!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 scroll-up d-none d-md-block">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-11.jpg') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Rizqy Bagus Saputra </h5>
                                        <p class="m-0">Backend Develeoper</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Setelah mengikuti kursus Backend, saya lebih percaya
                                    diri menangani proyek kompleks. Panduan yang jelas dan praktis membuat belajar jadi
                                    lebih mudah!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-10.jpg') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Duiki Arbiyan</h5>
                                        <p class="m-0">Frontend Develeoper</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Saya sekarang bisa membangun website interaktif dengan
                                    mudah setelah mengikuti kelas Frontend Development. Tools dan materi yang diberikan
                                    sangat lengkap!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center ">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-7.jpg') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Abdul Somad</h5>
                                        <p class="m-0">Graphic Design</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Dengan mengikuti kelas Graphic Design di sini, saya
                                    bisa mengembangkan portofolio yang membuat saya dilirik oleh perusahaan besar.
                                    Sangat direkomendasikan!
                                    online
                                    saya!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center ">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-17.png') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Aziz Siswanto</h5>
                                        <p class="m-0">Graphic Design</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Kursus ini memberikan penjelasan yang sangat detail
                                    tentang teori warna, komposisi, dan tipografi. Saya sangat terbantu untuk meningkatkan
                                    kualitas desain saya secara keseluruhan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center ">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-2.jpg') }}" width="45"
                                        height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Okarun Saputra</h5>
                                        <p class="m-0">Graphic Design</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Kursus ini benar-benar membantu saya memahami alur desain
                                    yang baik. Mulai dari ide awal hingga membuat mockup di Figma, semua dijelaskan dengan
                                    sangat terstruktur.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center ">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/dumy-16.png') }}" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Yanto Kurniawan</h5>
                                        <p class="m-0">Frontend Developer</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Saya sangat menyukai bagian tentang CSS. Sebelumnya saya
                                    merasa kesulitan membuat desain yang responsif, tapi setelah ikut kelas ini, saya jadi
                                    percaya diri membuat website yang terlihat keren di semua perangkat.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section 5 -->

    <!-- section 6 -->
    <section class="section-pusat-bantuan mt-5" id="section-pusat-bantuan" data-aos="fade-up">
        <div class="row align-items-center mt-0 mx-md-3">
            <div class="col-md-6">
                <div class="text-center me-md-4 text-md-start" data-aos="fade-up" data-aos-delay="100">
                    <h1 class="fw-bold">Hubungi Kami Jika Anda Memiliki Kendala</h1>
                    <p class="me-md-5">Laporkan masalah anda ke kontak dibawah untuk informasi lebih lanjut lagi</p>
                    <a href="#" class="btn btn-light px-4 py-2 mt-2">Hubungi CS</a>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block">
                <img src="{{ asset('nemolab/member/img/lp-hero-4.png') }}" alt="">
            </div>
        </div>
    </section>
    <!-- end section 6 -->
@endsection

@push('addon-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const coursesScroll = document.querySelectorAll('.scroll-course');
            const scrollContainer = document.querySelector('.courses-scroll');
            const screenWidth = window.innerWidth;
            const speed = screenWidth / 2

            if (coursesScroll) {
                coursesScroll.forEach(element => {
                    element.addEventListener('click', function() {
                        const direction = this.dataset.direction;
                        if (direction === 'left') scrollContainer.scrollLeft -= speed;
                        else if (direction === 'right') scrollContainer.scrollLeft += speed;
                    })
                });
                // coursesScroll.addEventListener('wheel', function(e) {
                //     if (e.deltaY !== 0) {
                //         e.preventDefault();
                //         this.scrollLeft += (e.deltaY * speed);
                //     }
                // });
            }
        });
    </script>
@endpush
