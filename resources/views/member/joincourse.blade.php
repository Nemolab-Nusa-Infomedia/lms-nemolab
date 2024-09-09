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
                        <p class="m-0 ms-2 fw-light" style="font-size: 14px">Release Date:
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
                    <p class="fw-bold">{{ $chapters->count() }} Chapter</p>
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
                            <a
                                href="{{ route('member.course.play', ['slug' => $course->slug, 'episode' => $lesson->episode]) }}">
                                <div class="button">Start Learning</div>
                            </a>
                        @else
                            <a href="{{ route('member.payment', ['course_id' => $course->id]) }}">
                                <div class="button">Start Learning</div>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('member.payment', ['course_id' => $course->id]) }}">
                            <div class="button">Start Learning</div>
                        </a>
                    @endif
                @else
                    <p class="fw-bold">0 Chapter</p>
                @endif
            </div>
        </div>

        <!-- About -->
        <div class="row my-5">
            <div class="col-12">
                <h4 class="fw-semibold">About Video</h4>
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
        <div class="row">
            <div class="col-12">
                <h4 class="fw-semibold mb-4">Tools</h4>
            </div>
            <div class="col-12">
                <div class="row">
                    @foreach ($course->tools as $tool)
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                            <a href="{{ $tool->link }}" class="text-decoration-none text-black">
                            <div class="tools p-3 p-md-5 pt-lg-5 rounded-4">
                                <div class="d-flex align-items-center justify-content-center text-center d-md-block">
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

        <!-- Payment -->
        @if ($chapters->isNotEmpty())
            <div class="row my-5">
                <div class="col-12">
                    <h4 class="fw-semibold">Payment</h4>
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
                            <div class="alert alert-success mt-3 text-center text-capitalize" role="alert">
                                Kelas Sudah Di Beli
                            </div>
                        @else
                            <div class="alert alert-warning mt-3 text-center text-capitalize" role="alert">
                                {{ $transaction->status }}
                            </div>
                        @endif
                        {{-- <a href="{{ route('member.payment', ['course_id' => $course->id]) }}"
                        class="text-decoration-none">
                        <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Beli
                            Kelas</button>
                    </a> --}}
                    </div>
                    {{-- @if (
                        $course->ebook &&
                            (!isset($transactionForEbook) || ($transactionForEbook && $transactionForEbook->status == 'failed')))
                        <div class="col-custom col-12 border border-2 rounded-4 p-4 ms-lg-2 mt-4 shadow-sm">
                            <img src="{{ asset('nemolab/member/img/payment-img.png') }}" alt="" width="70" />
                            <p class="mt-4 fw-light mb-1" style="font-size: 15px">eBook</p>
                            <h5 class="fw-semibold">Rp {{ number_format($course->ebook->price, 0) }}</h5>
                            <p>Raih Akses Premium Seumur Hidup dan Bangun Proyek Nyata Anda Sendiri</p>
                            <hr class="mb-4 border-2" />
                            <div>
                                @foreach (['Akses Eksklusif Seumur Hidup', 'Raih Premium Istimewa', 'Konsultasi Karier Pribadi', 'Sertifikat Kelulusan Prestisius', 'Kesempatan Karier Bergengsi'] as $item)
                                    <div class="profit">
                                        <img src="{{ asset('nemolab/member/img/check.png') }}" alt=""
                                            width="25" height="25" />
                                        <p>{{ $item }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ route('member.payment', ['ebook_id' => $course->ebook->id]) }}"
                                class="text-decoration-none">
                                <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Beli
                                    eBook</button>
                            </a>
                        </div>
                    @endif
                    @if ($course->ebook && !isset($transaction) && !isset($transactionForEbook))
                        <div class="col-custom col-12 border border-2 rounded-4 p-4 ms-lg-2 mt-4 shadow-sm">
                            <img src="{{ asset('nemolab/member/img/payment-img.png') }}" alt=""
                                width="70" />
                            <p class="mt-4 fw-light mb-1" style="font-size: 15px">Video & eBook</p>
                            <h5 class="fw-semibold">Rp {{ number_format($course->price + $course->ebook->price, 0) }}</h5>
                            <p>Raih Akses Premium Seumur Hidup dan Bangun Proyek Nyata Anda Sendiri</p>
                            <hr class="mb-4 border-2" />
                            <div>
                                @foreach (['Akses Eksklusif Seumur Hidup', 'Raih Premium Istimewa', 'Konsultasi Karier Pribadi', 'Sertifikat Kelulusan Prestisius', 'Kesempatan Karier Bergengsi'] as $item)
                                    <div class="profit">
                                        <img src="{{ asset('nemolab/member/img/check.png') }}" alt=""
                                            width="25" height="25" />
                                        <p>{{ $item }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ route('member.payment', ['course_id' => $course->id, 'ebook_id' => $course->ebook->id]) }}"
                                class="text-decoration-none">
                                <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Beli
                                    Paket</button>
                            </a>
                        </div>
                    @endif --}}
                </div>
            </div>
        @endif
    </div>
@endsection
