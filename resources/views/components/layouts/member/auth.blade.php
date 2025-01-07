<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nemolab - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    @stack('prepend-style')
    <link rel="icon" href="{{ asset('nemolab/member/img/nemolab.ico') }}" type="image/x-icon">

    @stack('addon-style')
    {{-- alert style --}}
    <style>
        .swal2-toast-success {
        background-color: #4caf50 !important; /* Hijau untuk success */
        color: #fff !important; /* Warna teks */
        }

        .swal2-toast-error {
            background-color: #f44336 !important; /* Merah untuk error */
            color: #fff !important;
        }

        .swal2-toast-warning {
            background-color: #ff9800 !important; /* Oranye untuk warning */
            color: #fff !important;
        }

        .swal2-toast-info {
            background-color: #2196f3 !important; /* Biru untuk info */
            color: #fff !important;
        }

        .swal2-title {
            font-size: 1rem; /* Ukuran teks */
        }

        .swal2-icon {
            margin: 0 10px;
        }

        .swal2-timer-progress-bar {
            background-color: rgba(255, 255, 255, 0.7); /* Warna progress bar */
        }
    </style>
    {{-- @stack('addon-script') --}}
</head>

<body>
    <header>
        @include('components.includes.universal.navbar-auth')
    </header>

    <main class="login-section d-flex align-items-center justify-content-center">
        @include('components.includes.universal.background-auth')
        <section>
                <img class="karakter" src="{{ asset('nemolab/img_component/karakter-hd.png') }}" alt="">
            <div class="content">
                @yield('content')
            </div>
        </section>
    </main>
    {{-- include sweetalert --}}
    @include('sweetalert::alert')
    @stack('prepend-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('alert'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: "{{ session('alert.type') }}", // success, error, warning, info
                title: "{{ session('alert.message') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'swal2-toast-{{ session('alert.type') }}'
                }
            });
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
    @stack('addon-script')
</body>

</html>
