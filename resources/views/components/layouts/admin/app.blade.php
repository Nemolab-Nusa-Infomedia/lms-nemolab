<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nemolab | @yield('title')</title>
    @stack('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/admin/css/navbar.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/footer.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/admin/css/sidebar.css') }} ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
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
</head>

<body>
    <!-- NAVBAR -->
    @include('components.includes.admin.navbar')

    {{-- content --}}
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <section>
        @include('components.includes.member.footer')
    </section>

    {{-- include sweetalert --}}
    @include('sweetalert::alert')

    @stack('prepend-script')
    <script src="{{ asset('nemolab/components/admin/js/profile-navbar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

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
        

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            var table = $('#tablesContent').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                lengthChange: true,
                language: {
                    lengthMenu: "Tampilkan _MENU_ entri",
                    search: "Cari:",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                }
            });

            // Fungsi untuk menghapus elemen 'first' dan 'last'
            function removePaginationLinks() {
                $('.page-link.first').closest('li').remove();
                $('.page-link.last').closest('li').remove();
            }

            // Panggil fungsi di awal saat DataTable pertama kali diinisialisasi
            removePaginationLinks();

            // Panggil fungsi setiap kali tabel di-*render* ulang
            table.on('draw', function() {
                // Tambahkan sedikit delay agar elemen benar-benar sudah ada di DOM
                setTimeout(removePaginationLinks, 10);
            });
        });

        const checkbox = document.getElementById('swal2-checkbox');
        if (checkbox) {
            checkbox.remove();
        }
    </script>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var toggleBtn = document.getElementById("toggleBtn");
            var openIcon = document.getElementById("openIcon");
            var closeIcon = document.getElementById("closeIcon");

            if (sidebar.style.width === "300px") { // Adjust the width to match your desired sidebar width
                sidebar.style.width = "0";
                closeIcon.style.display = "none";
                openIcon.style.display = "block";
            } else {
                sidebar.style.width = "300px"; // Adjust the width to match your desired sidebar width
                openIcon.style.display = "none";
                closeIcon.style.display = "block";
            }
        }
    </script>
    @stack('addon-script')

</body>

</html>
