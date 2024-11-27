@extends('components.layouts.member.dashboard')

@section('title', 'Nemolab - Detail Kursus')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/joincourse.css') }}">
@endpush

@section('content')
    <main class="container mt-5 pt-5 pb-5">
        <div class="">
            <div class="col-md-8">
                <h3 class="" data-aos="fade-right" style="word-wrap: break-word; white-space: normal;">{{ $courses->name }}</h3>
            </div>

            <div class="row mt-3">
                <!-- Kolom Kiri -->
                <div class="layout-kiri col-md-8">
                    <div class="card-preview mb-3">
                        @if ($courses->cover != null)
                            <img src="{{ asset('storage/images/covers/' . $courses->cover) }}" alt="">
                        @else
                            <img src="{{ asset('nemolab/member/img/NemolabBG.jpg') }}" alt="">
                        @endif
                    </div>
                    <div class="card mb-3 d-md-none">
                        <div class="card-buy-body">
                            <div class="m-3">
                                @if ($bundling)
                                <p class="paket text-center mt-2 mb-0">Paket Combo</p>
                                @else
                                <p class="paket text-center mt-2 mb-0">Kursus</p>
                                @endif
                                <h3 class="card-title text-center mt-3" data-aos="zoom-out" data-aos-delay="100">Mulai Belajar
                                    Kursus Ini</h3>
                                <p class="text-center mx-3" data-aos="zoom-out" data-aos-delay="200">Belajar dimanapun dan kapanpun
                                    bersama kami, dan dapatkan akses kelas selamanya dengan bergabung di kursus ini</p>
                                <div class="benefit ms-3">
                                    <p class="" style="color: #414142">Keuntungan Belajar Kelas ini</p>
                                    <ul class="check-active-group mt-3 list-unstyled">
                                        <ul class="check-active-group mt-3 list-unstyled">
                                            <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                                data-aos-delay="100">
                                                <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                                <p class="m-0 p-0 ms-2">Akses kelas selamanya</p>
                                            </li>
                                            @if ($courses->resources != null)
                                            <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                                data-aos-delay="200">
                                                <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                                <p class="m-0 p-0 ms-2">Asset gratis</p>
                                            </li>
                                            @endif
                                            @if ($courses->price == 0)
                                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                                data-aos-delay="300">
                                                <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                                <p class="m-0 p-0 ms-2">Belajar gratis</p>
                                            </li>
                                            @endif
                                            @if ($bundling)
                                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                                data-aos-delay="400">
                                                <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                                <p class="m-0 p-0 ms-2">Bonus E-Book</p>
                                            </li>
                                            @endif
                                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                                data-aos-delay="600">
                                                <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                                <p class="m-0 p-0 ms-2">Grup diskusi private</p>
                                            </li>
                                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                                data-aos-delay="700">
                                                <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                                <p class="m-0 p-0 ms-2">Konsultasi dengan mentor</p>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                            <div class="">
                                <div class="mb-3">
                                    @if ($transaction == null)
                                        <p class="price-title text-center" style="color: #414142; margin:5px">Harga</p>
                                        @if ($courses->price != 0 && !$bundling)
                                            <h3 class="price text-center">Rp{{ number_format($courses->price, 0, ',', '.') }}</h3>
                                        @elseif ($bundling && $bundling->price != 0)
                                            <h3 class="price text-center">Rp{{ number_format($bundling->price, 0, ',', '.') }}</h3>
                                        @else
                                            <h3 class="price text-center">Gratis</h3>
                                        @endif
                                    @endif
                                </div>
    
                                @if ($transaction)
                                    @if ($transaction->status == 'pending')
                                        <a href="#" class="buy btn btn-warning w-100">Dalam Proses Pembayaran</a>
                                    @elseif ($transaction->status == 'success')
                                        @if (isset($lesson) && isset($lesson->episode))
                                            <a href="{{ route('member.course.play', ['slug' => $courses->slug, 'episode' => $lesson->episode]) }}"
                                                class="buy btn btn-warning w-100">Mulai Belajar</a>
                                        @else
                                            <a href="#" class="buy btn btn-warning w-100">Kelas Dalam Pembaruan</a>
                                        @endif
                                    @else
                                        <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                                            class="buy btn btn-warning w-100">Ambil Kelas</a>
                                    @endif
                                @else
                                    @if ($bundling)
                                    <a href="{{ route('member.payment', ['bundle_id' => $bundling->id]) }}"
                                        class="buy btn btn-warning w-100">Ambil Kelas</a>
                                    @else
                                        <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                                            class="buy btn btn-warning w-100">Ambil Kelas</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    @if ($bundling)
                    <div class="card-bonus mb-3" data-aos="fade-up">
                        <div class="card-bonus-body">
                            <h5>Bonus</h5>
                            <div class="d-flex">
                                <a class="book-img" href="{{ route('member.ebook.join', $bundling->ebook->slug) }}">
                                    <img src="{{ asset('storage/images/covers/ebook/' . $bundling->ebook->cover) }}" alt="" width="80" height="100" style="object-fit: cover; border-radius: 5px">
                                </a>
                                <table class="detail">
                                    <tr>
                                        <td>Judul E-Book</td>
                                        <td><span>: {{ $bundling->ebook->name }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Kategori E-Book</td>
                                        <td><span>: {{ $bundling->ebook->category }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Tingkatan</td>
                                        <td><span>: 
                                            @if ($bundling->ebook->level == 'beginner')
                                            Pemula
                                            @elseif ($bundling->ebook->level == 'intermediate')
                                            Menengah
                                            @else
                                            Ahli
                                            @endif</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div> 
                @endif
                
                    <div class="card mb-3" data-aos="fade-up">
                        <div class="card-body">
                            <h5>Detail Kursus</h5>
                            <table class="detail">
                                <tr>
                                    <td>Tanggal rilis</td>
                                    <td><span>: {{ $courses->created_at->format('d F Y') }}</span></td>
                                </tr>
                                <tr>
                                    <td>Tanggal update</td>
                                    <td>
                                        @if ($chapterInfo) 
                                        <span>: {{ $chapterInfo->updated_at->format('d F Y') }}</span>
                                        @else
                                            <span>: -</span> 
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tingkatan</td>
                                    <td>
                                        <span>:
                                            @if ($courses->type == 'beginner')
                                                Pemula
                                            @elseif ($courses->type == 'intermediate')
                                                Menengah
                                            @else
                                                Ahli
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jenis paket</td>
                                    <td>
                                        <span>: Kursus
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
    
                    <div class="card mb-3" data-aos="fade-up">
                        <div class="card-body">
                            <h5>Deskripsi Kursus</h5>
                            <p>{{ $courses->description }}</p>
                        </div>
                    </div>
    
                    <div class="card mb-3" data-aos="fade-up">
                        <div class="card-body">
                            <h5>Tools</h5>
                            <div class="d-flex">
                                @foreach ($coursetools->tools as $tool)
                                    <div class="card-tool px-2 pt-2 me-3 mb-3">
                                        <img src="{{ asset('storage/images/logoTools/' . $tool->logo_tools) }}" alt=""
                                            class="" width="50" height="50">
                                        <p>{{ $tool->name_tools }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="testimoni" id="testimoni" data-aos="fade-up">
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
                                                            <img src="{{ asset('storage/images/avatars/' . $review->user->avatar) }}" alt="User Avatar" class="avatar-img" style="border-radius: 50%">
                                                            @else
                                                            <img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}" alt="User Avatar" class="avatar-img" style="border-radius: 50%">
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
                                                            <img src="{{ asset('storage/images/avatars/' . $review->user->avatar) }}" alt="User Avatar" class="avatar-img" width="50" height="50" style="border-radius: 50%">
                                                            @else
                                                            <img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}" alt="User Avatar" class="avatar-img" width="50" height="50" style="border-radius: 50%">
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
                    </div>
                    
                </div>
    
                <!-- Kolom Kanan -->
                <div class="layout-kanan col-md-4 d-none d-md-block">
                    <div class="card-buy card mb-3" style="position: sticky; top: 100px;">
                        <div class="card-buy-body">
                            <div class="m-3">
                                @if ($bundling)
                                <p class="paket text-center mt-2 mb-0">Paket Combo</p>
                                @else
                                <p class="paket text-center mt-2 mb-0">Kursus</p>
                                @endif
                                <h3 class="card-title text-center mt-3" data-aos="zoom-out" data-aos-delay="100">Mulai Belajar
                                    Kursus Ini</h3>
                                <p class="text-center mx-3" data-aos="zoom-out" data-aos-delay="200">Belajar dimanapun dan kapanpun
                                    bersama kami, dan dapatkan akses kelas selamanya dengan bergabung di kursus ini</p>
                                <div class="benefit ms-3">
                                    <p class="" style="color: #414142">Keuntungan Belajar Kelas ini</p>
                                    <ul class="check-active-group mt-3 list-unstyled">
                                        <ul class="check-active-group mt-3 list-unstyled">
                                            <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                                data-aos-delay="100">
                                                <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                                <p class="m-0 p-0 ms-2">Akses kelas selamanya</p>
                                            </li>
                                            @if ($courses->resources != null)
                                            <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                                data-aos-delay="200">
                                                <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                                <p class="m-0 p-0 ms-2">Asset gratis</p>
                                            </li>
                                            @endif
                                            @if ($courses->price == 0)
                                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                                data-aos-delay="300">
                                                <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                                <p class="m-0 p-0 ms-2">Belajar gratis</p>
                                            </li>
                                            @endif
                                            @if ($bundling)
                                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                                data-aos-delay="400">
                                                <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                                <p class="m-0 p-0 ms-2">Bonus E-Book</p>
                                            </li>
                                            @endif
                                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                                data-aos-delay="600">
                                                <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                                <p class="m-0 p-0 ms-2">Grup diskusi private</p>
                                            </li>
                                            <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                                data-aos-delay="700">
                                                <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                                <p class="m-0 p-0 ms-2">Konsultasi dengan mentor</p>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                            <div class="">
                                <div class="mb-4">
                                    @if ($transaction == null)
                                    <p class="price-title text-center" style="color: #414142; margin:5px">Harga</p>
                                    @if ($courses->price != 0 && !$bundling)
                                        <h3 class="price text-center">Rp{{ number_format($courses->price, 0, ',', '.') }}</h3>
                                    @elseif ($bundling && $bundling->price != 0)
                                        <h3 class="price text-center">Rp{{ number_format($bundling->price, 0, ',', '.') }}</h3>
                                    @else
                                        <h3 class="price text-center">Gratis</h3>
                                    @endif
                                    @endif
                                </div>
    
                                @if ($transaction)
                                    @if ($transaction->status == 'pending')
                                        <a href="#" class="buy btn btn-warning w-100">Dalam Proses Pembayaran</a>
                                    @elseif ($transaction->status == 'success')
                                        @if (isset($lesson) && isset($lesson->episode))
                                            <a href="{{ route('member.course.play', ['slug' => $courses->slug, 'episode' => $lesson->episode]) }}"
                                                class="buy btn btn-warning w-100">Mulai Belajar</a>
                                        @else
                                            <a href="#" class="buy btn btn-warning w-100">Kelas Dalam Pembaruan</a>
                                        @endif
                                    @else
                                        <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                                            class="buy btn btn-warning w-100">Ambil Kelas</a>
                                    @endif
                                @else
                                    @if ($bundling)
                                    <a href="{{ route('member.payment', ['bundle_id' => $bundling->id]) }}"
                                        class="buy btn btn-warning w-100">Ambil Kelas</a>
                                    @else
                                        <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                                            class="buy btn btn-warning w-100">Ambil Kelas</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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