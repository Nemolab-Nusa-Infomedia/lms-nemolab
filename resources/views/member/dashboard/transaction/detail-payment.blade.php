@extends('components.layouts.member.navback')

@section('title', 'Payment')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/dashboard/detail-payment.css') }}">
@endpush

@section('content')
    <div class="container" style="margin-top: 5rem">
        <div class="payment d-flex flex-column mx-auto align-items-center justify-content-center">
            @if ($transaction->status == 'success')
                <img src="{{ asset('nemolab/member/img/Success-Icon.png') }}" alt="" width="60" height="60">
                <p class="mt-3 mb-0" style="color: #474747">Pembayaran Berhasil!</p>
            @else
                <img src="{{ asset('nemolab/member/img/Failed-Icons.png') }}" alt="" width="60" height="60">
                <p class="mt-3 mb-0" style="color: #474747">Pembayaran Gagal!</p>
            @endif
            <h4 class="mt-2">IDR {{ $transaction->price == 0 ? '0' : number_format(($transaction->price - 5000) / 1.11) }}
            </h4>
        </div>

        <div class="payment-detail mt-4 d-flex flex-column mx-auto">
            <h6 class="mb-3">Payment Details</h6>
            <div class="d-flex justify-content-between">
                <p class="gray-text">Transaction Code</p>
                <p class="fw-semibold" style="font-size: 14px">{{ $transaction->transaction_code }}</p>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="gray-text mb-0">Payment Status</p>
                <div class="success d-flex align-items-center">
                    @if ($transaction->status == 'success')
                        <img src="{{ asset('nemolab/member/img/Success-circle.png') }}" alt="" width="20"
                            height="20">
                        <p class="ms-1 mb-0" style="color: #22C58B; font-size: 14px;">{{ $transaction->status }}</p>
                    @else
                        <img src="{{ asset('nemolab/member/img/Failed-circle.png') }}" alt="" width="20"
                            height="20">
                        <p class="ms-1 mb-0" style="color: #FF0000; font-size: 14px;">Failed</p>
                    @endif
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <p class="gray-text">PPN</p>
                <p class="fw-semibold" style="font-size: 14px">{{ $transaction->price == 0 ? '0%' : '11%' }}</p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="gray-text">Services Fee Per Students</p>
                <p class="fw-semibold" style="font-size: 14px">IDR {{ $transaction->price == 0 ? '0' : '5,000' }}</p>
            </div>

            <div class="d-flex justify-content-between">
                <p class="gray-text">Payment Time</p>
                <p class="fw-semibold" style="font-size: 14px">{{ $transaction->created_at->format('d-m-Y') }}</p>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <p class="gray-text">Total Payment</p>
                <p class="fw-semibold" style="font-size: 14px">IDR {{ number_format($transaction->price) }}</p>
            </div>
        </div>

        {{-- <div class="d-flex justify-content-center mt-4">
            <button class="btn btn-payment">
                Download Detail Transaction
            </button>
        </div> --}}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menghapus parameter query dari URL
            if (window.location.search.length > 0) {
                const newUrl = window.location.origin + window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }

            const transactionUrl = "{{ route('member.transaction') }}"; // Menggunakan Blade syntax
            document.getElementById('backLink').onclick = function() {
                window.location.href = transactionUrl; // Mengalihkan ke URL transaksi
            };
        });
    </script>

@endsection
