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
    <main>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifikasi Email</div>
                <div class="card-body">
                    <h4>{{ Auth::user()->name }}</h4>
                    
                    @if (Auth::user()->avatar != null)
                        <!-- Avatar display logic -->
                    @endif

                    <p>Terima kasih telah mendaftar! Silakan masukkan PIN verifikasi yang telah dikirim ke email Anda.</p>

                    <form method="POST" action="{{ route('verification.verify-pin') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="pin" class="form-control" 
                                   maxlength="4" placeholder="Masukkan PIN 4 digit"
                                   style="letter-spacing: 1em; text-align: center;">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Verifikasi PIN</button>
                    </form>

                    @if (session('status') != 'limit')
                        <form method="POST" action="{{ route('verification.send') }}" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-link">Kirim Ulang PIN Verifikasi</button>
                        </form>
                    @else
                        <button disabled class="btn btn-link">Kirim Ulang PIN Verifikasi</button>
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
