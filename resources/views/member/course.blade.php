@extends('components.layouts.member.app')

@section('title', 'Nemolab - Kursus Online')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/course.css') }} ">
@endpush

@section('content')
    <!-- CONTENT -->
    <section id="course">
        <div class="container-sm ">
            <!-- alert -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menjadi mentor?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn-alert">Yes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container" style="margin-top: 5rem;">
                <div class="row">
                    <div class="dropdown d-flex d-lg-none">
                        <a class="dropdown-toggle text-white rounded-3 fw-medium btn mb-3" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Kategori
                        </a>

                        <ul class="dropdown-menu scroll-sidebar" id="dropdown">
                            @foreach ($sortedCategory as $item)
                                <div class="form-check me-3">
                                    <input class="form-check-input radiofilter-mobile" type="radio"
                                        id="radiofilter-{{ $loop->iteration }}">
                                    <label class="form-check-label ms-2 fw-medium" for="radiofilter-{{ $loop->iteration }}">
                                        {{ $item->name }}
                                    </label>
                                </div>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-3 d-none d-lg-block rounded-3" style="height: 600px; background-color: #faa907;">
                        <div class="card-category d-flex flex-column full-width-border">
                            <p class="text-center mt-4">Kategori</p>
                            <hr class="opacity-100 m-0">
                            <div class="checkbox scroll-sidebar mt-4">
                                @foreach ($sortedCategory as $item)
                                    <div class="form-check">
                                        <input class="form-check-input radiofilter" type="radio"
                                            id="radiofilter-{{ $loop->iteration }}">
                                        <label class="form-check-label ms-2" for="radiofilter-{{ $loop->iteration }}">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="row col-12 col-lg-9 mx-auto d-flex overflow-y-scroll" id="course-container">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <div class="right d-flex">
        <img src="http://127.0.0.1:8000/nemolab/member/img/star.png" style="height: 20px; margin-top: -1px;" alt="">
        <p class="text-black mb-0 ms-1">4,6</p>
    </div> --}}
@endsection
@push('addon-script')
    <script>
        // variabel
        var btnRadio = document.querySelectorAll('.radiofilter');
        var btnRadioMobile = document.querySelectorAll('.radiofilter-mobile');
        var query = "all";

        btnRadioMobile.forEach(btnMobile => {
            if (btnMobile.checked == false) {
                btnRadioMobile[0].checked = true
            }

            btnMobile.addEventListener('click', function() {
                btnRadioMobile.forEach(radioMobile => {
                    radioMobile.checked = false;
                })

                this.checked = true;

                // ubah value query
                query = query = document.querySelector(`label[for="${this.id}"]`)
                    .textContent;
                getDataCourse();
            })
        });

        // check radio aktif
        btnRadio.forEach(btn => {
            if (btn.checked == false) {
                btnRadio[0].checked = true
            }
            btn.addEventListener('click', function() {
                btnRadio.forEach(radio => {
                    radio.checked = false;
                })
                this.checked = true;

                // ubah value query
                query = query = document.querySelector(`label[for="${this.id}"]`).textContent;
                getDataCourse();
            })
        });


        getDataCourse();

        function getDataCourse() {
            fetch('http://127.0.0.1:8000/api/v1/course/category?q=' + query)
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
                        courseElement.innerHTML = `Maaf Kursus Belum Tersedia`
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
@endpush
