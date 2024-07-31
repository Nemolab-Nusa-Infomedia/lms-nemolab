@extends('components.layouts.member.gabungkelasbase')

@section('title, nemolab')

@section('content-gabungkelas')
        <!-- Header -->
        <div class="container mb-4" style="margin-top: 7rem">
            <div class="row">
              <div class="col-12 text-center justify-content-center">
                <h4 class="fw-semibold">Belajar Livewire Menengah: Membuat Aplikasi Manajemen<br />Karyawan Sederhana</h4>
                <p class="fw-light mt-3" style="font-size: 15px">Learn how to design Management from scratch</p>
                <div class="d-flex align-items-center justify-content-center" style="margin-top: -6px; font-size: 15px">
                  <img src="{{asset('nemolab/assets/image/global.png')}}" alt="" width="18" height="18" />
                  <p class="m-0 ms-2 fw-light" style="font-size: 14px">Release date June 2022</p>
                  <p class="m-0 ms-5 fw-medium" style="font-size: 14px">4.9</p>
                  <div class="ms-1 mb-1">
                    <img src="{{asset('nemolab/assets/image/star.png')}}" alt="" width="19" />
                    <img src="{{asset('nemolab/assets/image/star.png')}}" alt="" width="19" />
                    <img src="{{asset('nemolab/assets/image/star.png')}}" alt="" width="19" />
                    <img src="{{asset('nemolab/assets/image/star.png')}}" alt="" width="19" />
                    <img src="{{asset('nemolab/assets/image/star.png')}}" alt="" width="19" />
                  </div>
                </div>
              </div>
            </div>
          </div>
      
          <!-- Content -->
          <div class="container">
            <div class="row">
              <div class="col-lg-8 col-md-12 p-lg-0 pe-lg-2">
                <img src="{{asset('nemolab/assets/image/Design Grafis.png')}}" alt="" width="100%" class="rounded-4" style="max-height: 25rem; object-fit: cover" />
              </div>
              <div class="col-lg-4 mx-auto col-11 p-4 mt-4 mt-lg-0 border border-2 rounded-4 position-relative overflow-hidden shadow-sm" style="height: 25rem">
                <p class="fw-bold">11 lesson (90 mins)</p>
                <div class="playlist">
                  <div class="play">
                    <div class="title d-flex">
                      <a href="#"><img src="{{asset('nemolab/assets/image/play.png')}}" alt="" width="25" height="25" /></a>
                      <p class="ms-3 m-0">Trailer</p>
                    </div>
                    <div class="mins">
                      <p class="m-0 pe-2 text-end">2 mins</p>
                    </div>
                  </div>
                  <div class="play">
                    <div class="title d-flex">
                      <a href="#"><img src="{{asset('nemolab/assets/image/play.png')}}" alt="" width="25" height="25" /></a>
                      <p class="judul ms-3 m-0">Menganalisa Management</p>
                    </div>
                    <div class="mins">
                      <p class="m-0 pe-2 text-end">12 mins</p>
                    </div>
                  </div>
                  <div class="play">
                    <div class="title d-flex">
                      <a href="#"><img src="{{asset('nemolab/assets/image/play.png')}}" alt="" width="25" height="25" /></a>
                      <p class="judul ms-3 m-0">Mempelajari Management</p>
                    </div>
                    <div class="mins">
                      <p class="m-0 pe-2 text-end">24 mins</p>
                    </div>
                  </div>
                  <div class="play">
                    <div class="title d-flex">
                      <a href="#"><img src="{{asset('nemolab/assets/image/play.png')}}" alt="" width="25" height="25" /></a>
                      <p class="judul ms-3 m-0">Penutup</p>
                    </div>
                    <div class="mins">
                      <p class="m-0 pe-2 text-end">3 mins</p>
                    </div>
                  </div>
                </div>
                <a href="#"><div class="button">Start Learning</div></a>
              </div>
            </div>
            <!-- About -->
            <div class="row my-5">
              <div class="col-12">
                <h4 class="fw-semibold">About</h4>
                <p class="mt-4" style="font-size: 14px">
                  Untuk bekerja di bidang kreatif, salah satu hal terpenting yang dibutuhkan adalah portofolio yang menjual. Portofolio adalah kumpulan karya terbaik yang mencerminkan style atau personality seorang designer. Demi menarik hati
                  klien/rekruter, Anda harus dapat mempresentasikan pekerjaan Anda dalam sebuah portofolio secara sederhana dan mudah dicerna namun dapat menunjukkan jati diri Anda dalam berkarya. <br />Pada case study, kita akan membangun sebuah
                  portofolio dengan design asset Dompet Crypto dari Pixel Buildwith Angga. Design asset ini sangat efisien untuk membuat portofolio karena sudah siap digunakan. Mentor akan menunjukan proses kreatifnya dimulai dari memahami tujuan
                  pembuatan portofolio, memilih isi konten, hingga pengaturan konten ke dalam design asset. Dan portofolio yang berhasil dibuat akan diunggah ke platform design terpopuler sebagai portofolio digital, sehingga bisa dilihat oleh
                  prospect client di seluruh dunia. <br />
                  Kelas ini cocok bagi Anda yang ingin membuat portofolio yang berkualitas. Mentor kami siap membantumu di grup konsultasi, dan jangan lupa tunjukkan karyamu, ya! Go register now and see you in class!
                </p>
              </div>
            </div>
            <!-- Tools -->
            <div class="row">
              <div class="col-12">
                <h4 class="fw-semibold mb-4">Tools</h4>
              </div>
              <div class="col-lg-3 col-md-6 my-2 my-sm-2">
                <div class="tools p-4 border border-2 rounded-4 shadow-sm">
                  <div class="d-flex align-items-center d-md-block">
                    <div class="col-6 text-center text-md-start">
                      <img src="{{asset('nemolab/assets/image/xd.png')}}" alt="" width="70" />
                    </div>
                    <div class="col-6 col-md-12">
                      <p class="fw-semibold mt-4">
                        Adobe XD <br />
                        Software Gratis
                      </p>
                      <button class="btn rounded-5 mt-md-4 px-3 py-2 text-white fw-semibold">Download Now</button>
                    </div>
                  </div>
                </div>
              </div>
      
              <div class="col-lg-3 col-md-6 my-2 my-sm-2">
                <div class="tools p-4 border border-2 rounded-4 shadow-sm">
                  <div class="d-flex align-items-center d-md-block">
                    <div class="col-6 text-center text-md-start">
                      <img src="{{asset('nemolab/assets/image/adobe.png')}}" alt="" width="70" />
                    </div>
                    <div class="col-6 col-md-12">
                      <p class="fw-semibold mt-4">
                        Adobe Premier <br />
                        Software Gratis
                      </p>
                      <button class="btn rounded-5 mt-md-4 px-3 py-2 text-white fw-semibold">Download Now</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Payment -->
            <div class="row my-5">
              <div class="col-12">
                <h4 class="fw-semibold">Payment</h4>
              </div>
              <div class="col-lg-4 col-md-6 border border-2 rounded-4 p-4 ms-lg-2 mt-4 shadow-sm">
                <img src="{{asset('nemolab/assets/image/payment-img.png')}}" alt="" width="70" />
                <h5 class="mt-4 fw-semibold">Rp 300,000</h5>
                <p>Raih Akses Premium Seumur Hidup dan Bangun Proyek Nyata Anda Sendiri</p>
                <hr class="mb-4 border-2" />
                <div>
                  <div class="profit">
                    <img src="{{asset('nemolab/assets/image/check.png')}}" alt="" width="25" height="25" />
                    <p>Akses Eksklusif Seumur Hidup</p>
                  </div>
                  <div class="profit">
                    <img src="{{asset('nemolab/assets/image/check.png')}}" alt="" width="25" height="25" />
                    <p>Raih Premium Istimewa</p>
                  </div>
                  <div class="profit">
                    <img src="{{asset('nemolab/assets/image/check.png')}}" alt="" width="25" height="25" />
                    <p>Konsultasi Karier Pribadi</p>
                  </div>
                  <div class="profit">
                    <img src="{{asset('nemolab/assets/image/check.png')}}" alt="" width="25" height="25" />
                    <p>Sertifikat Kelulusan Prestisius</p>
                  </div>
                  <div class="profit">
                    <img src="{{asset('nemolab/assets/image/check.png')}}" alt="" width="25" height="25" />
                    <p>Kesempatan Karier Bergengsi</p>
                  </div>
                </div>
                <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Beli Kelas</button>
              </div>
            </div>
          </div>
@endsection