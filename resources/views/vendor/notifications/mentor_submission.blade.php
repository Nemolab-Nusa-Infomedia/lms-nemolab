<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Bergabung di Nemolab!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .email-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .email-body {
            padding: 20px;
        }

        .email-body h2 {
            color: #ff7f50;
        }

        .email-body p {
            line-height: 1.6;
            margin: 10px 0;
        }

        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .cta-button {
            display: inline-block;
            background-color: #ff7f50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 10px;
        }

        .cta-button:hover {
            background-color: #ff6347;
        }

        .email-footer {
            background-color: #f4f4f4;
            color: #555;
            text-align: center;
            padding: 15px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Selamat Datang di Nemolab!</h1>
        </div>
        <div class="email-body">
            <h2>Halo, {{ $user->name }}!</h2>
            <p>Kami sangat antusias menyambut Anda sebagai bagian dari keluarga besar <strong>Nemolab</strong> sebagai <strong>Mentor</strong>. Bergabunglah dalam perjalanan inovasi yang akan menginspirasi banyak orang dan memperkuat komunitas Kami.</p>
            <p>Klik tombol di bawah ini untuk melengkapi profil Anda dan mulai perjalanan Anda Bersama Nemolab:</p>
            <p style="text-align: center;">
                <a href="{{ $link }}" class="cta-button">Lengkapi Profil Anda</a>
            </p>
            <p>Kami percaya, bersama Anda, Nemolab akan terus menjadi ekosistem yang memberikan dampak positif bagi banyak orang!</p>
        </div>
        <div class="email-footer">
            &copy; 2024 All Rights Reserved. Design by Vibrant Ecosystem
        </div>
    </div>
</body>

</html>
