<!-- resources/views/member/joinebook.blade.php -->

@extends('components.layouts.member.navback')

@section('title', 'Join Kelas')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/joincourse.css') }}">
@endpush

@section('content')
    <!-- Header -->
    <div class="container mb-4" style="margin-top: 4rem">
        <div class="row">
            <div class="col-12 text-center justify-content-center">
                <h4 class="fw-semibold">{{ $ebook->name }}</h4>
                <div class="d-flex align-items-center justify-content-center flex-md-row flex-column" style="margin-top: -6px; font-size: 15px">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('nemolab/member/img/global.png') }}" alt="" width="18" height="18" class="m-0" />
                        <p class="m-0 ms-2 fw-light" style="font-size: 14px">Release Date: {{ $ebook->created_at->format('d F Y') }}</p>
                    </div>
                    <div class="rating d-flex ms-1 my-1 my-0 align-items-center">
                        <p class="m-0 ms-0 ms-md-5 me-2 fw-medium" style="font-size: 14px">4.9</p>
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 p-lg-0 pe-lg-2">
                <img src="{{ asset('nemolab/member/img/cover_image_6.jpg') }}" alt="" height="100%" width="40%" class="rounded-4" style="margin-left:30%; max-height: 25rem; object-fit: fill" />
            </div>
            <div class="col-lg-4 mx-auto col-11 p-4 mt-4 mt-lg-0 border border-2 rounded-4 position-relative overflow-hidden shadow-sm" style="height: 25rem">
                <p class="fw-bold">Daftar Isi</p>
                <!-- Design sections -->
                <div class="playlist">
                    <div class="play">
                        <div class="title d-flex">
                            <img src="{{ asset('nemolab/member/img/play.png') }}" alt="" width="25" height="25" />
                            <p class="ms-3 m-0">Bab 1 Mengenal Laravel</p>
                        </div>
                    </div>
                    <div class="play">
                        <div class="title d-flex">
                            <img src="{{ asset('nemolab/member/img/play.png') }}" alt="" width="25" height="25" />
                            <p class="ms-3 m-0">Bab 2 Mengenal MVC</p>
                        </div>
                    </div>
                    <!-- Tambahkan bab lainnya sesuai kebutuhan -->
                </div>
                <a href="{{ route('member.ebook.read', $ebook->id) }}">
                    <div class="button">Start Learning</div>
                </a>
            </div>
        </div>

        <!-- About -->
        <div class="row my-5">
            <div class="col-12">
                <h4 class="fw-semibold">About eBook</h4>
                <p class="mt-4" style="font-size: 14px">
                    {{ $ebook->description }}
                </p>
            </div>
        </div>

        <!-- Payment (Opsional) -->
        {{-- 
        <div class="row my-5">
            <div class="col-12">
                <h4 class="fw-semibold">Payment</h4>
            </div>
            <div class="d-flex justify-content-md-between w-100" style="flex-wrap: wrap">
                <div class="col-custom col-md-6 col-12 rounded-4 p-4 ms-lg-2 mt-4">
                    <img src="{{ asset('nemolab/member/img/payment-img.png') }}" alt="" width="70" />
                    <p class="mt-4 fw-light mb-1" style="font-size: 15px">eBook</p>
                    <h5 class="fw-semibold">Rp {{ number_format($ebook->price, 0, ',', '.') }}</h5>
                    <p>Gain Lifetime Premium Access and Build Your Own Real Project.</p>
                    <hr class="mb-4 border-2" />
                    <a href="{{ url('/buy-class') }}" class="text-decoration-none">
                        <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Buy Class</button>
                    </a>
                </div>
            </div>
        </div>
        --}}
    </div>
@endsection
