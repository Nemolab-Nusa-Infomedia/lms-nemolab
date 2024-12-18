@extends('components.layouts.member.dashboard')

@section('title', 'Ubah Profil Anda Di Sini')
@section('hide_footer')
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar-dashboard.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/setting.css') }} ">
@endpush
@section('content')
    <section class="profile-saya-section" id="profile-saya-section">
        <div class="container-fluid mt-5 pt-5">
            <div class="row">

                @include('components.includes.member.sidebar-dashboard')

                <!-- Profile Form -->
                <div class="col-11 col-md-7 col-xl-9 mx-auto mt-2">
                    <div class="card profile-card h-100">
                        <div class="card-body d-flex flex-column align-items-center justify-content-between">
                            <div class="d-flex align-items-center align-self-start mb-3">
                                <a href="{{ route('member.setting') }}" class="btn-back">
                                    <img src="{{ asset('nemolab/member/img/icon/arrow.png') }}" alt="Back"
                                        class="back-icon btn-costum">
                                </a>
                                <h5 class="title p-0 ps-3 fw-bold m-0">Konfirmasi Kode Verifikasi</h5>
                            </div>
                            <form class="d-flex flex-column align-items-center justify-content-between h-100 w-100" action="#" id="profileForm"
                                method="POST" class="edit-form">
                                @csrf
                                @method('put')
                                <p class="text-center">Kami telah mengirimkan kode verifikasi ke email anda, silahkan cek email anda untuk mendapatkan kode verifikasi</p>
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
                                        @if (session('status') != 'limit')
                                        <button class="kirim-ulang" type="button" id="verificationButton" class="resend-btn">
                                            Kirim ulang kode<span id="timer" class="timer">(01:00)</span>
                                        </button>
                                        @else
                                        <button type="button" disabled class="resend-btn">Kirim ulang kode</button>
                                        @endif 
                                        <button type="submit" id="submitButton"
                                            class="btn btn-primary w-100 rounded-start fw-bold">Konfirmasi</button>
                                    </div>
                                </div>
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
        const btn = document.getElementById('verificationButton');
        const timerDisplay = document.getElementById('timer');
        let timeLeft = 60; // 1 minute in seconds
        let timerId = null;

        function startTimer() {
            btn.disabled = true;
            
            timerId = setInterval(() => {
                timeLeft--;
                
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                
                // Format timer display
                timerDisplay.textContent = `(${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')})`;
                
                if (timeLeft <= 0) {
                    clearInterval(timerId);
                    btn.disabled = false;
                    timerDisplay.textContent = '';
                    timeLeft = 60;
                }
            }, 1000);
        }

        // Start timer on page load if there's no 'limit' status
        if (btn && !btn.disabled) {
            startTimer();
        }

        btn.addEventListener('click', function() {
            form.submit();
            startTimer();
        });

        const inputs = document.querySelectorAll(".otp-input"),
            button = document.querySelector("button[type='submit']"),
            completePin = document.querySelector("#complete-pin");

        function updateCompletePin() {
            let pin = '';
            inputs.forEach(input => {
                pin += input.value;
            });
            completePin.value = pin;
        }

        inputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
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
                    button.classList.add("active");
                    return;
                }
                button.classList.remove("active");
            });
        });
    </script>
@endpush