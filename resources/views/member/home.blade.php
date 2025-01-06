@extends('components.layouts.member.app')

@section('title', 'Belajar Kursus Online Kapan Saja dan Dimanapun')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/home.css') }} ">
@endpush

@section('content')
    <!-- Section Hero -->
    <section class="section-hero-img d-flex align-items-center mb-5 position-relative" id="section-hero-img">
        <div data-aos="fade-down-left">
            <div class="circle1"></div>
        </div>
        <div data-aos="fade-down-left" data-aos-delay="50">
            <div class="circle2"></div>
        </div>
        <div class="row">
            <div class="col-md-6 row align-items-center" id="text-hero" style="z-index: 1">
                <div class="text-center text-md-start me-md-3 mx-md-4">
                    <h1 class="fw-bold mt-4 mt-md-0">BELAJAR KURSUS ONLINE GRATIS, KAPANPUN DAN DIMANAPUN</h1>
                    <div class="paragraph">
                        <p class=" my-3 ">Belajar keahlian seputar teknologi dari pemula hingga ahli, dapatkan berbagai
                            macam
                            kelas mulai
                            yang gratis hingga yang berbayar</p>
                    </div>
                    <a href="{{ route('member.course') }}" class="btn btn-warning px-4 py-2 mt-2">Mulai Belajar</a>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block align-items-center">
                <div class="image-wrapper">
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
        <div class="d-flex flex-column align-items-center justify-content-evenly p-0 py-2 py-xxl-5 m-0">
            <div class="title-pilih-kelas d-flex justify-content-center mx-5 mx-md-0 align-items-center pt-5">
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
                                <div class="card">
                                    @if ($course->cover != null)
                                        <img src="{{ url('storage/images/covers/' . $course->cover) }}"
                                            class="card-img-top" alt="{{ $course->name }}" />
                                    @else
                                        <img src="{{ url('nemolab/member/img/NemolabBG.jpg') }}" class="card-img-top"
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
                                                        src="{{ url('storage/images/avatars/' . $course->users->avatar) }}"
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

        <img class="dots" src="{{ asset('nemolab/member/img/dot.png') }}" alt="">
    </section>

    <section class="section-tentang-nemolab" id="section-tentang-nemolab">
        <div class="container-fluid">
            <div class="row my-5 mx-md-3">
                <div class="col-lg-6 justify-content-center d-none d-lg-flex" id="service" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="col-8 align-items-center justify-content-center d-flex">
                        <img src="{{ asset('nemolab/member/img/lp-hero-2.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-4 flex-column mt-4" id="menu-service">
                        <div class="ms-xl-5">
                            <div class="card-service mb-4 py-2" id="item-service" data-aos="zoom-out"
                                data-aos-delay="200">
                                <h4 class="fw-bold">Video</h4>
                                <a href="{{ route('member.course', ['filter-paket' => 'paket-kursus']) }}"
                                    class="btn btn-warning py-1 px-2 mt-2">belajar sekarang</a>
                            </div>
                            <div class="card-service mb-4 py-2" id="item-service" data-aos="zoom-out"
                                data-aos-delay="300">
                                <h4 class="fw-bold">E-book</h4>
                                <a href="{{ route('member.course', ['filter-paket' => 'paket-ebook']) }}"
                                    class="btn btn-warning py-1 px-2 mt-2">belajar sekarang</a>
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
                <div class="col-lg-6 row align-items-center">
                    <div class="ms-md-4 text-center text-lg-start" data-aos="fade-up" data-aos-delay="200">
                        <h1 class="fw-bold">Mengapa Harus Belajar
                            <span>
                                Keahlian
                                <img src="{{ asset('nemolab/img_component/5fca34d4581c9a99a016ddecf9ddf318.png') }}"
                                    alt="">
                            </span> Di
                            <span>
                                Nemolab?
                                <img src="{{ asset('nemolab/img_component/f69671db8d39c5bd931f5129eb023a5f.png') }}"
                                    alt="">
                            </span>
                        </h1>
                        <p class="my-4 my-md-3">Kamu bisa belajar berbagai macam keahlian di sini. Kami juga menyediakan
                            kelas video dan e-book
                            yang bisa menyesuaikan tipe pembelajaran kamu. Jadi, mulailah menjadi ahli dari sekarang!</p>
                        <div class="link-href-group d-flex justify-content-center justify-content-lg-start">
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
        <img class="dots" src="{{ asset('nemolab/member/img/dot.png') }}" alt="">
    </section>


    <!-- section 4 -->
    <section class="section-benefit-kelas my-5" id="section-benefit-kelas" data-aos="fade-up">
        <div class="container-fluid">
            <div class="row align-items-center my-5 mx-md-3">
                <div class="col-sm-6">
                    <div class="values-grid">
                        <div class="value">
                            <div class="icon">
                                <svg width="46" height="42" viewBox="0 0 46 42" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M39.1398 20.8386C37.9829 20.844 36.8489 21.1351 35.8573 21.6811L31.2114 17.4254L34.9376 14.0123C35.5468 13.454 35.8891 12.6969 35.8891 11.9075C35.8891 11.1181 35.5468 10.361 34.9376 9.80274L25.1876 0.871635C24.5781 0.313528 23.7516 0 22.8898 0C22.028 0 21.2015 0.313528 20.5921 0.871635L10.8421 9.80274C10.2328 10.361 9.8905 11.1181 9.8905 11.9075C9.8905 12.6969 10.2328 13.454 10.8421 14.0123L14.5682 17.4254L9.92231 21.6811C8.54574 20.9329 6.91835 20.6708 5.34574 20.944C3.77313 21.2172 2.36349 22.0069 1.38155 23.1648C0.399597 24.3227 -0.0871088 25.7691 0.0128247 27.2325C0.112758 28.6958 0.792457 30.0754 1.92428 31.1122C3.0561 32.1489 4.56219 32.7715 6.1597 32.8631C7.75722 32.9546 9.33627 32.5088 10.6003 31.6093C11.8644 30.7098 12.7265 29.4186 13.0247 27.9781C13.3229 26.5375 13.0368 25.0468 12.2201 23.7859L16.8659 19.5302L20.5921 22.9434C20.7936 23.1232 21.0197 23.2783 21.2648 23.4048V29.7697H16.3898V41.6778H29.3898V29.7697H24.5148V23.4033C24.7598 23.2773 24.986 23.1227 25.1876 22.9434L28.9137 19.5302L33.5596 23.7859C32.8399 24.9167 32.5483 26.2336 32.7302 27.5319C32.912 28.8302 33.5571 30.0371 34.5651 30.9648C35.5731 31.8926 36.8876 32.4893 38.304 32.662C39.7204 32.8348 41.1595 32.574 42.3974 31.9202C43.6354 31.2663 44.6027 30.2562 45.1491 29.0467C45.6955 27.8372 45.7903 26.4963 45.4188 25.2324C45.0472 23.9685 44.2301 22.8524 43.0946 22.0578C41.9591 21.2632 40.5688 20.8346 39.1398 20.8386ZM9.88981 26.7927C9.88981 27.3815 9.6992 27.9571 9.34209 28.4466C8.98497 28.9362 8.47739 29.3178 7.88353 29.5431C7.28967 29.7684 6.6362 29.8274 6.00577 29.7125C5.37533 29.5976 4.79623 29.3141 4.34171 28.8978C3.88719 28.4814 3.57766 27.951 3.45226 27.3735C3.32685 26.796 3.39122 26.1974 3.6372 25.6534C3.88319 25.1094 4.29975 24.6445 4.83421 24.3174C5.36867 23.9902 5.99702 23.8156 6.63981 23.8156C7.50176 23.8156 8.32841 24.1293 8.93791 24.6876C9.5474 25.2459 9.88981 26.0031 9.88981 26.7927ZM26.1398 32.7467V38.7008H19.6398V32.7467H26.1398ZM22.8898 20.8386L13.1398 11.9075L22.8898 2.9764L32.6398 11.9075L22.8898 20.8386ZM39.1398 29.7697C38.497 29.7697 37.8687 29.5951 37.3342 29.268C36.7997 28.9409 36.3832 28.4759 36.1372 27.9319C35.8912 27.388 35.8269 26.7894 35.9523 26.2119C36.0777 25.6344 36.3872 25.1039 36.8417 24.6876C37.2962 24.2712 37.8753 23.9877 38.5058 23.8728C39.1362 23.758 39.7897 23.8169 40.3835 24.0423C40.9774 24.2676 41.485 24.6492 41.8421 25.1387C42.1992 25.6283 42.3898 26.2039 42.3898 26.7927C42.3898 27.5822 42.0474 28.3395 41.4379 28.8978C40.8284 29.4561 40.0018 29.7697 39.1398 29.7697Z"
                                        fill="white" />
                                </svg>

                            </div>
                            <h5>Akses kelas selamanya </h5>
                            <p>Mendapatkan kesempatan untuk mengakses materi kelas kapan saja dan tanpa batas waktu</p>
                        </div>
                        <div class="value">
                            <div class="icon">
                                <svg width="45" height="35" viewBox="0 0 45 35" fill="none"
                                    style="transform: translateY(4px)" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M24.5736 34.2753L29.0415 32.3711L33.5094 34.2753V20.946H24.5736M33.5094 11.4251V7.61673L29.0415 9.52091L24.5736 7.61673V11.4251L20.1057 13.3293L24.5736 15.2335V19.0418L29.0415 17.1376L33.5094 19.0418V15.2335L37.9774 13.3293M40.2113 0H4.46792C3.28296 0 2.14652 0.401237 1.30862 1.11544C0.470726 1.82965 0 2.79832 0 3.80836V22.8502C0 23.8602 0.470726 24.8289 1.30862 25.5431C2.14652 26.2573 3.28296 26.6585 4.46792 26.6585H20.1057V22.8502H4.46792V3.80836H40.2113V22.8502H37.9774V26.6585H40.2113C41.3963 26.6585 42.5327 26.2573 43.3706 25.5431C44.2085 24.8289 44.6792 23.8602 44.6792 22.8502V3.80836C44.6792 2.79832 44.2085 1.82965 43.3706 1.11544C42.5327 0.401237 41.3963 0 40.2113 0ZM20.1057 9.52091H6.70189V5.71255H20.1057M15.6377 15.2335H6.70189V11.4251H15.6377M20.1057 20.946H6.70189V17.1376H20.1057V20.946Z"
                                        fill="white" />
                                </svg>
                            </div>
                            <h5>Mendapatkan Sertifikat </h5>
                            <p>Mendapatkan kesempatan untuk mengakses materi kelas kapan saja dan tanpa batas waktu</p>
                        </div>
                        <div class="value">
                            <div class="icon">
                                <svg width="54" height="48" viewBox="0 0 54 48" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_179_2549)">
                                        <path
                                            d="M17.9999 21.52H16.6949C14.9141 21.4628 13.139 21.7315 11.4798 22.3095C9.82067 22.8875 8.31285 23.7624 7.04994 24.88L6.68994 25.2533V36.2933H12.8099V30.0267L13.6349 29.2L14.0099 28.8133C15.9628 27.03 18.3941 25.7177 21.0749 25C19.7332 24.0917 18.6747 22.8939 17.9999 21.52Z"
                                            fill="white" />
                                        <path
                                            d="M47.01 24.84C45.7471 23.7225 44.2393 22.8475 42.5801 22.2695C40.9209 21.6915 39.1458 21.4228 37.365 21.48C36.8188 21.4826 36.2732 21.5093 35.73 21.56C35.0426 22.8489 34.013 23.97 32.73 24.8267C35.5922 25.5299 38.185 26.9127 40.23 28.8267L40.605 29.2L41.415 30.0267V36.3067H47.325V25.2133L47.01 24.84Z"
                                            fill="white" />
                                        <path
                                            d="M16.6501 18.92H17.1151C16.899 17.271 17.2245 15.6016 18.0523 14.1134C18.8801 12.6253 20.1748 11.3818 21.7801 10.5333C21.1982 9.74312 20.3953 9.10079 19.4503 8.66925C18.5052 8.2377 17.4502 8.03172 16.3887 8.07149C15.3271 8.11125 14.2954 8.39539 13.3945 8.89609C12.4936 9.39678 11.7544 10.0969 11.2494 10.9278C10.7443 11.7587 10.4907 12.692 10.5134 13.6362C10.536 14.5804 10.8341 15.5032 11.3785 16.3143C11.923 17.1253 12.695 17.7967 13.6191 18.2629C14.5431 18.729 15.5876 18.9738 16.6501 18.9733V18.92Z"
                                            fill="white" />
                                        <path
                                            d="M36.6451 17.92C36.6621 18.2265 36.6621 18.5335 36.6451 18.84C36.9329 18.881 37.2236 18.9033 37.5151 18.9067H37.8001C38.8579 18.8565 39.8831 18.5638 40.7758 18.0569C41.6686 17.5501 42.3985 16.8463 42.8945 16.0143C43.3904 15.1823 43.6356 14.2502 43.606 13.309C43.5765 12.3677 43.2733 11.4493 42.7259 10.6432C42.1785 9.83699 41.4056 9.17055 40.4824 8.70872C39.5593 8.24689 38.5173 8.0054 37.458 8.00777C36.3987 8.01014 35.3581 8.25628 34.4375 8.72224C33.517 9.18819 32.7479 9.85808 32.2051 10.6667C33.5627 11.4546 34.6791 12.5298 35.454 13.7957C36.2289 15.0617 36.6382 16.4788 36.6451 17.92Z"
                                            fill="white" />
                                        <path
                                            d="M26.8051 23.8933C30.5082 23.8933 33.5101 21.2249 33.5101 17.9333C33.5101 14.6417 30.5082 11.9733 26.8051 11.9733C23.102 11.9733 20.1001 14.6417 20.1001 17.9333C20.1001 21.2249 23.102 23.8933 26.8051 23.8933Z"
                                            fill="white" />
                                        <path
                                            d="M27.165 27.0666C25.2062 26.9971 23.2517 27.2802 21.419 27.8988C19.5863 28.5174 17.9132 29.4589 16.5 30.6666L16.125 31.04V39.48C16.1309 39.7549 16.1976 40.0261 16.3214 40.2781C16.4452 40.5301 16.6236 40.7579 16.8465 40.9486C17.0693 41.1393 17.3323 41.289 17.6203 41.3894C17.9083 41.4897 18.2157 41.5386 18.525 41.5333H35.76C36.0693 41.5386 36.3767 41.4897 36.6647 41.3894C36.9527 41.289 37.2157 41.1393 37.4385 40.9486C37.6614 40.7579 37.8398 40.5301 37.9636 40.2781C38.0874 40.0261 38.1541 39.7549 38.16 39.48V31.0666L37.8 30.6666C36.3965 29.4545 34.7292 28.51 32.9005 27.891C31.0717 27.2719 29.12 26.9914 27.165 27.0666Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_179_2549">
                                            <rect width="54" height="48" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <h5>Mendapatkan Sertifikat </h5>
                            <p>Mendapatkan kesempatan untuk mengakses materi kelas kapan saja dan tanpa batas waktu</p>
                        </div>
                        <div class="value">
                            <div class="icon">
                                <svg width="43" height="43" viewBox="0 0 43 43" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21.5 0C9.62483 0 0 9.57382 0 21.386C0 33.1947 9.62483 42.7721 21.5 42.7721C33.3752 42.7721 43 33.1983 43 21.386C43 9.57738 33.3752 0 21.5 0ZM16.125 30.2969H12.5417V12.4752H16.125V30.2969ZM30.4583 30.2969H19.7083V26.7326H30.4583V30.2969ZM30.4583 23.1682H19.7083V19.6039H30.4583V23.1682ZM30.4583 16.0395H19.7083V12.4752H30.4583V16.0395Z"
                                        fill="white" />
                                </svg>
                            </div>
                            <h5>Mendapatkan Sertifikat </h5>
                            <p>Mendapatkan kesempatan untuk mengakses materi kelas kapan saja dan tanpa batas waktu</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="me-md-4 mx-3 mx-md-0 text-center text-md-start">
                        <h1 class="fw-bold ms-sm-4 mb-3">Benefit Yang Bisa Kamu Dapatkan Jika <span>Belajar</span> Disini</h1>
                        <p class=" ms-sm-4 mb-3">Sesuatu yang lebih besar untuk mencapai impian Anda jadi kami menyediakan semua hal hebat ini
                            untuk Anda dan banyak lagi </p>
                        <iframe src="https://www.youtube.com/embed/Pt7PiJJsarw" class="mt-2" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section 4 -->

    <!-- section 5 -->
    <section id="section-support-by" data-aos="fade-up">
        <h1 class="fw-bold m-0">Support By</h1>
        <p>Banyak brand dan perusahaan besar mendukung tujuan kami untuk menjadi yang terbaik dan terpercaya dalam
            pengembangan pribadi dan karier</p>
        <div class="support-brand">
            <img src="{{ asset('nemolab/img_component/Nemolab.png') }}" alt="" data-aos="fade-right" data-aos-delay="100">
            <img src="{{ asset('nemolab/img_component/Hugo_Studio.png') }}" alt="" data-aos="fade-right" data-aos-delay="300">
            <img src="{{ asset('nemolab/img_component/Vibrant_Ecosystem.png') }}" alt="" data-aos="fade-right" data-aos-delay="500">
        </div>
    </section>
    <!-- end section 5 -->

    <!-- section 6 -->
    <section class="section-pusat-bantuan" id="section-pusat-bantuan" data-aos="fade-up">
        <div class="row align-items-center mt-0 mx-md-3">
            <div class="col-md-6">
                <div class="text-center me-md-4 text-md-start" data-aos="fade-up" data-aos-delay="100">
                    <h1 class="fw-bold mb-3">Hubungi Kami Jika Anda Memiliki Kendala</h1>
                    <p class="me-md-5">Laporkan masalah anda ke kontak dibawah untuk informasi lebih lanjut lagi</p>
                    <a href="#" class="btn btn-warning px-4 py-2 mt-2">Hubungi CS</a>
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
                        console.log(direction)
                        if (window.innerWidth < 576) {
                            if (direction === 'left') scrollContainer.scrollTop -= speed;
                            else if (direction === 'right') scrollContainer.scrollTop += speed;
                        } else {
                            if (direction === 'left') scrollContainer.scrollLeft -= speed;
                            else if (direction === 'right') scrollContainer.scrollLeft += speed;
                        }
                    })
                });
            }
        });
    </script>
@endpush
