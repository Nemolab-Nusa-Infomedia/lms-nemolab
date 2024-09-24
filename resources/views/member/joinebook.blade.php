@extends('components.layouts.member.navback')

@section('title', 'Tentang Buku')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/joincourse.css') }} ">
@endpush

@section('content')
    <!-- Content -->
    <div class="container" style="margin-top: 5rem">
        {{-- Header --}}
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3 p-lg-0 pe-lg-2">
              <div>
                <img src="{{ asset('nemolab/member/img/cover_image_6.jpg') }}" alt="" width="100%" class="cover rounded-4 shadow-sm" style="height: 27rem; object-fit: cover" />
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-9 ps-md-4 mt-4 mt-lg-0">
              <div>
                <h3 class="fw-semibold">{{ $ebook->name }}</h3>
                <p class="fw-light mt-4" style="font-size: 15px">Adventure</p>
                <hr />
                <p class="m-0 fw-semibold text-warning">{{ $ebook->type }}</p>
                <hr />
                <div class="d-flex flex-md-row flex-column" style="font-size: 15px">
                    <div class="d-flex align-items-center">
                    <img src="{{ asset('nemolab/member/img/global.png') }}" alt="" width="18" height="18" class="m-0" />
                    <p class="m-0 ms-2 fw-light" style="font-size: 14px">Release Date: {{ $ebook->created_at->format('d F Y') }}</p>
                    </div>
                    <div class="rating d-flex ms-1 my-2 my-0 align-items-center">
                    <p class="m-0 ms-0 ms-md-5 me-2 fw-medium" style="font-size: 14px">4.9</p>
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
                    </div>
                </div>
                <a href="{{ route('member.ebook.read', ['slug' => $ebook->slug]) }}"><button class="btn px-5 py-2 mt-5 text-white fw-semibold rounded-3 text-decoration-none">Beli Buku</button></a>
                <!-- <button class="btn proses px-5 py-2 mt-5 text-white fw-semibold rounded-3">Pembayaran sedang diproses</button> -->
              </div>
            </div>
        </div>

        <!-- About & Daftar isi-->
        <div class="row my-5">
            <div class="col-12 col-lg-12 pe-lg-4">
            <h4 class="fw-semibold">About</h4>
            <p class="mt-4" style="font-size: 14px; text-align: justify">
                {{ $ebook->description }}
            </p>
            </div>
        </div>

        <!-- Tools -->
        {{-- <div class="row">
            <div class="col-12">
            <h4 class="fw-semibold mb-4">Tools</h4>
            </div>
            <div class="col-lg-3 col-md-6 my-2 my-sm-2">
            <div class="tools p-4 border border-2 rounded-4 shadow-sm">
                <div class="d-flex align-items-center d-md-block">
                <div class="col-6 text-center text-md-start">
                    <img src="img/xd.png" alt="" width="70" />
                </div>
                <div class="col-6 col-md-12">
                    <p class="fw-semibold mt-0 mt-md-4">
                    Adobe XD <br />
                    Software Gratis
                    </p>
                    <button class="btn rounded-5 mt-md-4 px-3 py-2 text-white fw-semibold btn-text">Download Now</button>
                </div>
                </div>
            </div>
            </div>

            <div class="col-lg-3 col-md-6 my-2 my-sm-2">
            <div class="tools p-4 border border-2 rounded-4 shadow-sm">
                <div class="d-flex align-items-center d-md-block">
                <div class="col-6 text-center text-md-start">
                    <img src="img/adobe.png" alt="" width="70" />
                </div>
                <div class="col-6 col-md-12">
                    <p class="fw-semibold mt-0 mt-md-4">
                    Adobe Premier <br />
                    Software Gratis
                    </p>
                    <button class="btn rounded-5 mt-md-4 px-3 py-2 text-white fw-semibold btn-text">Download Now</button>
                </div>
                </div>
            </div>
            </div>
        </div> --}}

        <!-- Payment -->
        {{-- <div class="row">
            <div class="col-12">
                <h4 class="fw-semibold">Payment</h4>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="border border-2 rounded-4 p-4 mt-4 shadow-sm">
                    <img src="{{ asset('nemolab/member/img/payment-img.png') }}" alt="" width="70" />
                    <p class="mt-4 fw-light mb-1" style="font-size: 15px">Video</p>
                    <h5 class="fw-semibold">Rp 300,000</h5>
                    <p>Raih Akses Premium Seumur Hidup dan Bangun Proyek Nyata Anda Sendiri</p>
                    <hr class="mb-4 border-2" />
                    <div>
                    <div class="profit">
                        <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25" height="25" />
                        <p>Akses Eksklusif Seumur Hidup</p>
                    </div>
                    <div class="profit">
                        <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25" height="25" />
                        <p>Raih Premium Istimewa</p>
                    </div>
                    <div class="profit">
                        <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25" height="25" />
                        <p>Konsultasi Karier Pribadi</p>
                    </div>
                    <div class="profit">
                        <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25" height="25" />
                        <p>Sertifikat Kelulusan Prestisius</p>
                    </div>
                    <div class="profit">
                        <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25" height="25" />
                        <p>Kesempatan Karier Bergengsi</p>
                    </div>
                    </div>
                    <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Beli Kelas</button>
                </div>
            </div>
        </div> --}}

        <!-- Ulasan -->
        <div class="row my-5">
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
