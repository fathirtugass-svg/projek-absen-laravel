<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            max-width: 420px;
            width: 90%;
        }

        .icon {
            font-size: 60px;
            margin-bottom: 16px;
        }

        h1 {
            font-size: 26px;
            color: #2d3748;
            margin-bottom: 8px;
        }

        p {
            color: #718096;
            font-size: 15px;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 14px 36px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            margin: 6px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.5);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #667eea;
            color: #667eea;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
        }

        .divider {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 28px 0;
        }

        .info {
            font-size: 13px;
            color: #a0aec0;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>Sistem Absensi</h1>
    <p>Selamat datang! Kelola kehadiran dengan mudah dan cepat melalui sistem absensi digital.</p>

    <a href="/absensi" class="btn">Isi Absensi</a>
    <a href="/absensi/list" class="btn btn-outline">Lihat Daftar</a>

    <hr class="divider">
    <p class="info">{{ date('l, d F Y') }}</p>
</div>

</body>
</html>
