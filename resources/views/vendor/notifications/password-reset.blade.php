<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Akun Nemolab</title>
    <style>
        /* CSS dasar untuk gaya email */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Memastikan halaman memenuhi tinggi viewport */
            background: #f4f4f4;
        }

        .email-container {
            max-width: 600px;
            width: 100%;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid #FAA907;
            text-align: center;
            box-sizing: border-box;
        }

        .email-header img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .email-header h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .email-body {
            margin: 20px 0;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #FAA907;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }

        .email-footer {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }

        /* Responsivitas untuk perangkat mobile */
        @media (max-width: 600px) {
            .email-container {
                padding: 20px;
                max-width: 100%;
            }

            .btn {
                width: 100%;
                padding: 14px;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <!-- Ganti path dengan logo Anda -->
            <img src="https://i.ibb.co.com/JRR254r/logo-nemolab.png" alt="Logo Aplikasi">
            <h2>Reset Password Akun Nemolab</h2>
        </div>
        <div class="email-body">
            <p>Halo, {{ $user->name }}!</p>
            <p>Silahkan reset password baru anda dengan klik button di bawah ini</p>
            <p>
                <a href="{{ $url }}" class="btn" style="color: white;">Reset Password</a>
            </p>
            <p>Jika Anda tidak ingin reset password, abaikan email ini.</p>
        </div>
        <div class="email-footer">
            <p>© 2024 All Rights Reserved. Design by Vibrant Ecosystem</p>
        </div>
    </div>
</body>

</html>
