<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');

        /* variabel color */
        :root {
            --dark-grey: #414142;
            --blue-link: #0774FA;
            --light-lavender: #F0EAFF;
            --color-pink: #FFF6F6;
        }

        body {
            background-color: #f8f9fa;
            /* Warna latar belakang */
        }

        header .container-fluid .navbar .container-fluid #navbarNavAltMarkup .navbar-nav .profile-auth button {
            font-size: 18px;
            font-family: 'Nunito', sans-serif;
            width: max-content;
        }

        header .container-fluid .navbar .container-fluid #navbarNavAltMarkup .navbar-nav .profile-auth button.btn {
            outline: none;
            border: none;
            background: transparent;
        }

        .card {
            border: 1px solid #fd7e14;
            /* Warna border oranye */
        }

        .btn-orange {
            background-color: #fd7e14;
            /* Warna tombol oranye */
            color: white;
        }

        .btn-orange:hover {
            background-color: #e67e22;
            /* Warna hover untuk tombol */
            color: white;
        }

        .limit-btn {
            background-color: #e0e0e0;
            /* Warna abu-abu untuk tombol dinonaktifkan */
            color: #a0a0a0;
            /* Warna teks abu-abu */
            cursor: not-allowed;
            /* Menunjukkan bahwa tombol tidak dapat diklik */
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <header class="ps-3 pe-3 pt-2 pb-2 w-100 fixed-top position-fixed bg-white shadow-sm">
        <div class="container-fluid ">
            <nav class="navbar navbar-expand-lg bg-transparent">
                <div class="container-fluid ">
                    <div class="profile-auth ms-auto">
                        <div class="dropdown d-flex justify-content-end">
                            <button class="btn dropdown-toggle " type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" style="color: #414142 !important;">
                                <span class="fw-bold">
                                    {{ Auth::user()->name }}
                                </span>
                                @if (Auth::user()->avatar != null)
                                    <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}"
                                        class="rounded-5 ms-1" style="width: 42px; height: 42px;" id="img-profile">
                                @else
                                    <img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}" class="rounded-5 ms-1"
                                        style="width: 42px; height: 42px;" id="img-profile">
                                @endif
                            </button>
                            <ul class="dropdown-menu w-100 mt-2 dropdown-logout" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('member.logout') }}">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- end navbar -->
    <main>
        <div class="container" style="margin-top: 140px">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center bg-white">
                            <h3 class="mb-0">Verifikasi Email</h3>
                        </div>
                        <div class="card-body">
                            <p>Terima kasih telah mendaftar! Silakan verifikasi email Anda untuk melanjutkan.</p>

                            <p>Jika Anda tidak menerima email verifikasi, Anda dapat mengklik tombol di bawah ini untuk
                                mengirim ulang:</p>

                            @if (session('status') != 'limit')
                                <form action="{{ route('verification.send') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-orange">Kirim Ulang Verifikasi</button>
                                </form>
                            @else
                                <button class="btn btn-orange" disabled>Kirim Ulang Verifikasi</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- include sweetalert --}}
    @include('sweetalert::alert')

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
