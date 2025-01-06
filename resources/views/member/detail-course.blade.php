@extends('components.layouts.member.dashboard')

@section('title', 'Nemolab - Kursus Online')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/detail-course.css') }} ">
@endpush

@section('content')
    <section class="detail-course-section" id="detail-course-section">
        <div class="container">
            <a href="{{ route('member.course.join', $courses->slug) }}">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4 class="m-0 p-0 mt-5 mb-4 text-center">{{ $courses->name }}</h4>
            <div class="content-images d-flex justify-content-center">
                @if ($courses->cover !=null)
                <img src="{{ url('storage/images/covers/' . $courses->cover) }}" alt="" class="img-fluid" width="900" height="800" style="border-radius: 15px;">
                @else
                <img src="{{ url('nemolab/member/img/NemolabBG.jpg') }}" alt="" class="img-fluid" width="900" height="800" style="border-radius: 15px;">
                @endif
            </div>
            <div class="subcontent-images mt-5">
                <div class="row">
                    <div class="col-12 col-sm-6 col-xl-4 mb-4">
                        <a href="{{ $courses->link_grub }}" class="shadow">
                            <img src="{{ url('nemolab/member/img/img-konsultasi.png') }}" alt="">
                            <div class="group-title-subtitle ms-3">
                                <p class="m-0 p-0">Gabung Grub Konsultasi</p>
                                <p class="m-0 p-0">Konsultasi Dengan Mentor</p>
                            </div>
                        </a>
                    </div>
                    @if ($checkSertifikat == true)
                        <div class="col-12 col-sm-6 col-xl-4 mb-4">
                            @if (!$checkReview)
                                <a href="{{ route('member.review', $courses->slug) }}" class="shadow">
                                @else
                                    <a href="{{ route('member.sertifikat', $courses->slug) }}" class="shadow">
                            @endif
                            <img src="{{ url('nemolab/member/img/img-achievement.png') }}" alt="">
                            <div class="group-title-subtitle ms-3">
                                <p class="m-0 p-0">Unduh Sertifikat</p>
                                <p class="m-0 p-0">Unduh Sertifikat Anda</p>
                            </div>
                            </a>
                        </div>
                    @endif
                    @if ($courses->resources != 'null')
                        <div class="col-12 col-sm-6 col-xl-4 mb-4">
                            <a href="{{ $courses->resources }}" class="shadow">
                                <img src="{{ url('nemolab/member/img/img-asset.png') }}" alt="">
                                <div class="group-title-subtitle ms-3">
                                    <p class="m-0 p-0">Asset Belajar</p>
                                    <p class="m-0 p-0">Unduh Asset disini</p>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="detail-courses mt-5">
                <div class="card">
                    <div class="card-header p-0">
                        <h5 class="m-0">Detail</h5>
                    </div>
                    <div class="card-body d-flex align-items-center p-0 pt-3">
                        <div class="text">
                            <p class="m-0 p-0">Tanggal rilis </p>
                            <p class="m-0 p-0">Tanggal Update </p>
                            <p class="m-0 p-0">Jenis paket </p>
                            <p class="m-0 p-0">Tingkatan </p>
                        </div>
                        <div class="text-titik-koma">
                            <p class="m-0 p-0 ms-3">:</p>
                            <p class="m-0 p-0 ms-3">:</p>
                            <p class="m-0 p-0 ms-3">:</p>
                            <p class="m-0 p-0 ms-3">:</p>
                        </div>
                        <div class="text-content">
                            <p class="m-0 p-0 ms-3">{{ $courses->created_at->format('d F Y') }}</p>
                            @if ($chapterInfo) 
                            <p class="m-0 p-0 ms-3">{{ $chapterInfo->updated_at->format('d F Y') }}</p>
                            @else
                            <p class="m-0 p-0 ms-3"> - </p>
                            @endif
                            <p class="m-0 p-0 ms-3">
                                @if ($bundling)
                                    Paket Combo
                                @else
                                    Kursus
                                @endif
                            </p>
                            <p class="m-0 p-0 ms-3">
                                @if ($courses->type == 'beginner')
                                    Pemula
                                @elseif ($courses->type == 'intermediate')
                                    Menengah
                                @else
                                    Ahli
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="description-courses mt-5">
                <div class="card">
                    <div class="card-header p-0">
                        <h5 class="m-0">Deskripsi Kursus</h5>
                    </div>
                    <div class="card-body d-flex align-items-center p-0 pt-3">
                        <p class="m-0 p-0 ">{{ $courses->description }}</p>
                    </div>
                </div>
            </div>
            <div class="tools-courses mt-5">
                <div class="card card-tools">
                    <div class="card-header p-0">
                        <h5 class="m-0">Tools</h5>
                    </div>
                    <div class="card-body p-0 pt-3 ">
                        <div class="row">
                            @foreach ($coursetools->tools as $tool)
                                <a href="{{ $tool->link }}"
                                    class="col-auto me-2 tools-group justify-content-center align-items-center flex-column text-center" style=" height: 100%;">
                                    <img src="{{ url('storage/images/logoTools/' . $tool->logo_tools) }}" alt=""
                                        width="50px" height="50px">
                                    <p class="tool-name m-0 p-0 pt-1">{{ $tool->name_tools }}</p>
                                </a>
                            @endforeach
                        </div>                        
                    </div>
                </div>
            </div>
            {{-- <div class="testimoni mt-3" id="testimoni" data-aos="fade-up">
                <div class="container-fluid">
                @if ($reviews->isNotEmpty())
                    <h5>Testimoni</h5>
                    <div class="col-12 mt-4">
                        <div class="row card-testimoni d-none d-md-flex">
                            @foreach ($reviews as $index => $review)
                                <div class="col-12 col-md-6 testimoni-card review-item" data-index="{{ $index }}" style="{{ $index >= 2 ? 'display: none;' : '' }}">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="card-head d-flex align-items-center">
                                            @if ($review->user->avatar !=null)
                                                <img src="{{ asset('storage/images/avatars/' . $review->user->avatar) }}" alt="User Avatar" width="50" height="50" class="avatar-img" style="border-radius: 50%">
                                                @else
                                                <img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}" alt="User Avatar" width="50" height="50" class="avatar-img" style="border-radius: 50%">
                                            @endif

                                                <div class="name ms-3">
                                                    <h5 class="card-title m-0 fw-bold">{{ $review->user->name }}</h5>
                                                    <p class="m-0">{{ $review->user->profession }}</p>
                                                </div>
                                            </div>
                                            <p class="card-text p-0 m-0 mt-2">{{ $review->note }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-container d-md-none">
                            <div class="swiper-wrapper">
                                @foreach ($reviews as $review)
                                    <div class="swiper-slide testimoni-card review-item">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="card-head d-flex align-items-center">
                                                @if ($review->user->avatar !=null)
                                                    <img src="{{ asset('storage/images/avatars/' . $review->user->avatar) }}" alt="User Avatar" width="50" height="50" class="avatar-img" style="border-radius: 50%">
                                                    @else
                                                    <img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}" alt="User Avatar" width="50" height="50" class="avatar-img" style="border-radius: 50%">
                                                @endif

                                                    <div class="name ms-3">
                                                        <h5 class="card-title m-0 fw-bold">{{ $review->user->name }}</h5>
                                                        <p class="m-0">{{ $review->user->profession ?? 'Profession not specified' }}</p>
                                                    </div>
                                                </div>
                                                <p class="card-text p-0 m-0 mt-2">{{ $review->note }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="navtabs-more-testimoni d-flex justify-content-center mt-4 d-none d-md-flex">
                            <button class="btn btn-primary px-4 pt-2 pb-2" id="show-more-btn">
                                Lihat Lainnya
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div> --}}
    </section>
@endsection
@push('addon-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showMoreBtn = document.getElementById('show-more-btn');
            let currentLimit = 4;

            showMoreBtn.addEventListener('click', function() {
                const reviews = document.querySelectorAll('.review-item');
                for (let i = currentLimit; i < currentLimit + 4 && i < reviews.length; i++) {
                    reviews[i].style.display = 'block';
                }
                currentLimit += 4;
                if (currentLimit >= reviews.length) {
                    showMoreBtn.style.display = 'none';
                }
            });
        });
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let swiper;

        function initializeSwiper() {
            if (window.innerWidth < 768 && !swiper) {
                swiper = new Swiper('.swiper-container', {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    centeredSlides: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                });
            } else if (window.innerWidth >= 768 && swiper) {
                swiper.destroy(true, true);
                swiper = undefined;
            }
        }
        initializeSwiper();
        window.addEventListener('resize', initializeSwiper);
    });
</script>
@endpush
