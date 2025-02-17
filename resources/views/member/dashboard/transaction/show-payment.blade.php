@extends('components.layouts.member.app')

@section('title', 'Selesaikan Pemabayaran Anda')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/payment.css') }}">
@endpush

@section('content')
    <section class="payment py-5"  style="margin-top: 5rem">
        <div class="container">
            <h2 class="text-center mb-3">Riwayat Pemebelian Anda</h2>
            <p class="text-center description">Anda Dapat Melihat Detail Pembelian di Sini</p>
                <div class="row justify-content-center">
                    <div class="col-md-6 mt-1">
                        <div class="card card-bayar shadow p-4">
                            <div class="d-flex align-items-center mb-3">
                                <a href="{{ route('member.transaction') }}" class="custom-link d-flex align-items-center">
                                    <i class="bi bi-arrow-left me-2"></i>
                                </a>
                            </div>
                            <h2 class="text-rinci mb-4">Riwayat Pembelian</h2>
                            <div class="nota">
                                <div class="produk mb-3">
                                    <p class="item mb-1 fw-bold">Kelas yang Dibeli</p>
                                    <p class="fw-bolder">{{ $details->name_item}}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="item mb-1 fw-bold">Harga Produk</p>
                                    <p class="price mb-1 fw-bold">Rp.  {{ number_format($details->harga_awal, 0) }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="item mb-1 fw-bold">PPN </p>
                                    <p class="tax mb-1 fw-bold">({{ $details->harga_awal == 0 ? '0%' : '11%' }})</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="item mb-1 fw-bold">Biaya Service Tambahan</p>
                                    <p class="tax mb-1 fw-bold">+ Rp. {{ $details->harga_awal == 0 ? '0' : '5.000' }}</p>
                                </div>
                                <div class="d-flex justify-content-between mb-5">
                                    <p class="item mb-1 fw-bold">Potongan Kode Promo</p>
                                    <p class="diskon-total mb-1 fw-bold">Rp. {{ $details->promo == 0 ? 'Tidak Ada' : number_format($details->promo, 0) }}</p>
                                </div>

                                <div class="total d-flex justify-content-between align-items-center">
                                    <h6 class="fw-bold fs-4">Total Harga</h6>
                                    <p class="price fw-bold fs-4">Rp. {{ number_format($details->total_harga, 0) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
@endsection
@push('addon-script')
    <script src="{{ asset('nemolab/member/js/claim_diskon.js') }}"></script>
@endpush
