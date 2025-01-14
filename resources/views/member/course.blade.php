@extends('components.layouts.member.app')

@section('title', 'Pilih Kursus Yang Ingin Anda Pelajari')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/sidebar-filter.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/course.css') }} ">
@endpush

@section('content')
    <section class="section-pilh-kelas" id="section-pilih-kelas">
        <div class="container-fluid mt-5 pt-5">
            <div class="row">
                <div class="mobile-filter col-12 mb-3 d-lg-none">
                    <div class="filter-menu d-flex align-items-center gap-2">
                        <button class="filter-togle btn btn-warning d-flex justify-content-center align-items-center"
                            style="height: 35px; width: 35px;">
                            <img src="{{ asset('nemolab/components/member/img/filter.png') }}" alt=""
                                style="width: 20px; height: 20px;">
                        </button>
                        <form action="{{ route('member.course') }}" method="GET" class="d-flex flex-grow-1">
                            <div class="search position-relative w-100">
                                <input type="text" name="search-input" class="searchTerm form-control"
                                    placeholder="Cari Kelas Disini" id="search-input" value="{{ request('search-input') }}">
                                <button type="submit" class="searchButton position-absolute">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @include('components.includes.member.sidebar-filter')
                <div class="col-md-9 mb-4" id="course-card" style="min-height: 100vh">
                    <div class="card-container">
                        <div class="courses-scroll" id="row">

                        </div>
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
@endsection
@push('addon-script')
    <script src="{{ asset('nemolab/member/js/scroll-dashboard.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.filter-togle').addEventListener('click', function() {
                const sidebar = document.querySelector('.sidebar');
                const body = document.body;

                sidebar.classList.toggle('show-sidebar');
                body.classList.toggle('no-scroll');
            });

            // Menutup sidebar saat mencapai footer
            window.addEventListener('scroll', function() {
                const sidebar = document.querySelector('.sidebar');
                const footer = document.querySelector('#footer');
                const body = document.body;

                const footerTop = footer.getBoundingClientRect().top;
                const sidebarBottom = sidebar.getBoundingClientRect().bottom;
                if (sidebarBottom >= footerTop) {
                    sidebar.classList.remove('show-sidebar');
                    body.classList.remove('no-scroll');
                }
            });

            document.addEventListener('click', function(event) {
                const sidebar = document.querySelector('.sidebar');
                const toggleButton = document.querySelector('.filter-togle');
                const body = document.body;

                if (sidebar.classList.contains('show-sidebar') &&
                    !sidebar.contains(event.target) &&
                    !toggleButton.contains(event.target)) {
                    sidebar.classList.remove('show-sidebar');
                    body.classList.remove('no-scroll');
                }
            });

        });
    </script>
    <script>
        // Add event listeners for the new filters
        document.addEventListener('DOMContentLoaded', function() {
            // Sort filters
            document.querySelectorAll('input[data-sort]').forEach(element => {
                element.addEventListener('change', function() {
                    currentSort = this.dataset.sort;
                    resetAndReload();
                });
            });

            // Level filters
            document.querySelectorAll('input[data-level]').forEach(element => {
                element.addEventListener('change', function() {
                    currentLevel = this.dataset.level;
                    resetAndReload();
                });
            });

            // Type filters
            document.querySelectorAll('input[data-type]').forEach(element => {
                element.addEventListener('change', function() {
                    currentType = this.dataset.type;
                    resetAndReload();
                });
            });

            // Year filters
            document.querySelectorAll('input[data-year]').forEach(element => {
                element.addEventListener('change', function() {
                    currentYear = this.dataset.year;
                    resetAndReload();
                });
            });
        });
        function resetAndReload() {
            lastBookId = null;
            lastCourseId = null;
            hasMore = true;
            document.querySelector('.courses-scroll').innerHTML = '';
            loadMoreContent();
        }
    </script>
    <script>
        let loading = false;
        let lastBookId = null;
        let lastCourseId = null;
        let hasMore = true;
        let currentSort = 'new';
        let currentLevel = 'all';
        let currentType = 'all';
        let currentYear = new Date().getFullYear();

        // Mendapatkan elemen grid container
        const gridContainer = document.querySelector('.courses-scroll');
        // Mendapatkan nilai grid-template-columns
        const gridTemplateColumns = window.getComputedStyle(gridContainer).getPropertyValue('grid-template-columns');
        // Menghitung jumlah kolom
        const totalColumns = gridTemplateColumns.split(' ').length;

        // Request data dan enambahkan card ke container
        function loadMoreContent() {
            if (loading || !hasMore) return;

            loading = true;
            const urlParams = new URLSearchParams(window.location.search);
            const searchInput = urlParams.get('search-input');
            const categoryFilter = urlParams.get('filter-kelas');
            const paketFilter = urlParams.get('filter-paket');

            fetch(`${window.location.pathname}?${new URLSearchParams({
                'search-input': searchInput,
                'filter-kelas': categoryFilter,
                'filter-paket': paketFilter,
                'lastBookId': lastBookId,
                'lastCourseId': lastCourseId,
                'requestTotal': totalColumns,
                'sort': currentSort,
                'level': currentLevel,
                'type': currentType,
                'year': currentYear
            })}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(response => {
                    const container = document.querySelector('.courses-scroll');
                    hasMore = response.hasMore;
                    console.log(response)
                    // Memeriksa data yang akan ditampilkan
                    if (Array.isArray(response.data)) {
                        response.data.forEach(item => {
                            const itemHtml = createItemHtml(item, response.bundling || {});
                            container.insertAdjacentHTML('beforeend', itemHtml);
                        });
                        // Mengatur ulang nilai grid-template-columns jika data sedikit
                        if (!hasMore && lastCourseId == null && response.data.length < totalColumns) {
                            document.querySelector('.courses-scroll').style.gridTemplateColumns =
                                'repeat(auto-fit, minmax(280px, 300px))';
                        }
                    } else if (lastCourseId == null) {
                        // Menampilkan not found
                        container.insertAdjacentHTML('beforeend', `
                            <div class="d-flex flex-column justify-content-center align-items-center w-100">
                                <img src="{{ asset('nemolab/member/img/search-not-found.png') }}"
                                class="logo-not-found" style="max-width: 50svh" alt="Not Found">
                                <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                            </div>
                        `);
                    }

                    // set data terakhir (checkpoint) untuk server
                    lastBookId = response.lastBookId;
                    lastCourseId = response.lastCourseId;
                    document.querySelector('#sentinel').style.display = hasMore ? 'block' : 'none';
                    loading = false;
                    SetLineClamp();
                })
                .catch(error => {
                    console.error('Error:', error);
                    loading = false;
                });
        }

        // Fungsi untuk membuat HTML item
        function createItemHtml(item, bundling) {
            const currentBundling = bundling[item.id] || null;
            const price = currentBundling ?
                (currentBundling.price == 0 ? 'Gratis' : 'Rp ' + new Intl.NumberFormat('id-ID').format(currentBundling
                    .price)) :
                (item.price == 0 ? 'Gratis' : 'Rp ' + new Intl.NumberFormat('id-ID').format(item.price));

            return `
                <div class="card d-flex flex-column">
                    ${item.cover != null ? `<img src="{{ url('/') }}/storage/images/covers/${item.cover}" class="card-img-top d-block" alt="${item.name}">` : `<img src="{{ url('/') . asset('nemolab/member/img/NemolabBG.jpg') }}" class="card-img-top d-block" alt="${item.name}">`}
                    <div class="card-body p-3">
                        <div class="paket d-flex">
                           <p class="paket-item mt-2">${item.product_type === 'ebook' ? 'E-Book' : currentBundling ? 'Paket Combo' : 'Kursus'}</p>
                        </div>
                        <div class="title-card">
                            <a class="title-link" href="${item.product_type === 'ebook' ? '{{ route('member.ebook.join', '') }}' : '{{ route('member.course.join', '') }}'}/${item.slug}">
                                <p>${item.category}</p>
                                <h5 class="fw-bold truncate-text">${item.name}</h5>
                            </a>
                            <p class="avatar m-0 fw-bold me-1">
                                ${item.users.avatar != null
                                    ? `<img src="{{ url('/') }}/storage/images/avatars/${item.users.avatar}" alt="${item.users.name}" style="width: 24px; height: 24px; border-radius: 50%;">`
                                    : `<img src="/nemolab/member/img/icon/Group 7.png" alt="${item.users.name}" style="width: 24px; height: 24px; border-radius: 50%;">`
                                }
                                ${item.users.name}
                            </p>
                        </div>
                        <div class="btn-group-harga d-flex justify-content-between align-items-center mt-md-3">
                            <div class="harga d--block">
                                <p class="p-0 m-0 fw-semibold">Harga</p>
                                <p class="p-0 m-0 fw-semibold">${price}</p>
                            </div>
                            <a href="${item.product_type === 'ebook' ? '{{ route('member.ebook.join', '') }}' : '{{ route('member.course.join', '') }}'}/${item.slug}" class="btn btn-primary">Mulai Belajar</a>
                        </div>
                    </div>
                </div>
            `;
        }

        // Intersection Observer untuk infinite scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    loadMoreContent();
                }
            });
        }, {
            threshold: 0.1
        });

        // Mengamati elemen sentinel
        const sentinel = document.querySelector('#sentinel');
        if (sentinel) {
            observer.observe(sentinel);
        }

        // Menambahkan event listeners untuk filter
        document.querySelectorAll('.filter-input').forEach(filter => {
            filter.addEventListener('change', () => {
                lastBookId = null;
                hasMore = true;
                document.querySelector('.courses-scroll').innerHTML = '';
                loadMoreContent();
            });
        });

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
                    }
                });
            })
        }

        window.addEventListener('resize', debounce(function() {
            SetLineClamp();

        }), 100);

        loadMoreContent();
    </script>
@endpush
