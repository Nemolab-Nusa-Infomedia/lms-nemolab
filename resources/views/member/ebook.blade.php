@extends('components.layouts.member.app')

@section('title', $ebook->name)

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/ebook.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf_viewer.min.css">
@endpush

@section('content')
    <!-- Header -->
    <div class="container mb-4" style="margin-top: 7rem">
        <div class="row">
            <div class="col-12 text-center justify-content-center">
                <p>{{ $fileUrl }}</p>
                <h4 class="fw-semibold">{{ $ebook->name }}</h4>
                <!-- Ini -->
                <div class="d-flex align-items-center justify-content-center flex-md-row flex-column"
                    style="margin-top: -6px; font-size: 15px">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('nemolab/member/img/global.png') }}" alt="" width="18" height="18"
                            class="m-0" />
                        <p class="m-0 ms-2 fw-light" style="font-size: 14px">Release date: {{ $ebook->created_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container mb-5" id="ebook" data-pdf="{{ asset('storage/file_pdf/' . $ebook->file_ebook) }}">
        <div class="row">
            <div class="col-12 rounded-3 position-relative p-0 overflow-hidden">
                <!-- Ebook Tools -->
                <div class="tools p-4 px-5 w-100 d-flex justify-content-between align-items-center"
                    style="background-color: #faa907">
                    <div class="d-flex zoom">
                        <img src="{{ asset('nemolab/member/img/zoomin.png') }}" id="zoom-in" alt=""
                            width="30" />
                        <img src="{{ asset('nemolab/member/img/zoomout.png') }}" id="zoom-out" alt=""
                            width="30" class="ms-3" />
                        <img src="{{ asset('nemolab/member/img/reset.png') }}" id="reset-zoom" alt="" width="30"
                            class="ms-3" />
                    </div>
                    <div>
                        <span class="page-info text-white">
                            <img src="{{ asset('nemolab/member/img/chevron-left-white.png') }}" id="prev-page"
                                alt="" width="20">
                            <input type="number" id="page-input" min="1"
                                style="width: 30px; border: none; background: none; color: white; text-align: center;" />
                            <span class="ms-2 m-sm-0">/</span>
                            <span id="page-count" class="ms-3"></span>
                            <img class="ms-2" src="{{ asset('nemolab/member/img/chevron-right-white.png') }}"
                                id="next-page" alt="" width="20">
                        </span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="ms-5">
                            <img src="{{ asset('nemolab/member/img/fullscreen.png') }}" id="pdf-fullscreen" alt=""
                                width="30" />
                        </div>
                    </div>
                </div>
                <!-- PDF -->
                <div class="pdf-height">
                    <div class="pdf-preview d-flex" id="pdf-scrollable-container">
                        <img src="{{ asset('nemolab/member/img/loading.gif') }}" id="pdf-loading" class="loading mx-auto" alt="Loading" />
                        <canvas class="pdf-render mx-auto" id="pdf-render"></canvas>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('member.ebook.detail' , $ebook->slug) }}" class="btn btn-secondary flex-grow-1 me-2" style="background-color: #414142 !important;">Detail E-Book</a>
                    @if (!$checkReview)
                    <a href="{{ route('member.review.ebook' , $ebook->slug) }}" class="btn btn-primary flex-grow-1">Masukan Review</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('prepend-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.min.js"></script>
    <script src="{{ asset('nemolab/member/js/ebook.js') }}"></script>
@endpush