<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nemolab | @yield('title')</title>
    @stack('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/admin/css/navbar.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/admin/css/footer.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/admin/css/sidebar.css') }} ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="icon" href="{{ asset('nemolab/member/img/nemolab.ico') }}" type="image/x-icon">
    @stack('addon-style')
</head>

<body>
    <!-- NAVBAR -->
    <div class="container" style="margin-bottom: 5rem">
        {{-- navbar --}}
        @include('components.includes.admin.navbar')
    </div>

    <!-- HALAMAN CONTENT -->
    <div class="container pe-0" id="mycourse">
        <div class="row w-100">
            <!-- Sidebar -->
            @include('components.includes.admin.sidebar')
            <!-- End Sidebar -->

            <!-- Content -->
            @yield('content')
        </div>
    </div>

    <!-- FOOTER -->
    @include('components.includes.admin.footer')

    {{-- include sweetalert --}}
    @include('sweetalert::alert')

    @stack('prepend-script')
    <script src="{{ asset('nemolab/components/admin/js/profile-navbar.js') }}"></script>
    <script src="{{asset('nemolab/admin/js/popupyt.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('addon-script')
</body>

</html>
