@extends('components.layouts.member.navback')

@section('title', 'Join Kelas')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/joincourse.css') }} ">
@endpush

@section('content')
    <!-- Header -->
    <div class="container mb-4" style="margin-top: 4rem">
        <div class="row">
            <div class="col-12 text-center justify-content-center">
                <h4 class="fw-semibold">Nama eBook</h4>
                <div class="d-flex align-items-center justify-content-center flex-md-row flex-column" style="margin-top: -6px; font-size: 15px">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('nemolab/member/img/global.png') }}" alt="" width="18" height="18" class="m-0" />
                        <p class="m-0 ms-2 fw-light" style="font-size: 14px">Tanggal Rilis: 01 January 2024</p>
                    </div>
                    <div class="rating d-flex ms-1 my-1 my-0 align-items-center">
                        <p class="m-0 ms-0 ms-md-5 me-2 fw-medium" style="font-size: 14px">4.9</p>
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 p-lg-0 pe-lg-2">
                <img src="{{ asset('nemolab/member/img/cover_image_6.jpg') }}" alt="" height="100%" width="40%" class="rounded-4" style="margin-left:30%; max-height: 25rem; object-fit: fill" />
            </div>
            <div class="col-lg-4 mx-auto col-11 p-4 mt-4 mt-lg-0 border border-2 rounded-4 position-relative overflow-hidden shadow-sm" style="height: 25rem">
                <p class="fw-bold">Daftar Isi</p>
                <div class="playlist">
                    <div class="play">
                        <div class="title d-flex">
                            <img src="{{ asset('nemolab/member/img/play.png') }}" alt="" width="25" height="25" />
                            <p class="ms-3 m-0">Bab 1 Mengenal Laravel</p>
                        </div>
                    </div>
                    <div class="play">
                        <div class="title d-flex">
                            <img src="{{ asset('nemolab/member/img/play.png') }}" alt="" width="25" height="25" />
                            <p class="ms-3 m-0">Bab 2 Mengenal MVC</p>
                        </div>
                    </div>
                    <!-- Add more chapters as needed -->
                </div>
                <a href="{{ url('/start-learning') }}">
                    <div class="button">Mulai Belajar</div>
                </a>
            </div>
        </div>

        <!-- About -->
        <div class="row my-5">
            <div class="col-12">
                <h4 class="fw-semibold">Tentang</h4>
                <p class="mt-4" style="font-size: 14px">
                    Ini adalah deskripsi kursus. Ini memberikan gambaran umum tentang apa yang diperlukan dalam kursus dan apa yang dapat diharapkan oleh peserta.
                </p>
            </div>
            <div class="col-12 mt-4">
                <h4 class="fw-semibold">eBook</h4>
                <p class="mt-4" style="font-size: 14px">
                    EBook adalah buku elektronik yang memungkinkan Anda membaca dan belajar kapan saja dan di mana saja melalui perangkat digital Anda. Ini menawarkan cara praktis baru untuk mengakses informasi dan konten pendidikan.
                </p>
                <a href="#"><button class="btn px-4 py-2 fw-medium text-white">Mulai Belajar</button></a>
            </div>
        </div>

        <!-- Payment -->
        <div class="row my-5">
            <div class="col-12">
                <h4 class="fw-semibold">Pembayaran</h4>
            </div>
            <div class="d-flex justify-content-md-between w-100" style="flex-wrap: wrap">
                <div class="col-custom col-md-6 col-12 rounded-4 p-4 ms-lg-2 mt-4">
                    <img src="{{ asset('nemolab/member/img/payment-img.png') }}" alt="" width="70" />
                    <p class="mt-4 fw-light mb-1" style="font-size: 15px">eBook</p>
                    <h5 class="fw-semibold">Rp 100,000</h5>
                    <p>Dapatkan Akses Premium Seumur Hidup dan Bangun Proyek Nyata Anda Sendiri.</p>
                    <hr class="mb-4 border-2" />
                    <a href="{{ url('/buy-class') }}" class="text-decoration-none">
                        <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Beli Kelas</button>
                    </a>
                </div>
            </div>
        </div>

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
        </div>
    </div>
@endsection
