@extends('components.layouts.member.joinclass')

@section('title, nemolab')

@section('back', 'Back')

@section('content-payment')
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
                        <span>Rp 50,000</span>
                    </p>
                    <p class="d-flex justify-content-between mt-3">
                        <span>Kode unik</span>
                        <span class="price-update">- Rp 125</span>
                    </p>
                    <p class="d-flex justify-content-between mt-3">
                        <span>PPN 11%</span>
                        <span class="price-update">+ Rp 5,486</span>
                    </p>
                    <p class="d-flex justify-content-between mt-3">
                        <span>Service fee per student</span>
                        <span class="price-update">+ Rp 10,000</span>
                    </p>
                    <p class="d-flex justify-content-between total mt-3">
                        <span>Total</span>
                        <span class="total-price">Rp 65,361</span>
                    </p>
                    <div class="form-check mt-auto w-100 d-flex align-items-center">
                        <input class="form-cek" type="checkbox" id="termsCheck">
                        <label class="form-check-label ml-2" for="termsCheck">
                            Saya menyetujui <a href="#" class="syarat">Syarat & Ketentuan</a>
                        </label>
                    </div>
                    
                    <button class="btn btn-primary mx-auto mt-3">Bayar & gabung kelas</button>
                </div>
            </div>
        </div>
    </div>
@endsection