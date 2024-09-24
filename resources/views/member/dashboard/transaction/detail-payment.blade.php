@extends('components.layouts.member.navback')

@section('title', 'Payment')

@push('prepend-style')
    <link rel="stylesheet" href="{{asset('nemolab/member/css/dashboard/detail-payment.css')}}">
@endpush

@section('content')
    <div class="container" style="margin-top: 5rem">
        <div class="payment d-flex flex-column mx-auto align-items-center justify-content-center">
            <img src="{{asset('nemolab/member/img/Success-Icon.png')}}" alt="" width="60" height="60">
            <img class="d-none" src="{{asset('nemolab/member/img/Failed-Icons.png')}}" alt="" width="60" height="60">
            <p class="mt-3 mb-0" style="color: #474747">Pembayaran Berhasil!</p>
            <h4 class="mt-2">IDR 1,000,000</h4>
        </div>
        
        <div class="payment-detail mt-4 d-flex flex-column mx-auto">
            <h6 class="mb-3">Payment Details</h6>
            <div class="d-flex justify-content-between">
                <p class="gray-text">Ref Number</p>
                <p class="fw-semibold" style="font-size: 14px">000085752257</p>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="gray-text mb-0">Payment Status</p>
                <div class="success d-flex align-items-center">
                    <img src="{{asset('nemolab/member/img/Success-circle.png')}}" alt="" width="20" height="20">
                    <p class="ms-1 mb-0" style="color: #22C58B; font-size: 14px;">Success</p>
                </div>
                <div class="d-none failed d-flex align-items-center">
                    <img src="{{asset('nemolab/member/img/Failed-circle.png')}}" alt="" width="20" height="20">
                    <p class="ms-1 mb-0" style="color: #FF0000; font-size: 14px;">Failed</p>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <p class="gray-text">Payment Time</p>
                <p class="fw-semibold" style="font-size: 14px">25-02-2023, 13:22:16</p>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <p class="gray-text">Total Payment</p>
                <p class="fw-semibold" style="font-size: 14px">IDR 1,000,000</p>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button class="btn btn-payment">
                {{-- SUCCESS --}}
                Klik untuk melanjutkan
                {{-- FAILED --}}
                {{-- Back To Homepage --}}
            </button>
        </div>        
    </div>

@endsection
