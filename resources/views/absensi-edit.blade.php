<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absensi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 20px;
            padding: 40px 36px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }
        .back { color: #667eea; text-decoration: none; font-size: 14px; display: inline-block; margin-bottom: 20px; }
        .icon { font-size: 50px; text-align: center; margin-bottom: 10px; }
        h1 { text-align: center; font-size: 24px; color: #2d3748; margin-bottom: 28px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 6px; }
        input, select {
            width: 100%; padding: 12px 16px;
            border: 2px solid #e2e8f0; border-radius: 10px;
            font-size: 15px; color: #2d3748; outline: none;
        }
        input:focus, select:focus { border-color: #667eea; }
        .btn {
            width: 100%; padding: 14px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white; border: none; border-radius: 50px;
            font-size: 16px; font-weight: 600; cursor: pointer; margin-top: 10px;
        }
        .status-group { display: flex; gap: 10px; }
        .status-option { flex: 1; }
        .status-option input[type="radio"] { display: none; }
        .status-option label {
            display: block; text-align: center; padding: 12px;
            border: 2px solid #e2e8f0; border-radius: 10px;
            cursor: pointer; font-size: 13px; font-weight: 600;
        }
        .status-option input[type="radio"]:checked + label {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }
    </style>
</head>
<body>
<div class="card">
    <a href="/absensi/list" class="back">← Kembali</a>
    <div class="icon">✏️</div>
    <h1>Edit Absensi</h1>

    <form method="POST" action="/absensi/update/{{ $item->id }}">
        @csrf

        <div class="form-group">
            <label> Nama Lengkap</label>
            <input type="text" name="nama" value="{{ $item->nama }}">
        </div>

        <div class="form-group">
            <label> Kelas</label>
            <input type="text" name="kelas" value="{{ $item->kelas }}">
        </div>

        <div class="form-group">
            <label> Tanggal</label>
            <input type="date" name="tanggal" value="{{ $item->tanggal }}">
        </div>

        <div class="form-group">
            <label> Status</label>
            <div class="status-group">
                <div class="status-option">
                    <input type="radio" name="status" id="hadir" value="hadir"
                        {{ $item->status == 'hadir' ? 'checked' : '' }}>
                    <label for="hadir"> Hadir</label>
                </div>
                <div class="status-option">
                    <input type="radio" name="status" id="izin" value="izin"
                        {{ $item->status == 'izin' ? 'checked' : '' }}>
                    <label for="izin"> Izin</label>
                </div>
                <div class="status-option">
                    <input type="radio" name="status" id="sakit" value="sakit"
                        {{ $item->status == 'sakit' ? 'checked' : '' }}>
                    <label for="sakit"> Sakit</label>
                </div>
                <div class="status-option">
                    <input type="radio" name="status" id="bolos" value="bolos"
                        {{ $item->status == 'bolos' ? 'checked' : '' }}>
                    <label for="bolos"> Bolos</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn">Simpan Perubahan →</button>
    </form>
</div>
</body>
</html>
