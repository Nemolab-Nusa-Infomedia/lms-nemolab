<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nemolab | @yield('title')</title>
    @stack('prepend-style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="icon" href="{{ asset('nemolab/member/img/nemolab.ico') }}" type="image/x-icon">
    @stack('addon-style')
</head>

<body>
    <!-- HALAMAN CONTENT -->
    <div class="container-fluid d-flex justify-content-center" style="background: none !important;">
        @yield('content')
    </div>

    {{-- include sweetalert --}}
    @include('sweetalert::alert')

    @stack('prepend-script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function updateCardWidth() {
                const cards = document.querySelectorAll('.card');
                cards.forEach(card => {
                    if (window.innerWidth <= 500) {
                        card.style.setProperty('width', '90%', 'important');
                    } else {
                        card.style.setProperty('width', '75%', 'important');
                    }
                });
            }

            // Panggil saat halaman dimuat dan ketika ukuran jendela diubah
            updateCardWidth();
            window.addEventListener('resize', updateCardWidth);
        });
    </script>
    @stack('addon-script')
</body>

</html>
