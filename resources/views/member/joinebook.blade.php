@extends('components.layouts.member.navback')

@section('title', 'Tentang Buku')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/joincourse.css') }} ">
@endpush

@section('content')
    <div class="container" style="margin-top: 5rem">
        {{-- Header --}}
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3 p-lg-0 pe-lg-2">
              <div>
                <img src="{{ asset('storage/images/covers/ebook/' . $ebook->cover) }}" alt="" width="100%" class="cover rounded-4 shadow-sm" style="height: 27rem; object-fit: cover" />
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-9 ps-md-4 mt-4 mt-lg-0">
              <div>
                <h3 class="fw-semibold">{{ $ebook->name }}</h3>
                <p class="fw-light mt-4" style="font-size: 15px">{{ $ebook->category }}</p>
                <hr />
                @if ($ebook->type == 'premium')
                <p class="m-0 fw-semibold text-warning">{{ $ebook->type }}</p>
                @else
                <p class="m-0 fw-semibold text-success">{{ $ebook->type }}</p>
                @endif
                <hr />
                <div class="d-flex flex-md-row flex-column" style="font-size: 15px">
                    <div class="d-flex align-items-center">
                    <img src="{{ asset('nemolab/member/img/global.png') }}" alt="" width="18" height="18" class="m-0" />
                    <p class="m-0 ms-2 fw-light" style="font-size: 14px">Release Date: {{ $ebook->created_at->format('d F Y') }}</p>
                    </div>
                    <div class="rating d-flex ms-1 my-2 my-0 align-items-center">
                    <p class="m-0 ms-0 ms-md-5 me-2 fw-medium" style="font-size: 14px">4.9</p>
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
                    </div>
                </div>
                @if ($ebook->type == 'premium')
                <a href="{{ route('member.ebook.read', ['slug' => $ebook->slug]) }}"><button class="btn px-5 py-2 mt-5 text-white fw-semibold rounded-3 text-decoration-none">Beli Buku</button></a>
                @else
                <a href="{{ route('member.ebook.read', ['slug' => $ebook->slug]) }}"><button class="btn px-5 py-2 mt-5 text-white fw-semibold rounded-3 text-decoration-none">Dapatkan Buku</button></a>
                @endif
              </div>
            </div>
        </div>

        <!-- About & Daftar isi-->
        <div class="row my-5">
            <div class="col-12 col-lg-12 pe-lg-4">
            <h4 class="fw-semibold">Tentang</h4>
            <p class="mt-4" style="font-size: 14px; text-align: justify">
                {{ $ebook->description }}
            </p>
            </div>
        </div>

        <!-- Payment -->
        <div class="row">
            <div class="col-12">
                <h4 class="fw-semibold">Pembayaran</h4>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="border border-2 rounded-4 p-4 mt-4 shadow-sm">
                    <img src="{{ asset('nemolab/member/img/payment-img.png') }}" alt="" width="70" />
                    <p class="mt-4 fw-light mb-1" style="font-size: 15px">Ebook</p>
                    <h5 class="fw-semibold">Rp. {{ number_format($ebook->price, 0, ',', '.') }}</h5>
                    <p>Raih Akses Premium Seumur Hidup dan Bangun Proyek Nyata Anda Sendiri</p>
                    <hr class="mb-4 border-2" />
                    <div>
                        @foreach (['Akses Eksklusif Seumur Hidup', 'Raih Premium Istimewa', 'Konten Berkualitas', 'Praktis dan Fleksibel', 'Teruji'] as $item)
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25" height="25" />
                            <p>{{ $item }}</p>
                        </div>
                        @endforeach
                    </div>
                    @if ($ebook->type == 'premium')
                    <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Beli Buku</button>
                    @else
                    <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Dapatkan Buku</button>
                    @endif
                </div>
            </div>

            @if ($ebook->course_id)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="border border-2 rounded-4 p-4 mt-4 shadow-sm">
                    <img src="{{ asset('nemolab/member/img/payment-img.png') }}" alt="" width="70" />
                    <p class="mt-4 fw-light mb-1" style="font-size: 15px">Video</p>
                    <h5 class="fw-semibold">Rp. {{ number_format($ebook->course->price, 0, ',', '.') }}</h5>
                    <p>Raih Akses Premium Seumur Hidup dan Bangun Proyek Nyata Anda Sendiri</p>
                    <hr class="mb-4 border-2" />
                    <div>
                        @foreach (['Akses Eksklusif Seumur Hidup', 'Raih Premium Istimewa', 'Konsultasi Karier Pribadi', 'Sertifikat Kelulusan Prestisius', 'Kesempatan Karier Bergengsi'] as $item)
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25" height="25" />
                            <p>{{ $item }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('member.course.join', ['slug' => $ebook->course->slug]) }}" class="btn mx-auto d-flex py-2 mt-3 text-white fw-semibold rounded-3">Lihat</a>
                        <button class="btn mx-auto py-2 px-5 d-flex mt-3 text-white fw-semibold rounded-3">Beli Course</button>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="border border-2 rounded-4 p-4 mt-4 shadow-sm">
                    <img src="{{ asset('nemolab/member/img/payment-img.png') }}" alt="" width="70" />
                    <p class="mt-4 fw-light mb-1" style="font-size: 15px">Bundle</p>
                    <h5 class="fw-semibold">Rp. {{ number_format($ebook->price + $ebook->course->price, 0, ',', '.') }}</h5>
                    <p>Raih Akses Premium Seumur Hidup dan Bangun Proyek Nyata Anda Sendiri</p>
                    <hr class="mb-4 border-2" />
                    <div>
                        @foreach (['Akses Eksklusif Seumur Hidup', 'Raih Keduanya Dengan Harga Hemat', 'Konsultasi Karier Pribadi', 'Sertifikat Kelulusan Prestisius', 'Kesempatan Karier Bergengsi'] as $item)
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25" height="25" />
                            <p>{{ $item }}</p>
                        </div>
                        @endforeach
                    </div>
                    <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Beli Bundle</button>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
