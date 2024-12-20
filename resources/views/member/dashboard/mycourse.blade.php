@extends('components.layouts.member.dashboard')

@section('title', 'Nemolab - Lihat informasi dan perkembangan anda disini')
@section('hide_footer')
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar-dashboard.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/dashboard-css/mycourse.css') }} ">
    @endpush
@section('content')

{{-- @if (Auth::user()->role == 'students')
@if (!$submission && $total_course >= 5)
    <div class="alert alert-warning alert-dismissible fade show text-black position-fixed fixed-top d-flex justify-center align-items-center"
        role="alert">
        Ingin jadi Mentor? klik
        <form action="{{ route('member.pengajuan', Auth::user()->id) }}" method="post">
            @csrf
            <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal"
                class="disini text-black ps-1 btn p-0 m-0 shadow-none"
                style="text-decoration: underline !important">Disini
            </button>
        </form>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@endif --}}
<section class="section-pilh-kelas" id="section-pilih-kelas">
        <div class="container-fluid mt-5 pt-5 mb-5">
            <div class="row">
                @include('components.includes.member.sidebar-dashboard')
                <!-- Cards -->
                <div class="card-container col-xl-9 col-lg-8 pe-4" id="course-card">
                    <div class="mb-4">
                        <h3 class="fw-bold">Kelas Saya</h3>
                    </div>
                    <div class="filter-transaction mb-3">
                        <ul class="nav-tabs">
                            <li><a href="{{ route('member.dashboard', ['filter' => 'semua']) }}" class="{{ request('filter') == 'semua' || !request('filter') ? 'active' : '' }}">Semua</a></li>
                            <li><a href="{{ route('member.dashboard', ['filter' => 'kursus']) }}" class="{{ request('filter') == 'kursus' ? 'active' : '' }}">Kursus</a></li>
                            <li><a href="{{ route('member.dashboard', ['filter' => 'ebook']) }}" class="{{ request('filter') == 'ebook' ? 'active' : '' }}">E-Book</a></li>
                        </ul>
                    </div>                                  
                    <div class="row mt-4">
                    @if($coursesData->isEmpty() && $ebooksData->isEmpty())
                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <div class="not-found text-center">
                                <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                <p class="mt-3">Kelas Tidak Tersedia</p>
                            </div>
                        </div>
                    @endif
                    @foreach ($coursesData as $course)
                        @if ($course->transactions->isNotEmpty())
                            <a href="{{ route('member.course.join', $course->slug) }}" class="col-md-4 d-flex justify-content-center pb-3 mt-1 text-decoration-none">
                                <div class="card">
                                    @if ($course->cover !=null)
                                        <img src="{{ asset('storage/images/covers/' . $course->cover) }}" class="card-img-top d-none d-md-block" alt="...">
                                    @else
                                        <img src="{{ asset('nemolab/member/img/NemolabBG.jpg') }}" class="card-img-top d-none d-md-block" alt="...">
                                    @endif
                                    <div class="card-body">
                                        <div>
                                        @if ($course->cover !=null)
                                            <img src="{{ asset('storage/images/covers/' . $course->cover) }}" alt="..." style="height: 40px;width: 60px; border-radius: 5px;" class="d-block d-md-none">
                                        @else
                                            <img src="{{ asset('nemolab/member/img/NemolabBG.jpg') }}" alt="..." style="height: 40px;width: 60px; border-radius: 5px;" class="d-block d-md-none">
                                        @endif
                                        </div>
                                        <div>
                                            <div class="title-card">
                                                <p class="fw-bold truncate-text" style="">{{ $course->name }}</p>
                                                <p class="tipe" style="color: #666666">Kelas {{ $course->type }}</p>
                                            </div>
                                            <div class="btn-group-harga d-flex justify-content-between align-items-center mt-md-3 gap-1 gap-md-0">
                                                <div class="harga d-block">
                                                    <p class="p-0 m-0 ">Status: <br class="d-none d-md-block"><span style="color: #666666">{{ $course->status }}</span></p>
                                                </div>
                                                <div class="harga d-block">
                                                    @if ($course->transaction) 
                                                        <p class="p-0 m-0">Bergabung: <br class="d-none d-md-block"> 
                                                            <span style="color: #666666">{{ $course->transaction->created_at->format('d-M-Y') }}</span>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach


                    @foreach ($ebooksData as $ebook)
                        @if ($ebook->transactions->isNotEmpty())
                        <a href="{{ route('member.ebook.join', $ebook->slug) }}" class="col-md-4 d-flex justify-content-center mt-1 pb-3 text-decoration-none">
                            <div class="card">
                                @if ($ebook->cover !=null)
                                    <img src="{{ asset('storage/images/covers/' . $ebook->cover) }}" class="card-img-top d-none d-md-block" alt="..." >
                                @else
                                        <img src="{{ asset('nemolab/member/img/NemolabBG.jpg') }}" class="card-img-top d-none d-md-block" alt="..." >
                                @endif
                                <div class="card-body">
                                    <div>
                                    @if ($ebook->cover !=null)
                                        <img src="{{ asset('storage/images/covers/' . $ebook->cover) }}" alt="..." style="height: 40px;width: 60px; border-radius: 5px;" class="d-block d-md-none">
                                    @else
                                        <img src="{{ asset('nemolab/member/img/NemolabBG.jpg') }}" alt="..." style="height: 40px;width: 60px; border-radius: 5px;" class="d-block d-md-none">
                                    @endif
                                    </div>
                                    <div>
                                        <div class="title-card">
                                            <p class="fw-bold truncate-text">{{ $ebook->name }}</p>
                                            <p class="tipe" style="color: #666666">E-Book {{ $ebook->type }}</p>
                                        </div>
                                        <div class="btn-group-harga d-flex justify-content-between align-items-center mt-md-3 gap-1 gap-md-0">
                                            <div class="harga d-block">
                                                @if ($ebook->transaction)
                                                    <p>Bergabung:  <span style="color: #666666">{{ $ebook->transaction->created_at->format('d-M-Y') }}</span></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('components.includes.member.sidebar-dashboard-mobile')
@endsection
@push('addon-script')
<script src="{{ asset('nemolab/member/js/scroll-dashboard.js') }}"></script>
@endpush