<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo-nemolab.png" type="image/x-icon" />
    <title>Nemolab - @yield('title')</title>

    <!-- boostrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    {{-- aos --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    @stack('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/navbar.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/footer.css') }} ">
    @stack('addon-style')
</head>

<body>

    <main id="content">
        {{-- content --}}
        @yield('content')
    </main>

    {{-- include sweetalert --}}
    @include('sweetalert::alert')

    @stack('prepend-script')
    <!-- boostrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- box icon -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- script khusus header --}}
    <script src="{{ asset('components.member.js.header') }}"></script>
    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <!-- Inisialisasi AOS -->
    <script>
        AOS.init();
    </script>
    @stack('addon-script')

</body>

</html>
