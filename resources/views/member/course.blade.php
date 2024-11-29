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
                    <button class="filter-togle btn btn-warning d-flex justify-content-center align-items-center" style="height: 35px; width: 35px;">
                        <img src="{{ asset('nemolab/components/member/img/filter.png') }}" alt="" style="width: 20px; height: 20px;">
                    </button>                    
                    <form action="{{ route('member.course') }}" method="GET" class="d-flex flex-grow-1">
                        <div class="search position-relative w-100">
                            <input type="text" name="search-input" class="searchTerm form-control" 
                                placeholder="Cari Kelas Disini" id="search-input" 
                                value="{{ request('search-input') }}">
                            <button type="submit" class="searchButton position-absolute">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @include('components.includes.member.sidebar-filter')
            <div class="col-md-9" id="course-card" style="min-height: 100vh">
                <div class="card-container">
                    <div class="row" id="row">
                        @if($data->isEmpty() && $data->isEmpty())
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                </div>
                            </div>
                        @elseif ($paketFilter == 'paket-kursus')
                            @if ($data->isEmpty())
                                <div class="col-md-12 d-flex justify-content-center align-items-center">
                                    <div class="not-found text-center">
                                        <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                        <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                    </div>
                                </div>
                            @endif
                            @foreach($data as $course)
                                @include('components.includes.member.partials.course-card', ['course' => $course, 'bundling' => $bundling])
                            @endforeach
                        @elseif ($paketFilter == 'paket-ebook')
                            @if ($data->isEmpty())
                                <div class="col-md-12 d-flex justify-content-center align-items-center">
                                    <div class="not-found text-center">
                                        <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                        <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                    </div>
                                </div>
                            @endif
                            @foreach($data as $ebook)
                                @include('components.includes.member.partials.ebook-card', ['ebook' => $ebook])
                                <!-- Menyertakan file Blade 'ebook-card' yang ada di dalam direktori 'components/includes/member/partials'. 
                                Parameter yang diberikan ke view ini adalah:
                                - 'ebook' yang berisi data tentang kursus (setiap $ebook yang di-loop)
                                - 'bundling' yang berisi data terkait bundling yang bisa digunakan di dalam 'ebook-card' -->
                            @endforeach
                        @elseif ($paketFilter == 'paket-bundling')
                            @if ($data->isEmpty())
                                <div class="col-md-12 d-flex justify-content-center align-items-center">
                                    <div class="not-found text-center">
                                        <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                        <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                    </div>
                                </div>
                            @endif
                            @foreach($data as $course) 
                            <!-- Looping melalui setiap elemen dalam array atau koleksi $data, di mana setiap elemen disimpan dalam variabel $course -->
                                @include('components.includes.member.partials.course-card', ['course' => $course, 'bundling' => $bundling]) 
                                <!-- Menyertakan file Blade 'course-card' yang ada di dalam direktori 'components/includes/member/partials'. 
                                    Parameter yang diberikan ke view ini adalah:
                                    - 'course' yang berisi data tentang kursus (setiap $course yang di-loop)
                                    - 'bundling' yang berisi data terkait bundling yang bisa digunakan di dalam 'course-card' -->
                            @endforeach 
                        @else
                            @if($data->isEmpty())
                                <div class="col-md-12 d-flex justify-content-center align-items-center">
                                    <div class="not-found text-center">
                                        <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                        <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                    </div>
                                </div>
                            @else
                                {{-- Periksa apakah ada data course --}}
                                @if($data->where('product_type', 'video')->isNotEmpty())
                                    @foreach($data->where('product_type', 'video') as $course)
                                        @include('components.includes.member.partials.course-card', ['course' => $course, 'bundling' => $bundling])
                                    @endforeach
                                @endif
                                {{-- Periksa apakah ada data ebook --}}
                                @if($data->where('product_type', 'ebook')->isNotEmpty())
                                    @foreach($data->where('product_type', 'ebook') as $ebook)
                                        @include('components.includes.member.partials.ebook-card', ['ebook' => $ebook])
                                    @endforeach
                                @endif
                            @endif
                        @endif                    
                    </div>                
                        {{-- <h1>{{ $data->count() }}</h1> --}}
                </div>
            </div>
            <div class="my-2">
                <ul class="pagination justify-content-center justify-content-md-end">
                    <li class="page-item-button fw-bold {{ $data->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $data->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @php
                        $start = max($data->currentPage() - 2, 1); 
                        $end = min($start + 5, $data->lastPage());
                    @endphp
                    @for ($i = $start; $i <= $end; $i++)
                        <li class="page-item fw-bold {{ $i == $data->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item-button fw-bold {{ $data->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $data->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>   
            </div>                     
        </div>
    </div>
