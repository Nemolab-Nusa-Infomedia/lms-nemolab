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

    <form class="card" method="post" action="{{ route('verification.verify-pin') }}" id="pinForm">
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
                    <button type="button" id="verificationButton" class="kirim-ulang">
                        Kirim ulang kode<span id="timer" class="timer"></span>
                    </button>
                @else
                    <button type="button" disabled class="kirim-ulang">Kirim ulang kode</button>
                @endif            
            </div>
            <button type="submit" id="submitBtn">Konfirmasi</button>
        </div>
    </form>

    <form method="POST" action="{{ route('verification.send') }}" id="verificationForm">
        @csrf
    </form>

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
@endsection