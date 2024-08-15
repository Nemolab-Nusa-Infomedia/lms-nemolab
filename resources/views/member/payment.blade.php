@extends('components.layouts.member.navback')

@section('title', 'Payment')

@section('content')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/payment.css') }}">
     <!-- Payment Section -->
     <div class="mt-5">
        <div class="text-center mb-4">
            <h2 class="cek">Paket Checkout Plus</h2>
            <p class="desk">Gabung Starter Plus dan bangun proyek nyata bersama ahli.</p>
        </div>
        <div class="payment-card mx-auto">
            <div class="card-body d-flex flex-column">
                <div class="card-header bg-white">
                    Opsi Pembayaran
                </div>
                <h6 class="card-title mt-5">Payment details</h6>
                <p class="d-flex justify-content-between mt-3">
                    <span>Harga kelas</span>
                    <span>Rp {{ number_format($course->price, 0) }}</span>
                </p>
                <p class="d-flex justify-content-between mt-3">
                    <span>Kode unik</span>
                    <span class="price-update">- Rp 0</span>
                </p>
                <p class="d-flex justify-content-between mt-3">
                    <span>PPN 11%</span>
                    <span class="price-update">+ Rp 0</span>
                </p>
                <p class="d-flex justify-content-between mt-3">
                    <span>Service fee per student</span>
                    <span class="price-update">+ Rp 0</span>
                </p>
                <p class="d-flex justify-content-between total mt-3">
                    <span>Total</span>
                    <span class="total-price">Rp {{ number_format($course->price) }}</span>
                </p>
                <form id="paymentForm" action="{{ route('member.transaction.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <div class="form-check mt-5 w-100 d-flex align-items-center">
                        <input class="form-cek" type="checkbox" id="termsCheck" name="termsCheck">
                        <label class="form-check-label ml-2" for="termsCheck">
                            Saya menyetujui <a href="#" class="syarat">Syarat & Ketentuan</a>
                        </label>
                    </div>
                    <button class="btn btn-primary d-flex mx-auto mt-3 text-center d-block px-5 py-2" type="submit">Bayar & gabung kelas</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            var termsCheck = document.getElementById('termsCheck');
            if (!termsCheck.checked) {
                event.preventDefault(); 
                alert('Anda harus menyetujui syarat dan ketentuan sebelum melanjutkan.');
            }
        });
    </script>
@endsection