</section>
@endsection
@push('addon-script')
<script src="{{ asset('nemolab/member/js/scroll-dashboard.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.filter-togle').addEventListener('click', function () {
        const sidebar = document.querySelector('.sidebar');
        const body = document.body;

        sidebar.classList.toggle('show-sidebar');
        body.classList.toggle('no-scroll');
    });

    // Menutup sidebar saat mencapai footer
    window.addEventListener('scroll', function () {
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

    document.addEventListener('click', function (event) {
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

<<<<<<< HEAD
                // ubah value query
                query = query = document.querySelector(`label[for="${this.id}"]`).textContent;
                getDataCourse();
            })
        });


        getDataCourse();

        function getDataCourse() {
            fetch('https://nemolab.id/api/v1/course/category?q=' + query)
                .then(response => response.json())
                .then(data => {
                    const courses = data.data;
                    const courseContainer = document.getElementById('course-container');

                    // Menghapus semua elemen anak dari courseContainer
                    courseContainer.innerHTML = '';

                    if (courses.message != "notfound") {
                        courses.forEach(courseData => {
                            courseData.course.forEach(course => {
                                const courseElement = document.createElement('div');
                                courseElement.className =
                                    'col-12 col-md-4 col-lg-4 card-parent';
                                    courseElement.innerHTML = `
    <a href="#" data-slug-course="${course.slug_course}" onclick="setCourseUrl(this)" style="text-decoration: none;">
        <div class="card-course d-flex d-md-block mt-3 mt-md-1 position-relative">
            <img src="${courseData.avatars_mentor}" alt="${courseData.name_mentor}" class="card-img-profile d-md-none position-absolute" style="border-radius: 100%;">
            <div>
                <img src="${course.cover_course}" class="img-card" alt="${course.title_course}">
            </div>
            <div class="container-card px-3">
                <p class="produck-title text-black fw-medium mb-0 mb-md-2 mt-2 mt-md-0">${course.category_course}: ${course.title_course}</p>
                <div class="profile-card d-none d-md-flex align-items-center">
                    <img src="${courseData.avatars_mentor}" alt="${courseData.name_mentor}" class="card-img-profile" style="border-radius: 100%;">
                    <p class="profile-mentor text-black m-0 ms-2 fw-medium">${courseData.name_mentor}</p>
                </div>
                <div class="price mt-1 mb-2 my-md-2">
                    <p class="text-black mb-0 fw-light">Rp. ${course.price_course}</p>
                </div>
                <div class="status d-flex">
                    <div class="d-inline-flex">
                        <p>Video</p>
                    </div>
                </div>
            </div>
        </div>
    </a>
`;

                                courseContainer.appendChild(courseElement);
                            });
                        });
                    } else {
                        const courseElement = document.createElement('div');
                        courseElement.className =
                            'col-12 d-flex justify-content-center align-items-center fw-medium';
                        courseElement.innerHTML = `Maaf Course Belum Tersedia`
                        courseContainer.appendChild(courseElement);
                    }

                })
                .catch(error => console.error('Error fetching courses:', error));
        };

        function setCourseUrl(element) {
            var slugCourse = element.getAttribute('data-slug-course');
            var url = "{{ route('member.course.join', ':slug_course') }}";
            url = url.replace(':slug_course', slugCourse);
            window.location.href = url;
        };
    </script>
=======
>>>>>>> dev
@endpush
