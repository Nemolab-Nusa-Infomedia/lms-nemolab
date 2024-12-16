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
    <div class="card-title mb">
        <h1>Verifikasi Email</h1>
        <p>Untuk memastikan akun email anda asli, mohon konfirmasi email anda dengan kode yang telah kami kirimkan</p>
    </div>
    <div class="card-form d-flex flex-row gap-3 justify-content-center mb">
        <input type="text" class="otp-input" data-index="1">
        <input type="text" class="otp-input" data-index="2" disabled>
        <input type="text" class="otp-input" data-index="3" disabled>
        <input type="text" class="otp-input" data-index="4" disabled>
        <input type="hidden" name="pin" id="complete-pin">
    </div>
    <div class="card-foot">
        <form id="resend-form" action="{{ route('verification.send') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="resend-btn" id="resend-btn" {{ session('status') == 'limit' ? 'disabled' : '' }}>
                Kirim Ulang Kode<span id="timer" class="timer">(01:00)</span>
            </button>
        </form>
        <button type="submit">Konfirmasi</button>
    </div>
</form>

@push('addon-script')
    <script>
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

        // Timer functionality
        function startTimer() {
            let timeLeft = 60; // 1 minute in seconds
            const timerElement = document.getElementById('timer');
            const resendBtn = document.getElementById('resend-btn');
            
            resendBtn.disabled = true;
            
            const interval = setInterval(() => {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                
                timerElement.textContent = `(${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')})`;
                
                if (timeLeft <= 0) {
                    clearInterval(interval);
                    resendBtn.disabled = false;
                    timerElement.textContent = '';
                } else {
                    timeLeft--;
                }
            }, 1000);
        }

        // Start timer on page load
        window.addEventListener("load", () => {
            inputs[0].focus();
            startTimer();
        });

        // Handle resend form submission
        const resendForm = document.getElementById('resend-form');
        const resendBtn = document.getElementById('resend-btn');

        resendForm.addEventListener('submit', function(e) {
            if (resendBtn.disabled) {
                e.preventDefault();
                return;
            }
            startTimer();
        });
    </script>
@endpush
@endsection