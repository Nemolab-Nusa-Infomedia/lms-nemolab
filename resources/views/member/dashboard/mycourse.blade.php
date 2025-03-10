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
                            <li><a href="{{ route('member.dashboard', ['filter' => 'semua']) }}"
                                    class="{{ request('filter') == 'semua' || !request('filter') ? 'active' : '' }}">Semua</a>
                            </li>
                            <li><a href="{{ route('member.dashboard', ['filter' => 'kursus']) }}"
                                    class="{{ request('filter') == 'kursus' ? 'active' : '' }}">Kursus</a></li>
                            <li><a href="{{ route('member.dashboard', ['filter' => 'ebook']) }}"
                                    class="{{ request('filter') == 'ebook' ? 'active' : '' }}">E-Book</a></li>
                        </ul>
                    </div>
                    <div class=" mt-4 courses-scroll">
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border my-4" id="sentinel"role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('components.includes.member.sidebar-dashboard-mobile')
@endsection
@push('addon-script')
    <script src="{{ asset('nemolab/member/js/scroll-dashboard.js') }}"></script>
    <script>
        let loading = false;
        let lastBookId = null;
        let lastCourseId = null;
        let hasMore = true;

        // Mendapatkan elemen grid container
        const gridContainer = document.querySelector('.courses-scroll');
        // Mendapatkan nilai grid-template-columns
        const gridTemplateColumns = window.getComputedStyle(gridContainer).getPropertyValue(
            'grid-template-columns');
        // Menghitung jumlah kolom
        const totalColumns = gridTemplateColumns.split(' ').length;

        function loadMoreContent() {
            if (loading || !hasMore) return;

            loading = true;
            const urlParams = new URLSearchParams(window.location.search);
            const filter = urlParams.get('filter');

            fetch(`${window.location.pathname}?${new URLSearchParams({
                'filter': filter,
                'lastBookId': lastBookId,
                'lastCourseId': lastCourseId,
                'itemsPerRow': totalColumns,
            })}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => response.json()).then(response => {
                const container = document.querySelector('.courses-scroll');
                hasMore = response.hasMore;

                if (Array.isArray(response.data)) {
                    response.data.forEach(item => {
                        const itemHtml = createItemHtml(item);
                        container.insertAdjacentHTML('beforeend', itemHtml);
                    });

                    if (!hasMore && lastCourseId == null && response.data.length < totalColumns) {
                        document.querySelector('.courses-scroll')
                            .style.gridTemplateColumns = 'repeat(auto-fit, minmax(250px, 280px))';
                    }
                } else if (lastCourseId == null) {
                    container.insertAdjacentHTML(
                        'beforeend',
                        `<div class="col-md-12 d-flex justify-content-center align-items-center">
                            <div class="not-found text-center">
                                <img src="{{ asset('nemolab/member/img/search-not-found.png') }}"
                                    class="logo-not-found w-50 h-50" alt="Not Found">
                                <p class="mt-3">Kelas Tidak Tersedia</p>
                            </div>
                        </div>`
                    );
                }

                lastBookId = response.lastBookId;
                lastCourseId = response.lastCourseId;
                document.querySelector('#sentinel').style.display = hasMore ? 'block' : 'none';
                loading = false;
                SetLineClamp()
            }).catch(error => {
                console.error('Error:', error);
                loading = false;
            });
        }

        function createItemHtml(item) {

            return `
                <a href="{{ route('member.course.join', '') }}/${item.slug}" class="card">
                    ${item.cover !=null ? `<img src="{{ url('/') }}/storage/public/images/covers/${item.cover}"" class="card-img-top d-block" alt="...">` : `<img  src="{{ url('/') . asset('nemolab/member/img/NemolabBG.jpg') }}" class="card-img-top d-block" alt="...">` }
                    <div class="card-body">
                        <div class="title-card title-link">
                            <p>${item.category}</p>
                            <h5 class="fw-bold truncate-text" style="max-height:none;">${item.name}</h5>
                        </div>
                        <p class="tipe" style="color: #666666">${item.product_type} ${item.type}</p>
                        <div
                            class="btn-group-harga d-flex justify-content-between align-items-center gap-1 gap-md-0">
                            ${item.type == 'free' ? '' : 
                                `<div class="harga d-block"><p class="p-0 m-0 d-flex d-md-block gap-2 ">Status: <br class="d-md-block"><span style="color: #666666">${item.status}</span></p></div>`
                            }
                            <div class="harga d-block">
                                <p class="p-0 m-0 d-flex d-md-block gap-2">Bergabung: <br class="d-md-block">
                                    <span
                                        style="color: #666666">${formatDate(item.mylist[0].created_at)}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            `
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const locale = navigator.language; // Mendapatkan locale dari perangkat pengguna
            const options = {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
            };
            return date.toLocaleString(locale, options).replace(/ /g, '-').replace(',', '');
        }

        // Intersection Observer untuk infinite scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    loadMoreContent();
                }
            });
        }, {
            threshold: 0.5
        });

        // Mengamati elemen sentinel
        const sentinel = document.querySelector('#sentinel');
        if (sentinel) {
            observer.observe(sentinel);
        }


        function debounce(func, wait) {
            let timeout;
            return function() {
                clearTimeout(timeout);
                timeout = setTimeout(func, wait);
            };
        }

        function SetLineClamp() {
            console.log('SetLineClamp');
            const el = document.querySelectorAll('.title-link')
            const text = document.querySelectorAll('.truncate-text')
            el.forEach(element => {
                text.forEach(textElement => {
                    if (window.innerWidth > 576) {
                        textElement.style.webkitLineClamp = Math.floor((element.clientHeight - 32) / 21.6);
                        textElement.style.maxHeight =
                            21.6 * Math.floor((element.clientHeight - 32) / 21.6) + 'px';
                    } else {
                        textElement.style.webkitLineClamp = '1';
                        textElement.style.maxHeight = '16px';
                    }
                })
            })
        }

        window.addEventListener('resize', debounce(function() {
            SetLineClamp();
        }), 100);


        loadMoreContent();
    </script>
@endpush
