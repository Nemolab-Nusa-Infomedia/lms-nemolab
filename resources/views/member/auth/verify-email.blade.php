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
            <div id="resend-container">
                <p>Jika Anda tidak menerima email verifikasi, Anda dapat mengklik tombol di bawah ini untuk mengirim ulang:
                </p>
                <button type="button" id="verificationButton" class="btn btn-orange">Kirim Ulang Verifikasi</button>
            </div>
            <button type="submit">Konfirmasi</button>
        </div>
    </form>

    <form action="{{ route('verification.send') }}" id="verificationForm" method="POST">
        @csrf
    </form>
    @push('addon-script')
        <script>
            const form = document.getElementById('verificationForm');
            const btn = document.getElementById('verificationButton');

            btn.addEventListener('click', function() {
                form.submit();
            })

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
