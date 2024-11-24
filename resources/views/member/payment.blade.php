@extends('components.layouts.member.dashboard')

@section('title', 'Nemolab - Selesaikan Pemabayaran Anda')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/payment.css') }}">
@endpush

@section('content')
    <section class="payment py-5 mt-5">
        <div class="container">

            <h2 class="text-center mb-3 fw-bold">Silahkan Selesaikan Pembelian Kelas</h2>
            <p class="text-center description">Setelah pembelian kelas sukses, anda dapat mengakses kelas dan mendapatkan
                benefit lainnya seperti grup diskusi dan sertifikat resmi dari kami</p>

            @if (($course && $course->price == 0) || ($ebook && $ebook->price == 0) || ($bundle && $bundle->price == 0))
                <div class="row justify-content-center">
                    <div class="col-md-6 mt-5">
                        <div class="card card-bayar shadow p-4">
                            <div class="d-flex align-items-center mb-3">
                                <a href="{{ route('member.transaction') }}" class="custom-link d-flex align-items-center">
                                    <i class="bi bi-arrow-left me-2"></i>
                                </a>
                            </div>
                            <h2 class="text-rinci mb-4">Rincian Pembayaran</h2>
                            <div class="nota">
                                <div class="produk mb-3">
                                    <p class="mb-1">Produk yang Dibeli</p>
                                    @if ($course)
                                        {{ $course->name }} (Video)
                                    @elseif ($ebook)
                                        {{ $ebook->name }} (eBook)
                                    @elseif ($bundle)
                                        {{ $bundle->course->name }} (Paket Combo)
                                    @endif
                                </div>

                                <div class="harga mb-3">
                                    <div class="d-flex justify-content-between">
                                        @if ($course)
                                            <p class="item mb-1 fw-bold">Harga Kelas</p>
                                        @elseif ($ebook)
                                            <p class="item mb-1 fw-bold">Harga E-Book</p>
                                        @elseif ($bundle)
                                            <p class="item mb-1 fw-bold">Harga Paket</p>
                                        @endif
                                        <p class="price mb-1 fw-bold">Rp. 0</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="item mb-1 fw-bold">PPN (11%)</p>
                                    @if ($course)
                                        <p class="tax mb-1 fw-bold">+ Rp. {{ number_format($course->price * 0.11, 0) }}</p>
                                    @elseif ($ebook)
                                        <p class="tax mb-1 fw-bold">+ Rp. {{ number_format($ebook->price * 0.11, 0) }}</p>
                                    @elseif ($bundle)
                                        <p class="tax mb-1 fw-bold">+ Rp. {{ number_format($bundle->price * 0.11, 0) }}</p>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="item mb-1 fw-bold">Biaya Service Tambahan</p>
                                    <p class="tax mb-1 fw-bold">+ Rp. 0</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="item mb-1 fw-bold">Potongan Kode Promo</p>
                                    <p class="diskon-total mb-1 fw-bold">Tidak Ada</p>
                                </div>

                                <div class="total d-flex justify-content-between align-items-center">
                                    <h6 class="fw-bold fs-4">Total Harga</h6>
                                    <p class="fw-bold fs-4">Rp. 0</p>
                                </div>

                                @php
                                    if ($course) {
                                        $totalPrice = $course->price * 1.11 + 5000;
                                    } elseif ($ebook) {
                                        $totalPrice = $ebook->price * 1.11 + 5000;
                                    } elseif ($bundle) {
                                        $totalPrice = $bundle->price * 1.11 + 5000;
                                    }

                                @endphp

                                <div class="text-center mt-1">
                                    <form id="paymentForm" action="{{ route('member.transaction.store') }}" method="POST">
                                        @csrf
                                        @if ($course)
                                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        @elseif ($ebook)
                                            <input type="hidden" name="ebook_id" value="{{ $ebook->id }}">
                                        @elseif ($bundle)
                                            <input type="hidden" name="bundle_id" value="{{ $bundle->id }}">
                                        @endif
                                        <input type="hidden" name="price" value="{{ $totalPrice }}">
                                        <div class="form-check mt-4">
                                            <input class="form-cek" type="checkbox" id="termsCheck" name="termsCheck">
                                            <label class="form-check-label" for="termsCheck">
                                                Saya menyetujui <a href="#" class="syarat">Syarat & Ketentuan</a>
                                                <p class="text-danger d-none" id="important" style="font-size: 12px;">
                                                    Anda harus menyetujui syarat dan ketentuan sebelum melanjutkan.
                                                </p>
                                            </label>
                                        </div>
                                        <button class="btn btn-primary mt-4" type="submit">Beli Kelas</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Modal Pop Up Redeem -->
                <div class="modal fade" id="myModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Header Modal -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Gunakan Kode Promo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <!-- Body Modal -->
                            <div class="modal-body">
                                <div class="redeem-content">
                                    <div>
                                        @if (!is_null($kelasDiskon) && !$kelasDiskon->isEmpty())
                                            <select class="form-select" id="promo">
                                                @foreach ($kelasDiskon as $diskon)
                                                    <option value="{{ $diskon->rate_diskon }}">
                                                        {{ $diskon->kode_diskon }} - {{ $diskon->rate_diskon }}%
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <p class="text-center my-auto text-body-secondary fw-bold">Promo Belum Tersedia
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Footer Modal -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="btnPromo"
                                    data-bs-dismiss="modal">Gunakan</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row justify-content-center">
                    <div class="col-md-6 mt-5">
                        <div class="card card-bayar shadow p-4">
                            <div class="d-flex align-items-center mb-3">
                                <a href="{{ route('member.transaction') }}" class="custom-link d-flex align-items-center">
                                    <i class="bi bi-arrow-left me-2"></i>
                                </a>
                            </div>
                            <h2 class="text-rinci mb-4">Rincian Pembayaran</h2>

                            <div class="promo d-flex justify-content-between align-items-center mb-3">
                                <p class="mb-0 fw-bold">Gunakan Kode Promo</p>
                                <button type="button" class="btn btn-promo" data-bs-toggle="modal"
                                    data-bs-target="#myModal">
                                    Klaim Promo
                                </button>
                            </div>

                            <div class="nota">
                                <div class="produk mb-3">
                                    <p class="mb-1">Produk yang Dibeli</p>
                                    @if ($course)
                                        {{ $course->name }} (Video)
                                    @elseif ($ebook)
                                        {{ $ebook->name }} (eBook)
                                    @elseif ($bundle)
                                        {{ $bundle->course->name }} (Paket Combo)
                                    @endif
                                </div>

                                <div class="harga mb-3">
                                    <div class="d-flex justify-content-between">
                                        @if ($course)
                                            <p class="item mb-1 fw-bold">Harga Kelas</p>
                                            <p class="tax mb-1 fw-bold">+ Rp. {{ number_format($course->price) }}</p>
                                        @elseif ($ebook)
                                            <p class="item mb-1 fw-bold">Harga E-Book</p>
                                            <p class="tax mb-1 fw-bold">+ Rp. {{ number_format($ebook->price) }}</p>
                                        @elseif ($bundle)
                                            <p class="item mb-1 fw-bold">Harga Paket</p>
                                            <p class="tax mb-1 fw-bold">+ Rp. {{ number_format($bundle->price) }}</p>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="item mb-1 fw-bold">PPN (11%)</p>
                                        @if ($course)
                                            <p class="tax mb-1 fw-bold">+ Rp.
                                                {{ number_format($course->price * 0.11, 0) }}</p>
                                        @elseif ($ebook)
                                            <p class="tax mb-1 fw-bold">+ Rp. {{ number_format($ebook->price * 0.11, 0) }}
                                            </p>
                                        @elseif ($bundle)
                                            <p class="tax mb-1 fw-bold">+ Rp.
                                                {{ number_format($bundle->price * 0.11, 0) }}</p>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="item mb-1 fw-bold">Biaya Service Tambahan</p>
                                        <p class="tax mb-1 fw-bold">+ Rp. 5.000</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="item mb-1 fw-bold">Potongan Kode Promo</p>
                                        <p class="diskon-total mb-1 fw-bold" id="text-potongan-harga">Tidak Ada</p>
                                    </div>
                                </div>

                                @php
                                    if ($course) {
                                        $totalPrice = $course->price * 1.11 + 5000;
                                    } elseif ($ebook) {
                                        $totalPrice = $ebook->price * 1.11 + 5000;
                                    } elseif ($bundle) {
                                        $totalPrice = $bundle->price * 1.11 + 5000;
                                    }
                                @endphp

                                <div class="total d-flex justify-content-between align-items-center">
                                    <h6 class="fw-bold fs-4">Total Harga</h6>
                                    <p class="fw-bold fs-4" id="totalHarga">Rp. {{ number_format($totalPrice, 0) }}</p>
                                </div>

                                <div class="text-center mt-1">
                                    <form id="paymentForm" action="{{ route('member.transaction.store') }}"
                                        method="POST">
                                        @csrf
                                        @if ($course)
                                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        @elseif ($ebook)
                                            <input type="hidden" name="ebook_id" value="{{ $ebook->id }}">
                                        @elseif ($bundle)
                                            <input type="hidden" name="bundle_id" value="{{ $bundle->id }}">
                                        @endif
                                        <input type="hidden" id="diskonInput" name="diskon">
                                        <input type="hidden" name="price" value="{{ $totalPrice }}">
                                        <div class="form-check mt-4 text-center">
                                            <input class="form-cek" type="checkbox" id="termsCheck" name="termsCheck"
                                                required>
                                            <label class="form-check-label ms-2" for="termsCheck">
                                                Saya menyetujui <a href="#" class="syarat">Syarat & Ketentuan</a>
                                                <p class="text-danger d-none" id="important" style="font-size: 12px;">
                                                    Anda harus menyetujui syarat dan ketentuan sebelum melanjutkan.
                                                </p>
                                            </label>
                                        </div>
                                        <button class="btn btn-primary mt-4" type="submit">Beli Kelas</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
@push('addon-script')
    <script src="{{ asset('nemolab/member/js/claim_diskon.js') }}"></script>
@endpush
