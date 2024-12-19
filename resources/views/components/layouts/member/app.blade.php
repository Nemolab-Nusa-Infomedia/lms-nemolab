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
    {{-- aos --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    @stack('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/navbar.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/footer.css') }} ">
    @stack('addon-style')
</head>

<body>

    {{-- @if (Auth::check())
        @include('components.includes.member.navbar-auth')
    @else --}}
        @include('components.includes.member.navbar')
    {{-- @endif --}}


    <main id="content" class="flex-grow-1" style="min-height: 100vh">
        {{-- content --}}
        @yield('content')
    </main>

    @include('components.includes.member.footer')

    {{-- include sweetalert --}}
    @include('sweetalert::alert')

    @stack('prepend-script')
    <!-- boostrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- box icon -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <!-- Inisialisasi AOS -->
    <script>
        AOS.init({
            once: true
        });
    </script>
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
        document.addEventListener('DOMContentLoaded', () => {
            const toggler = document.getElementById('navbarToggler');
            const iconOpened = document.getElementById('navbar-opened');
            const iconClosed = document.getElementById('navbar-closed');
            const searchForm = document.getElementById('search-form');
            const navbarBrand = document.getElementById('navbar-brand');

            toggler.addEventListener('click', () => {
                // Toggle class "active" pada gambar
                if (toggler.getAttribute('aria-expanded') === 'true') {
                    iconClosed.setAttribute('style', 'display: none');
                    iconOpened.setAttribute('style', 'display: block');
                    navbarBrand.setAttribute('style', 'display: none !important');
                    searchForm.setAttribute('style', 'display: flex !important');
                } else {
                    iconClosed.setAttribute('style', 'display: block');
                    iconOpened.setAttribute('style', 'display: none');
                    navbarBrand.setAttribute('style', 'display: flex !important');
                    searchForm.setAttribute('style', 'display: none !important');
                }
            });
            window.onresize = () => {
                if (window.innerWidth <= 768 && toggler.getAttribute('aria-expanded') === 'false') {
                    searchForm.setAttribute('style', 'display: none !important');
                } else {
                    searchForm.setAttribute('style', 'display: flex !important');
                }
            }
        });
    </script>
    @stack('addon-script')

</body>

</html>
