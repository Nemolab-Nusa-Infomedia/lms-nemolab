@extends('components.layouts.member.navback')

@section('title', 'Play Video')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/play.css') }} ">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
@endpush

@section('content')
    <div class="container mb-5" id="content" style="margin-top: 4rem">
        <div class="row mt-4">
            <div class="col-lg-3 col-md-3 col-sm-12 sidebar">
                <div class="card costum-card">
                    <p class="text-center fs-5 text-white fw-bold pt-2 border-bottom">Materi</p>
                    <div class="d-grid gap-2 px-3">
                        @foreach ($chapters as $chapter)
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item mt-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapse-{{ $loop->iteration }}"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                            {{ $chapter->name }}
                                        </button>
                                    </h2>
                                </div>
                                <div id="panelsStayOpen-collapse-{{ $loop->iteration }}"
                                    class="accordion-collapse collapse">
                                    @foreach ($chapter->lessons as $lesson)
                                        <div class="accordion-body" style="background-color: #ffefce">
                                            <a href="{{ route('member.course.play', ['slug' => $slug, 'episode' => $lesson->episode]) }}"
                                                class="btn btn-primary btn-video mx-auto mt-3 d-flex justify-content-between">
                                                <div class="d-flex play">
                                                    <img src="{{ asset('nemolab\member\img\play.png') }}" alt="">
                                                    <p class="ms-2 my-auto opacity-75 lesson-text">{{ $lesson->name }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <iframe width="100%" height="490px" src="{{ $play->video }}" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12"></div>
            <div class="about col-lg-9 col-md-9 col-sm-12 d-flex mt-3">
                <div class="wrapper">
                    <div class="title-deskripsi">
                        <h4>{{ $course->name }}</h4>
                        <p>Materi bagian: {{ $play->name }}</p>
                    </div>
                    <div class="profile-mentor d-flex align-items-center">
                        @if ($user->avatar != 'default.png')
                            <img src="{{ asset('storage/images/avatars/' . $user->avatar) }}" alt=""
                                style="border-radius:100%; width: 50px; height: 50px;">
                        @else
                            <img src="{{ asset('nemolab/admin/img/avatar.png') }}" alt=""
                                style="border-radius:100%; width: 50px; height: 50px;">
                        @endif
                        <p class="m-0 ms-2 fs-5">{{ $user->name }}</p>
                    </div>
                    <div class="resource">
                        <h4 class="fw-bold mt-3">Sumber Daya</h4>
                        <div class="row">
                            @if ($course->resources != 'null')
                                <div class="d-flex course-option download mt-3">
                                    <a href="{{ $course->resources }}" class="btn btn-download d-flex align-item-center">
                                        <img src="{{ asset('nemolab/member/img/download.png') }}" alt=""
                                            style="border-radius:100%;">
                                        <div class="text-download ms-3">
                                            <p class="my-auto text-left" style="width:70%;">Download</p>
                                            <p class="my-auto">Asset Belajar</p>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            <div class="d-flex course-option konsultasi ms-3 mt-3">
                                <a href="{{ $course->link_grub }}" class="btn btn-download d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/konsultasi.png') }}" alt="Consultation Icon"
                                        style="border-radius:100%;">
                                    <p class="ms-3 my-auto text-left" style="padding-right: 25px">Join Grup Diskusi</p>
                                </a>
                            </div>
                            <div class="d-flex course-option konsultasi ms-3 mt-3">
                                <a href="{{ route('member.forum', ['slug' => $course->slug]) }}"
                                    class="btn btn-download d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/konsultasi.png') }}" alt="Consultation Icon"
                                        style="border-radius:100%;">
                                    <p class="ms-3 my-auto text-left" style="padding-right: 25px">Forum Diskusi</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->

        @if ($checkReview == null)
            <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="wrapper-modal">
                                <h3 class="mx-auto">Ulasan dan rating</h3>
                                <form id="reviewForm" action="{{ route('member.review.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <div class="rating">
                                        <input type="number" name="rating" hidden>
                                        <i class='bx bx-star star' style="--i: 0;"></i>
                                        <i class='bx bx-star star' style="--i: 1;"></i>
                                        <i class='bx bx-star star' style="--i: 2;"></i>
                                        <i class='bx bx-star star' style="--i: 3;"></i>
                                        <i class='bx bx-star star' style="--i: 4;"></i>
                                    </div>
                                    <textarea name="note" cols="30" rows="5" placeholder="Message"></textarea>
                                    <div class="btn-group">
                                        <button type="submit" class="btn submit">Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection

@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var reviewModal = new bootstrap.Modal(document.getElementById('reviewModal'));
            setTimeout(function() {
                reviewModal.show();
            }, 10000);
            const allStar = document.querySelectorAll('.rating .star');
            const ratingValue = document.querySelector('.rating input[name="rating"]');
            allStar.forEach((item, idx) => {
                item.addEventListener('click', function() {
                    ratingValue.value = idx + 1;
                    allStar.forEach(i => {
                        i.classList.replace('bxs-star', 'bx-star');
                        i.classList.remove('active');
                    });
                    for (let i = 0; i <= idx; i++) {
                        allStar[i].classList.replace('bx-star', 'bxs-star');
                        allStar[i].classList.add('active');
                    }
                });
            });

            document.getElementById('reviewForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Tampilkan pesan sukses dengan SweetAlert2
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Review Berhasil Di Kirim'
                        });

                        // Tutup modal
                        $('#reviewModal').modal('hide');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Tampilkan pesan error jika ada
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });
                    });
            });
        });
    </script>
@endpush
