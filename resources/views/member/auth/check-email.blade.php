@extends('components.layouts.member.auth')

@section('title', 'Cek Email Anda')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/auth.css') }} ">
@endpush

@section('content')
<form class="card" action="{{ route('member.login')}}"> 
    <div class="card-title">
        <h1 class="mb">Cek Email Anda</h1>
        <p>Kami telah mengirimkan sebuah tautan ke email Anda. Silahkan klik tautan tersebut, yang akan mengarahkan Anda ke halaman ganti sandi</p>
    </div>
    <div class="card-foot">
        <button type="submit">Kembali</button>
    </div>
</form>
@endsection