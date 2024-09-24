@extends('components.layouts.member.navback')

@section('title', 'Payment')

@section('content')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/payment.css') }}">
    <!-- Payment Section -->
    <div class="container" style="margin-top: 4rem">
        <div class="text-center mb-4">
            <h3 class="fw-semibold">Paket Checkout Plus</h3>
            <p style="font-size: 15px">Gabung Starter Plus dan bangun proyek nyata bersama ahli.</p>
        </div>
        <div class="payment-card mx-auto">
            @if ($course->price == 0)
                <div class="card-body d-flex flex-column">
                    <h4>Opsi Pembayaran</h4>
                    <h5 class="mt-4">Payment details</h5>
                    <p class="d-flex justify-content-between mt-3">
                        <span>Harga kelas</span>
                        <span>Rp {{ number_format($course->price, 0) }}</span>
                    </p>
                    <p class="d-flex justify-content-between mt-3">
                        <span>PPN 11%</span>
                        <span class="price-update">+ Rp. 0</span>
                    </p>
                    <p class="d-flex justify-content-between mt-3">
                        <span>Biaya layanan per siswa</span>
                        <span class="price-update">+ Rp. 0</span>
                    </p>
                    <p class="d-flex justify-content-between mt-3">
                        <span>Total</span>
                        <span class="total-price" id="total_price">Rp. 0</span>
                        @php
                            $totalPrice = $course->price;
                        @endphp
                    </p>
                    <form id="paymentForm" action="{{ route('member.transaction.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <input type="hidden" name="price" value="{{ $totalPrice }}">
                        <div class="form-check mt-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <input class="form-cek" type="checkbox" id="termsCheck" name="termsCheck">
                                <label class="form-check-label ms-2" for="termsCheck">
                                    Saya menyetujui <a href="#" class="syarat">Syarat & Ketentuan</a>
                                    <p class="text-danger d-none" id="important" style="font-size: 12px;">Anda harus menyetujui syarat dan ketentuan sebelum melanjutkan.</p>
                                </label>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary mt-4 text-center  d-block px-5 py-2" type="submit">
                                    Beli Course
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <div class="card-body d-flex flex-column">
                    <h4>
                        Opsi Pembayaran
                    </h4>
                    <h5 class="mt-4">Payment details</h5>

                    <p class="d-flex justify-content-between mt-3">
                        <span>Harga kelas</span>
                        <span>Rp {{ number_format($course->price, 0) }}</span>
                    </p>
                    <p class="d-flex justify-content-between mt-3">
                        <span>PPN 11%</span>
                        <span class="price-update">+ Rp. 11%</span>
                    </p>
                    <p class="d-flex justify-content-between mt-3">
                        <span>Service fee per student</span>
                        <span class="price-update">+ Rp. 5000</span>
                    </p>
                    <p class="d-flex justify-content-between mt-3">
                        <span>Total</span>
                        <span class="total-price" id="total_price">Rp.
                            {{ number_format($course->price * 1.11 + 5000, 0) }}</span>
                        @php
                            $totalPrice = $course->price * 1.11 + 5000;
                        @endphp
                    </p>
                    <form id="paymentForm" action="{{ route('member.transaction.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <input type="hidden" name="price" value="{{ $totalPrice }}">
                        <div class="form-check mt-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <input class="form-cek" type="checkbox" id="termsCheck" name="termsCheck">
                                <label class="form-check-label ms-2" for="termsCheck">
                                    Saya menyetujui <a href="#" class="syarat">Syarat & Ketentuan</a>
                                    <p class="text-danger d-none" id="important" style="font-size: 12px;">Anda harus menyetujui syarat dan ketentuan sebelum melanjutkan.</p>
                                </label>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary mt-4 text-center  d-block px-5 py-2" type="submit">
                                    Beli Course
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <script>

        document.getElementById('paymentForm').addEventListener('submit', function(event) {
        var termsCheck = document.getElementById('termsCheck');
        var importantText = document.getElementById('important');

        // Check if checkbox is not checked
        if (!termsCheck.checked) {
            event.preventDefault();
            // Show the important text by removing the 'd-none' class
            importantText.classList.remove('d-none');
        } else {
            // If checkbox is checked, hide the important text
            importantText.classList.add('d-none');
        }
    });
    </script>
@endsection
