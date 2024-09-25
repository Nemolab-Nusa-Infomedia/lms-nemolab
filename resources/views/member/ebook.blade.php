@extends('components.layouts.member.app')

@section('title', 'eBook')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/ebook.css') }} ">
@endpush

@section('content')
    <!-- Header -->
    <div class="container mb-4" style="margin-top: 7rem">
        <div class="row">
            <div class="col-12 text-center justify-content-center">
                <h4 class="fw-semibold">Belajar Livewire Menengah: Membuat Aplikasi Manajemen<br />Karyawan Sederhana</h4>
                <p class="fw-light mt-3" style="font-size: 15px">Learn how to design Management from scratch</p>
                <!-- Ini -->
                <div class="d-flex align-items-center justify-content-center flex-md-row flex-column"
                    style="margin-top: -6px; font-size: 15px">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('nemolab/member/img/global.png') }}" alt="" width="18" height="18"
                            class="m-0" />
                        <p class="m-0 ms-2 fw-light" style="font-size: 14px">Release date June 2022</p>
                    </div>
                    <div class="rating d-flex ms-1 my-1 my-0 align-items-center">
                        <p class="m-0 ms-0 ms-md-5 me-2 fw-medium" style="font-size: 14px">4.9</p>
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19"
                            height="19" />
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19"
                            height="19" />
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19"
                            height="19" />
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19"
                            height="19" />
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19"
                            height="19" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container" id="ebook">
        <div class="row">
            <div class="col-12 rounded-3 position-relative p-0 overflow-hidden shadow">
                <!-- Tools -->
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
                            <span>/</span>
                            <span id="page-count" style="margin-left:20px;"></span>
                            <img class="ms-2" src="{{ asset('nemolab/member/img/chevron-right-white.png') }}"
                                id="next-page" alt="" width="20">
                        </span>
                    </div>
                    <div class="d-flex align-items-center">
                        {{-- <div class="search rounded-1 px-2">
                          <label for="search"><img src="{{ asset('nemolab/member/img/search-ebook.png') }}"
                                  alt="" width="25" /></label>
                          <input type="text" id="search" />
                      </div> --}}
                        <div class="ms-5">
                            <img src="{{ asset('nemolab/member/img/fullscreen.png') }}" id="pdf-fullscreen" alt=""
                                width="30" />
                        </div>
                    </div>
                </div>
                <!-- PDF -->
                <div class="pdf-height">
                    <div class="pdf-preview d-flex" id="pdf-scrollable-container">
<<<<<<< Updated upstream
                        <canvas class="pdf-render mx-auto" id="pdf-render"></canvas>
=======
                        <canvas class="mx-auto" id="pdf-render"></canvas>
>>>>>>> Stashed changes
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('prepend-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script src="{{ asset('nemolab/member/js/ebook.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf_viewer.min.css"></script>
@endpush
