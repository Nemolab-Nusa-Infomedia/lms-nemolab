@extends('components.layouts.member.dashboard')

@section('title', 'Nemolab - Detail E-Book')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/joincourse.css') }}">
@endpush

@section('content')
<main class="container mt-5 pt-5 pb-5">
    <div class="">
        <div class="col-md-8">
        <h3 data-aos="fade-right" style="word-wrap: break-word; white-space: normal;">{{ $ebooks->name }}</h3>
        </div>
        <div class="row mt-3">
            <!-- Kolom Kiri -->
            <div class="layout-kiri col-md-8">
                <div class="card-preview mb-3">
                    @if ($ebooks->cover != null)
                        <img src="{{ url('storage/images/covers/' . $ebooks->cover) }}" alt="">
                    @else
                        <img src="{{ asset('nemolab/member/img/NemolabBG.jpg') }}" alt="">
                    @endif
                </div>
                <div class="card mb-3 d-md-none">
                    <div class="card-buy-body">
    
                            <p class="paket text-center mt-2 mb-0">E-Book</p>
                            <h3 class="card-title text-center mt-3" data-aos="zoom-out" data-aos-delay="100">Mulai Belajar
                                E-Book Ini</h3>
                            <p class="text-center mx-3" data-aos="zoom-out" data-aos-delay="200">Belajar dimanapun dan kapanpun
                                bersama kami, dan dapatkan akses E-Book selamanya dengan Mengambil E-Book ini</p>
                            <div class="benefit ms-3">
                                <p class="" style="color: #414142">Keuntungan Belajar E-Book ini</p>
                                <ul class="check-active-group mt-3 list-unstyled">
                                    <ul class="check-active-group mt-3 list-unstyled">
                                        <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                            data-aos-delay="100">
                                            <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="15" height="16" rx="4" fill="#58AE47"/>
                                                <path d="M11.8468 5.80908L6.31002 10.8607C6.26179 10.9049 6.20449 10.9399 6.14139 10.9638C6.0783 10.9877 6.01065 11 5.94234 11C5.87402 11 5.80637 10.9877 5.74328 10.9638C5.68018 10.9399 5.62288 10.9049 5.57466 10.8607L3.1523 8.65062C3.10401 8.60657 3.06571 8.55427 3.03958 8.49671C3.01345 8.43915 3 8.37746 3 8.31516C3 8.25286 3.01345 8.19117 3.03958 8.13361C3.06571 8.07605 3.10401 8.02376 3.1523 7.9797C3.20058 7.93565 3.2579 7.9007 3.32099 7.87686C3.38408 7.85302 3.45169 7.84075 3.51998 7.84075C3.58826 7.84075 3.65588 7.85302 3.71896 7.87686C3.78205 7.9007 3.83937 7.93565 3.88766 7.9797L5.94277 9.85472L11.1123 5.13895C11.2099 5.04998 11.3421 5 11.48 5C11.6179 5 11.7502 5.04998 11.8477 5.13895C11.9452 5.22792 12 5.34859 12 5.47441C12 5.60023 11.9452 5.7209 11.8477 5.80987L11.8468 5.80908Z" fill="white"/>
                                                </svg>
                                            <p class="m-0 p-0 ms-2">Akses E-Book selamanya</p>
                                        </li>
                                        @if ($ebooks->price == 0)
                                        <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                            data-aos-delay="300">
                                            <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="15" height="16" rx="4" fill="#58AE47"/>
                                                <path d="M11.8468 5.80908L6.31002 10.8607C6.26179 10.9049 6.20449 10.9399 6.14139 10.9638C6.0783 10.9877 6.01065 11 5.94234 11C5.87402 11 5.80637 10.9877 5.74328 10.9638C5.68018 10.9399 5.62288 10.9049 5.57466 10.8607L3.1523 8.65062C3.10401 8.60657 3.06571 8.55427 3.03958 8.49671C3.01345 8.43915 3 8.37746 3 8.31516C3 8.25286 3.01345 8.19117 3.03958 8.13361C3.06571 8.07605 3.10401 8.02376 3.1523 7.9797C3.20058 7.93565 3.2579 7.9007 3.32099 7.87686C3.38408 7.85302 3.45169 7.84075 3.51998 7.84075C3.58826 7.84075 3.65588 7.85302 3.71896 7.87686C3.78205 7.9007 3.83937 7.93565 3.88766 7.9797L5.94277 9.85472L11.1123 5.13895C11.2099 5.04998 11.3421 5 11.48 5C11.6179 5 11.7502 5.04998 11.8477 5.13895C11.9452 5.22792 12 5.34859 12 5.47441C12 5.60023 11.9452 5.7209 11.8477 5.80987L11.8468 5.80908Z" fill="white"/>
                                                </svg>
                                            <p class="m-0 p-0 ms-2">E-Book gratis</p>
                                        </li>
                                        @endif
                                    </ul>
                                </ul>
                            </div>
                        <div class="p-0">
                            @if ($transaction == null)
                                @if ($ebooks->price != 0)
                                    <h3 class="price text-center">Rp{{ number_format($ebooks->price, 0, ',', '.') }}</h3>
                                @else
                                    <h3 class="price text-center">Gratis</h3>
                                @endif
                            @endif
    
                            @if ($transaction)
                                @if ($transaction->status == 'pending')
                                    <a href="#" class="buy btn btn-warning w-100">Dalam Proses Pembayaran</a>
                                @elseif ($transaction->status == 'success')
                                    <a href="{{ route('member.ebook.read', ['slug' => $ebooks->slug]) }}" class="buy btn btn-warning w-100">Mulai Baca</a>
                                @else
                                    <a href="{{ route('member.payment', ['ebook_id' => $ebooks->id]) }}" class="buy btn btn-warning w-100">Ambil E-Book</a>
                                @endif
                            @else
                                @if (in_array($ebooks->id, $InBundle))
                                <a href="" class="buy btn btn-warning w-100">Terdapat Paket Combo</a>
                                @else
                                <a href="{{ route('member.payment', ['ebook_id' => $ebooks->id]) }}" class="buy btn btn-warning w-100">Ambil E-Book</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
    
                <div class="card mb-3" data-aos="fade-up">
                    <div class="card-body">
                        <h5>Detail Ebook</h5>
                        <table class="detail">
                            <tr>
                                <td>Tanggal rilis</td>
                                <td><span>: {{ $ebooks->created_at->format('d F Y') }}</span></td>
                            </tr>
                            <tr>
                                <td>Tanggal update</td>
                                <td><span>: {{ $ebooks->updated_at->format('d F Y') }}</span></td>
                            </tr>
                            <tr>
                                <td>Tingkatan</td>
                                <td><span>: {{ ucfirst($ebooks->level) }}</span></td>
                            </tr>
                            <tr>
                                <td>Jenis paket</td>
                                <td><span>: E-Book</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
    
                <div class="card mb-3" data-aos="fade-up">
                    <div class="card-body">
                       <h5>Deskripsi E-Book</h5>
                       <p>{{ $ebooks->description }}</p>
                    </div>
                </div>
                {{-- <div class="testimoni" id="testimoni" data-aos="fade-up">
                    <div class="container-fluid">
                    @if ($reviews->isNotEmpty())
                        <h5>Testimoni</h5>
                        <div class="col-12 mt-4">
                            <div class="row card-testimoni d-none d-md-flex">
                                @foreach ($reviews as $index => $review)
                                    <div class="col-12 col-md-6 testimoni-card review-item" data-index="{{ $index }}" style="{{ $index >= 2 ? 'display: none;' : '' }}">
                                        <div class="card mb-4">
                                            <div class="card-body" style="150px">
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
                                                <div class="card-body" style="150px">
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
    
            </div>
    
            <!-- Kolom Kanan -->
            <div class="layout-kanan col-md-4 d-none d-md-block">
                <div class="card-buy card mb-3" style="position: sticky; top: 100px;">
                    <div class="card-buy-body">
                        <div class="m-2">
                            <p class="paket text-center mt-2 mb-0">E-Book</p>
                            <h3 class="card-title text-center mt-3" data-aos="zoom-out" data-aos-delay="100">Mulai Belajar
                                E-Book Ini</h3>
                            <p class="text-center mx-3" data-aos="zoom-out" data-aos-delay="200">Belajar dimanapun dan kapanpun
                                bersama kami, dan dapatkan akses E-Book selamanya dengan Mengambil E-Book ini</p>
                            <div class="benefit ms-3">
                                <p class="" style="color: #414142">Keuntungan Belajar E-Book ini</p>
                                <ul class="check-active-group mt-3 list-unstyled">
                                    <ul class="check-active-group mt-3 list-unstyled">
                                        <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                            data-aos-delay="100">
                                            <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="15" height="16" rx="4" fill="#58AE47"/>
                                                <path d="M11.8468 5.80908L6.31002 10.8607C6.26179 10.9049 6.20449 10.9399 6.14139 10.9638C6.0783 10.9877 6.01065 11 5.94234 11C5.87402 11 5.80637 10.9877 5.74328 10.9638C5.68018 10.9399 5.62288 10.9049 5.57466 10.8607L3.1523 8.65062C3.10401 8.60657 3.06571 8.55427 3.03958 8.49671C3.01345 8.43915 3 8.37746 3 8.31516C3 8.25286 3.01345 8.19117 3.03958 8.13361C3.06571 8.07605 3.10401 8.02376 3.1523 7.9797C3.20058 7.93565 3.2579 7.9007 3.32099 7.87686C3.38408 7.85302 3.45169 7.84075 3.51998 7.84075C3.58826 7.84075 3.65588 7.85302 3.71896 7.87686C3.78205 7.9007 3.83937 7.93565 3.88766 7.9797L5.94277 9.85472L11.1123 5.13895C11.2099 5.04998 11.3421 5 11.48 5C11.6179 5 11.7502 5.04998 11.8477 5.13895C11.9452 5.22792 12 5.34859 12 5.47441C12 5.60023 11.9452 5.7209 11.8477 5.80987L11.8468 5.80908Z" fill="white"/>
                                                </svg>
                                            <p class="m-0 p-0 ms-2">Akses E-Book selamanya</p>
                                        </li>
                                        @if ($ebooks->price == 0)
                                        <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                            data-aos-delay="300">
                                            <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="15" height="16" rx="4" fill="#58AE47"/>
                                                <path d="M11.8468 5.80908L6.31002 10.8607C6.26179 10.9049 6.20449 10.9399 6.14139 10.9638C6.0783 10.9877 6.01065 11 5.94234 11C5.87402 11 5.80637 10.9877 5.74328 10.9638C5.68018 10.9399 5.62288 10.9049 5.57466 10.8607L3.1523 8.65062C3.10401 8.60657 3.06571 8.55427 3.03958 8.49671C3.01345 8.43915 3 8.37746 3 8.31516C3 8.25286 3.01345 8.19117 3.03958 8.13361C3.06571 8.07605 3.10401 8.02376 3.1523 7.9797C3.20058 7.93565 3.2579 7.9007 3.32099 7.87686C3.38408 7.85302 3.45169 7.84075 3.51998 7.84075C3.58826 7.84075 3.65588 7.85302 3.71896 7.87686C3.78205 7.9007 3.83937 7.93565 3.88766 7.9797L5.94277 9.85472L11.1123 5.13895C11.2099 5.04998 11.3421 5 11.48 5C11.6179 5 11.7502 5.04998 11.8477 5.13895C11.9452 5.22792 12 5.34859 12 5.47441C12 5.60023 11.9452 5.7209 11.8477 5.80987L11.8468 5.80908Z" fill="white"/>
                                                </svg>
                                            <p class="m-0 p-0 ms-2">E-Book gratis</p>
                                        </li>
                                        @endif
                                    </ul>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="p-0">
                            @if ($transaction == null)
                                @if ($ebooks->price != 0)
                                    <h3 class="price text-center">Rp{{ number_format($ebooks->price, 0, ',', '.') }}</h3>
                                @else
                                    <h3 class="price text-center">Gratis</h3>
                                @endif
                            @endif
    
                            @if ($transaction)
                                @if ($transaction->status == 'pending')
                                    <a href="#" class="buy btn btn-warning w-100">Dalam Proses Pembayaran</a>
                                @elseif ($transaction->status == 'success')
                                    <a href="{{ route('member.ebook.read', ['slug' => $ebooks->slug]) }}" class="buy btn btn-warning w-100">Mulai Baca</a>
                                @else
                                    <a href="{{ route('member.payment', ['ebook_id' => $ebooks->id]) }}" class="buy btn btn-warning w-100">Ambil E-Book</a>
                                @endif
                            @else
                                @if (in_array($ebooks->id, $InBundle))
                                <a href="" class="buy btn btn-warning w-100">Terdapat Paket Combo</a>
                                @else
                                <a href="{{ route('member.payment', ['ebook_id' => $ebooks->id]) }}" class="buy btn btn-warning w-100">Ambil E-Book</a>
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
