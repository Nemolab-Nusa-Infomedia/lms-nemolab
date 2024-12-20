@extends('components.layouts.member.navback')

@section('title', 'Payment')

@push('prepend-style')
<link rel="stylesheet" href="{{ asset('nemolab/member/css/payment.css') }}">
@endpush

@section('content')
    <div class="container d-flex flex-column" id="payment-success" style="margin-top: 10rem">
        <img class="mx-auto justify-content-center align-items-center" src="{{asset('nemolab/member/img/payment-success-orange.png')}}" alt="" width="300px" height="auto">
        <h3 class="text-center mt-5" style="color: #FFDEA6; margin-bottom: 7rem;">Pembayaran Berhasil!</h3>
    </div>
    
@endsection
