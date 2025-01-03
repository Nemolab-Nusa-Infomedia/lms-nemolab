@extends('components.layouts.member.dashboard')

@section('title', 'Ubah Profil Anda Di Sini')
@section('hide_footer')
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar-dashboard.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/setting.css') }} ">
    <style>
        .pin-expired {
            color: #dc3545;
        }
        
        .kirim-ulang {
            cursor: pointer;
        }
        
        .kirim-ulang:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
@endpush
@section('content')

    @php
        $pinExpiresAt = Auth::user()->pin_expires_at ? strtotime(Auth::user()->pin_expires_at) : null;
    @endphp

    <section class="profile-saya-section" id="profile-saya-section">
        <div class="container-fluid mt-5 pt-5">
            <div class="row">

                @include('components.includes.member.sidebar-dashboard')

                <!-- Profile Form -->
                <div class="col-11 col-md-7 col-xl-9 mx-auto mt-2">
                    <div class="card profile-card h-100">
                        <div class="card-body d-flex flex-column align-items-center justify-content-between">
                            <div class="d-flex align-items-center align-self-start mb-3">
                                <a href="{{ route('member.setting.reset-password') }}" class="btn-back">
                                    <img src="{{ asset('nemolab/member/img/icon/arrow.png') }}" alt="Back"
                                        class="back-icon btn-costum">
                                </a>
                                <h5 class="title p-0 ps-3 fw-bold m-0">Konfirmasi Kode Verifikasi</h5>
                            </div>
                            <form class="d-flex flex-column align-items-center justify-content-between h-100 w-100" action="{{ route('verification.verify-pass') }}" id="pinForm"
                                method="POST" class="edit-form">
                                @csrf
                                @method('put')
                                <p class="text-center mb-0">Kami telah mengirimkan kode verifikasi ke email anda, silahkan cek email anda untuk mendapatkan kode verifikasi</p>
                                <div class="my-auto">
                                    <div class="d-flex flex-row gap-3 justify-content-center my-auto">
                                        <input type="text" class="otp-input" data-index="1">
                                        <input type="text" class="otp-input" data-index="2" disabled>
                                        <input type="text" class="otp-input" data-index="3" disabled>
                                        <input type="text" class="otp-input" data-index="4" disabled>
                                        <input type="hidden" name="pin" id="complete-pin">
                                    </div>
                                </div>

                                <div class="w-100 align-self-end">
                                    <div class="col-md-12 mb-3 mt-auto">
                                       <div class="align-self-center text-center">
                                            @if (session('status') != 'limit')
                                            <button type="button" id="verificationButton" class="kirim-ulang">
                                                Kirim ulang kode<span id="timer" class="timer"></span>
                                            </button>
                                            @else
                                            <button type="button" disabled class="kirim-ulang">Kirim ulang kode</button>
                                            @endif 
                                       </div>
                                        <button type="submit" id="submitBtn"
                                            class="btn btn-primary w-100 rounded-start fw-bold">Konfirmasi</button>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('verification-repass') }}" id="verificationForm">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('addon-script')
    <script>
        const form = document.getElementById('verificationForm');
        const pinForm = document.getElementById('pinForm');
        const btn = document.getElementById('verificationButton');
        const timerDisplay = document.getElementById('timer');
        const inputs = document.querySelectorAll(".otp-input");
        const submitBtn = document.getElementById('submitBtn');
        const completePin = document.querySelector("#complete-pin");
        let timeLeft = 60;
        let timerId = null;
        let pinExpiresAt = {{ $pinExpiresAt ?? 'null' }};
        let isExpired = false;

        function disableInputs() {
            inputs.forEach(input => {
                input.disabled = true;
                input.value = '';
            });
            completePin.value = '';
            submitBtn.disabled = true;
            submitBtn.classList.remove("active");
        }

        function enableInputs() {
            inputs[0].disabled = false;
            inputs[0].focus();
            submitBtn.disabled = false;
        }

        function resetTimer() {
            clearInterval(timerId);
            btn.disabled = false;
            timerDisplay.textContent = ' (PIN Kadaluarsa)';
            timerDisplay.classList.add('pin-expired');
            disableInputs();
        }

        function checkPinExpiration() {
            if (pinExpiresAt) {
                const now = Math.floor(Date.now() / 1000);
                if (now >= pinExpiresAt) {
                    if (!isExpired) {
                        resetTimer();
                        
                        Swal.fire({
                            title: 'Error',
                            text: 'PIN Verifikasi telah kadaluarsa. Silakan kirim ulang kode.',
                            icon: 'error'
                        });
                        
                        isExpired = true;
                    }
                    return true;
                }
            }
            isExpired = false;
            return false;
        }

        function startTimer() {
            timeLeft = 60;
            btn.disabled = true;
            timerDisplay.classList.remove('pin-expired');
            timerDisplay.textContent = '';

            if (checkPinExpiration()) {
                resetTimer();
                return;
            }

            enableInputs();

            clearInterval(timerId);
            timerId = setInterval(() => {
                timeLeft--;
                
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                
                timerDisplay.textContent = `(${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')})`;
                
                if (timeLeft <= 0) {
                    clearInterval(timerId);
                    btn.disabled = false;
                    timerDisplay.textContent = '';
                    timeLeft = 60;
                    checkPinExpiration();
                }
            }, 1000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (checkPinExpiration()) {
                resetTimer();
            } else {
                startTimer();
            }
        });

        setInterval(checkPinExpiration, 1000);

        function updateCompletePin() {
            let pin = '';
            inputs.forEach(input => {
                pin += input.value;
            });
            completePin.value = pin;
        }

        inputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
                if (checkPinExpiration()) {
                    return;
                }

                const currentInput = input,
                    nextInput = input.nextElementSibling,
                    prevInput = input.previousElementSibling;

                if (currentInput.value.length > 1) {
                    currentInput.value = "";
                    return;
                }

                updateCompletePin();

                if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }

                if (e.key === "Backspace") {
                    inputs.forEach((input, index2) => {
                        if (index1 <= index2 && prevInput) {
                            input.setAttribute("disabled", true);
                            input.value = "";
                            prevInput.focus();
                        }
                    });
                    updateCompletePin();
                }

                if (!inputs[3].disabled && inputs[3].value !== "") {
                    submitBtn.classList.add("active");
                    return;
                }
                submitBtn.classList.remove("active");
            });
        });

        btn.addEventListener('click', function(e) {
            e.preventDefault();
            form.submit();
            startTimer();
        });

        pinForm.addEventListener('submit', function(e) {
            if (checkPinExpiration()) {
                e.preventDefault();
                Swal.fire({
                    title: 'Error',
                    text: 'PIN Verifikasi telah kadaluarsa. Silakan kirim ulang kode.',
                    icon: 'error'
                });
                return false;
            }
        });
    </script>
@endpush