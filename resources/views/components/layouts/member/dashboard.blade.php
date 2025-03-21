<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('nemolab/member/img/logo-nemolab.png') }}" type="image/x-icon" />
    <title>Nemolab - @yield('title')</title>
    <!-- boostrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    {{-- aos --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    @stack('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/navbar.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/footer.css') }} ">
    {{-- <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/setting.css') }} "> --}}

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
</head>

<body>

    @include('components.includes.member.navbar-dashboard')


    <main id="content" class="flex-grow-1" style="min-height: 100vh">
        {{-- content --}}
        @yield('content')
    </main>

    @if (!View::hasSection('hide_footer'))
        @include('components.includes.member.footer')
    @else
        <footer class="footer" id="footer" style="height: 0 !important; margin: 0 !important; padding: 0 !important;"></footer>
    @endif

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
    <!-- boostrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- box icon -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>


    <!-- Inisialisasi AOS -->
    <script>
        AOS.init({
            once: true,
        });
    </script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbarToggler = document.querySelector('.dropdown-logout');
            const registerBtn = document.getElementById('dropdownMenuButton1');

            function LinkLogoutFunc() {
                if (window.innerWidth < 992) {

                    navbarToggler.style.display = 'none';

                    registerBtn.setAttribute('data-bs-toggle', 'modal');
                    registerBtn.setAttribute('data-bs-target', '#targetModalLogin');

                } else {
                    navbarToggler.style.display = 'block';

                    registerBtn.setAttribute('data-bs-toggle', 'dropdown');
                }
                window.addEventListener('resize', LinkLogoutFunc())
            }
        });
    </script>
    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     const sidebarLinks = document.querySelectorAll(".side-tabs li a");

        //     sidebarLinks.forEach(link => {
        //         const linkUrl = new URL(link.href);
        //         const currentUrl = new URL(window.location.href);
        //         if (linkUrl.origin === currentUrl.origin && linkUrl.pathname === currentUrl.pathname) {
        //             link.parentElement.classList.add("active");
        //         } else {
        //             link.parentElement.classList.remove("active");
        //         }
        //     });
        // });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggler = document.getElementById('navbarToggler');
            const icon = document.getElementById('navbarIcon');

            toggler.addEventListener('click', () => {
                // Toggle class "active" pada gambar
                if (toggler.getAttribute('aria-expanded') === 'true') {
                    icon.src = "{{ asset('nemolab/member/img/icon-nav-active.png') }}";

                    icon.classList.remove('active');
                } else {
                    icon.src = "{{ asset('nemolab/member/img/icon-nav.png') }}";
                    icon.classList.add('active');
                }
            });
        });
    </script>
    @stack('addon-script')

</body>

</html>
