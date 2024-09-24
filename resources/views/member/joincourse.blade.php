@extends('components.layouts.member.navback')

@section('title', 'Join Kelas')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/joincourse.css') }}">
@endpush

@section('content')
    <!-- Header -->
    <div class="container mb-4" style="margin-top: 4rem">
        <div class="row">
            <div class="col-12 text-center">
                <h4 class="fw-semibold">{{ $course->name }}</h4>
                <div class="d-flex align-items-center justify-content-center flex-md-row flex-column"
                    style="margin-top: -6px; font-size: 15px">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('nemolab/member/img/global.png') }}" alt="" width="18"
                            height="18" />
                        <p class="m-0 ms-2 fw-light" style="font-size: 14px">Tanggal Rilis:
                            {{ $course->created_at->format('d F Y') }}</p>
                    </div>
                    <div class="rating d-flex ms-1 my-1 my-0 align-items-center">
                        <p class="m-0 ms-0 ms-md-5 me-2 fw-medium" style="font-size: 14px">4.9</p>
                        @for ($i = 0; $i < 5; $i++)
                            <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19"
                                height="19" />
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 p-lg-0 pe-lg-2">
                <img src="{{ asset('storage/images/covers/' . $course->cover) }}" alt="" width="100%"
                    class="rounded-4" style="max-height: 25rem; object-fit: cover" />
            </div>
            <div class="col-lg-4 mx-auto col-11 p-4 mt-4 mt-lg-0 border border-2 rounded-4 position-relative overflow-hidden shadow-sm"
                style="height: 25rem">
                @if ($chapters->isNotEmpty())
                    <p class="fw-semibold">{{ $chapters->count() }} Bab</p>
                    <div class="playlist">
                        @foreach ($chapters as $chapter)
                            <div class="play">
                                <div class="title d-flex">
                                    <img src="{{ asset('nemolab/member/img/play.png') }}" alt="" width="25"
                                        height="25" />
                                    <p class="ms-3 m-0">{{ $chapter->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($transaction)
                        @if ($transaction->status == 'pending')
                            <div class="alert alert-warning mt-3" role="alert">
                                Pembayaran anda sedang diproses.
                            </div>
                        @elseif ($transaction->status == 'success')
                            @if (!isset($lesson->episode))
                                <div class="alert alert-warning text-center" role="alert">
                                    Maaf, Kelas Masih Dalam Update
                                </div>
                            @else
                                <a
                                    href="{{ route('member.course.play', ['slug' => $course->slug, 'episode' => $lesson->episode]) }}">
                                    <div class="button">Mulai Belajar</div>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('member.payment', ['course_id' => $course->id]) }}">
                                <div class="button">Mulai Belajar</div>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('member.payment', ['course_id' => $course->id]) }}">
                            <div class="button">Mulai Belajar</div>
                        </a>
                    @endif
                @else
                    <p class="fw-semibold">0 Bab</p>
                @endif
            </div>
        </div>

        <!-- About -->
        <div class="row my-5">
            <div class="col-12">
                <h4 class="fw-semibold">Tentang Video</h4>
                <p class="mt-4" style="font-size: 14px">
                    {{ $course->description }}
                </p>
            </div>
            {{-- @if ($course->ebook)
                <div class="col-12 mt-4">
                    <h4 class="fw-semibold">About eBook</h4>
                    <p class="mt-4" style="font-size: 14px">
                        eBook adalah buku elektronik yang memungkinkan Anda untuk membaca dan belajar kapan saja dan di mana
                        saja melalui perangkat digital Anda. Dengan format yang fleksibel, eBook menawarkan cara baru yang
                        praktis untuk mengakses informasi dan konten pendidikan.
                    </p>
                    <a href="/member/joinebook"><button class="btn px-4 py-2 fw-medium text-white">Start
                            Learning</button></a>
                </div>
            @endif --}}
        </div>

        <!-- Tools -->
        @if (count($course->tools) > 0)
            <div class="row">
                <div class="col-12">
                    <h4 class="fw-semibold mb-4">Alat</h4>
                </div>
                <div class="col-12">
                    <div class="row">
                        @foreach ($course->tools as $tool)
                            <div class="col-12 col-md-6 col-lg-3 mb-4">
                                <a href="{{ $tool->link }}" class="text-decoration-none text-black">
                                    <div class="tools p-3 p-md-5 pt-lg-5 rounded-4">
                                        <div
                                            class="d-flex align-items-center justify-content-center text-center d-md-block">
                                            <div class="col-6 col-md-12">
                                                <img src="{{ asset('storage/images/logoTools/' . $tool->logo_tools) }}"
                                                    alt="" class="rounded-3 object-fit-cover" />
                                            </div>
                                            <div class="col-6 col-md-12">
                                                <p class="fw-semibold m-0 mt-md-4">
                                                    {{ $tool->name_tools }} <br />
                                                    Software Gratis
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Payment -->
        @if ($chapters->isNotEmpty())
            <div class="row my-5">
                <div class="col-12">
                    <h4 class="fw-semibold">Pembayaran</h4>
                </div>
                <div class="d-flex justify-content-md-between w-100" style="flex-wrap: wrap">
                    <div class="col-custom col-md-6 col-12 rounded-4 p-4 ms-lg-2 mt-4">
                        <img src="{{ asset('nemolab/member/img/payment-img.png') }}" alt="" width="70" />
                        <p class="mt-4 fw-light mb-1" style="font-size: 15px">Video</p>
                        <h5 class="fw-semibold">Rp {{ number_format($course->price, 0) }}</h5>
                        <p>Raih Akses Premium Seumur Hidup dan Bangun Proyek Nyata Anda Sendiri</p>
                        <hr class="mb-4 border-2" />
                        <div>
                            @foreach (['Akses Eksklusif Seumur Hidup', 'Raih Premium Istimewa', 'Konsultasi Karier Pribadi', 'Sertifikat Kelulusan Prestisius', 'Kesempatan Karier Bergengsi'] as $item)
                                <div class="profit">
                                    <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                        height="25" />
                                    <p>{{ $item }}</p>
                                </div>
                            @endforeach
                        </div>
                        @if (!isset($transaction) || $transaction->status == 'failed')
                            <a href="{{ route('member.payment', ['course_id' => $course->id]) }}"
                                class="text-decoration-none disabled text-capitalize">
                                <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Beli
                                    Kelas</button>
                            </a>
                        @elseif($transaction->status == 'success')
                        <a class="text-decoration-none disabled text-capitalize">
                            <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3" style="background-color: #a56e00; cursor: default">Sudah di Beli
                            </button>
                        </a>
                        @else
                            <div class="alert alert-warning mt-3 text-center text-capitalize" role="alert">
                                {{ $transaction->status }}
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        @endif
{{-- 
        <div class="row">
            <div class="col-12">
                <h4 class="fw-semibold mb-4">Ulasan</h4>
            </div>
            <div class="col-12">
                <div id="ulasanUser" class="carousel slide">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <div class="row text-black">
                            <div class="col-6">
                                <div class="ulasan border border-1 border-black p-4 rounded-4">
                                <div class="d-flex gap-3 mb-3 align-items-center">
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <p class="m-0 fw-semibold">(8.9K)</p>
                                </div>
                                <p class="desc-ulasan">Saya sangat puas dengan pelatihan ini. Instruktur yang berpengalaman dan dukungan komunitas sangat membantu saya dalam mengasah keterampilan desain web. Sangat direkomendasikan!</p>
                                <div class="d-flex gap-3 align-items-center">
                                    <div><img src="{{ asset('nemolab/admin/img/avatar.png') }}" alt="" width="50" /></div>
                                    <div>
                                    <h5 class="mb-0" style="font-size: 18px">Pria Ikhlas Sambada</h5>
                                    <p class="m-0" style="font-size: 11px">Mentor</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="ulasan border border-1 border-black p-4 rounded-4">
                                <div class="d-flex gap-3 mb-3 align-items-center">
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <p class="m-0 fw-semibold">(8.9K)</p>
                                </div>
                                <p class="desc-ulasan">Kursus ini benar-benar membuka wawasan saya tentang desain web. Materi yang disampaikan</p>
                                <div class="d-flex gap-3 align-items-center">
                                    <div><img src="{{ asset('nemolab/admin/img/avatar.png') }}" alt="" width="50" /></div>
                                    <div>
                                    <h5 class="mb-0" style="font-size: 18px">Reveiro Keyla Ega Pradana</h5>
                                    <p class="m-0" style="font-size: 11px">Mentor</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="row text-black">
                            <div class="col-6">
                                <div class="ulasan border border-1 border-black p-4 rounded-4">
                                <div class="d-flex gap-3 mb-3 align-items-center">
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <p class="m-0 fw-semibold">(8.9K)</p>
                                </div>
                                <p class="desc-ulasan">Saya sangat puas dengan pelatihan ini. Instruktur yang berpengalaman dan dukungan komunitas sangat membantu saya dalam mengasah keterampilan desain web. Sangat direkomendasikan!</p>
                                <div class="d-flex gap-3 align-items-center">
                                    <div><img src="{{ asset('nemolab/admin/img/avatar.png') }}" alt="" width="50" /></div>
                                    <div>
                                    <h5 class="mb-0" style="font-size: 18px">Vebrian</h5>
                                    <p class="m-0" style="font-size: 11px">Mentor</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="ulasan border border-1 border-black p-4 rounded-4">
                                <div class="d-flex gap-3 mb-3 align-items-center">
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <p class="m-0 fw-semibold">(8.9K)</p>
                                </div>
                                <p class="desc-ulasan">Kursus ini benar-benar membuka wawasan saya tentang desain web. Materi yang disampaikan</p>
                                <div class="d-flex gap-3 align-items-center">
                                    <div><img src="{{ asset('nemolab/admin/img/avatar.png') }}" alt="" width="50" /></div>
                                    <div>
                                    <h5 class="mb-0" style="font-size: 18px">Wahid Satrio Aji</h5>
                                    <p class="m-0" style="font-size: 11px">Mentor</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="row text-black">
                            <div class="col-6">
                                <div class="ulasan border border-1 border-black p-4 rounded-4">
                                <div class="d-flex gap-3 mb-3 align-items-center">
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <p class="m-0 fw-semibold">(8.9K)</p>
                                </div>
                                <p class="desc-ulasan">Saya sangat puas dengan pelatihan ini. Instruktur yang berpengalaman dan dukungan komunitas sangat membantu saya dalam mengasah keterampilan desain web. Sangat direkomendasikan!</p>
                                <div class="d-flex gap-3 align-items-center">
                                    <div><img src="{{ asset('nemolab/admin/img/avatar.png') }}" alt="" width="50" /></div>
                                    <div>
                                    <h5 class="mb-0" style="font-size: 18px">Naufal Muhammad Dzaky</h5>
                                    <p class="m-0" style="font-size: 11px">Mentor</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="ulasan border border-1 border-black p-4 rounded-4">
                                <div class="d-flex gap-3 mb-3 align-items-center">
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <img src="{{ asset('nemolab/member/img/star-ulasan.png') }}" alt="" width="17" height="17" />
                                    <p class="m-0 fw-semibold">(8.9K)</p>
                                </div>
                                <p class="desc-ulasan">Kursus ini benar-benar membuka wawasan saya tentang desain web. Materi yang disampaikan</p>
                                <div class="d-flex gap-3 align-items-center">
                                    <div><img src="{{ asset('nemolab/admin/img/avatar.png') }}" alt="" width="50" /></div>
                                    <div>
                                    <h5 class="mb-0" style="font-size: 18px">Muhammad Wildan Saputra</h5>
                                    <p class="m-0" style="font-size: 11px">Mentor</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="carousel-indicators position-relative mt-4">
                        <button class="prev" type="button" data-bs-target="#ulasanUser" data-bs-slide="prev">
                            <img src="{{ asset('nemolab/member/img/arrow-ulasan.png') }}" alt="" width="50" style="position: absolute; left: 19rem; top:-6px;">
                        </button>
                        <button type="button" data-bs-target="#ulasanUser" data-bs-slide-to="0" class="active point" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#ulasanUser" data-bs-slide-to="1" aria-label="Slide 2" class="point"></button>
                        <button type="button" data-bs-target="#ulasanUser" data-bs-slide-to="2" aria-label="Slide 3" class="point"></button>

                        <button class="next" type="button" data-bs-target="#ulasanUser" data-bs-slide="next">
                            <img src="{{ asset('nemolab/member/img/arrow-ulasan.png') }}" alt="" width="50" style="position: absolute; right: 19rem; top:-6px; transform: scaleX(-1); ">
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
