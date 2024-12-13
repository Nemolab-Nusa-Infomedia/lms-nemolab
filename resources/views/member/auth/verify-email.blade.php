@extends('components.layouts.member.auth')

@section('title', 'Verifikasi Email Anda')

@push('prepend-style')    
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/auth.css') }} ">
@endpush

@section('content')
<form class="card" method="post" action="{{ route('verification.verify-pin') }}">
    @csrf 
    <div class="card-title mb">
        <h1>Verifikasi Email</h1>
        <p>Untuk memastikan akun email anda asli, mohon konfirmasi email anda dengan kode yang telah kami kirimkan</p>
    </div>
    <div class="card-form d-flex flex-row gap-3 justify-content-center mb">
        <input type="text" class="otp-input">
        <input type="text" class="otp-input" disabled>
        <input type="text" class="otp-input" disabled>
        <input type="text" class="otp-input" disabled>
    </div>
    <div class="card-foot">
        <a href="">Kirim Ulang Kode*(Timer)*</a>
        <button type="submit">Konfirmasi</button>
    </div>
</form>

@push('addon-script')
    <script>
         const inputs = document.querySelectorAll("input"),
            button = document.querySelector("button");

            inputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
                const currentInput = input,
                nextInput = input.nextElementSibling,
                prevInput = input.previousElementSibling;

                if (currentInput.value.length > 1) {
                currentInput.value = "";
                return;
                }

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
                }

                if (!inputs[3].disabled && inputs[3].value !== "") {
                button.classList.add("active");
                return;
                }
                button.classList.remove("active");
            });
            });

            window.addEventListener("load", () => inputs[0].focus());
    </script>
@endpush
@endsection