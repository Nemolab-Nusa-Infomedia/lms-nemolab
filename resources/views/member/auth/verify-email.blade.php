@extends('components.layouts.member.auth')

@section('title', 'Verifikasi Email Anda')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/auth.css') }} ">
    <style>
        .timer {
            font-size: 14px;
            color: #666;
            margin-left: 5px;
        }

        .resend-btn {
            border: none;
            background: none;
            color: #007bff;
            padding: 0;
            cursor: pointer;
            text-decoration: underline;
        }

        .resend-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
@endpush

@section('content')
    <form class="card" method="post" action="{{ route('verification.verify-pin') }}">
        @csrf
        <div class="card-title">
            <h1>Verifikasi Email</h1>
            <p>Untuk memastikan akun email anda asli, mohon konfirmasi email anda dengan kode yang telah kami kirimkan</p>
        </div>
        <div class="card-form d-flex flex-row gap-3 justify-content-center">
            <input type="text" class="otp-input" data-index="1">
            <input type="text" class="otp-input" data-index="2" disabled>
            <input type="text" class="otp-input" data-index="3" disabled>
            <input type="text" class="otp-input" data-index="4" disabled>
            <input type="hidden" name="pin" id="complete-pin">
        </div>
        <div class="card-foot">
            <div id="resend-container">
                @if (session('status') != 'limit')
                    <button class="kirim-ulang" type="button" id="verificationButton" class="resend-btn">
                        Kirim ulang kode<span id="timer" class="timer">(01:00)</span>
                    </button>
                @else
                    <button type="button" disabled class="resend-btn">Kirim ulang kode</button>
                @endif            
            </div>
            <button type="submit">Konfirmasi</button>
        </div>
    </form>

    <form method="POST" action="{{ route('verification.send') }}" id="verificationForm">
        @csrf
    </form>
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
@endsection
