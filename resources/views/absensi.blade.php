<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Absensi</title>
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

        .back {
            display: inline-block;
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .back:hover { text-decoration: underline; }

        .icon { font-size: 50px; text-align: center; margin-bottom: 10px; }

        h1 {
            text-align: center;
            font-size: 24px;
            color: #2d3748;
            margin-bottom: 6px;
        }

        .tanggal {
            text-align: center;
            font-size: 13px;
            color: #a0aec0;
            margin-bottom: 28px;
        }

        /* Alert sukses */
        .alert-success {
            background: #c6f6d5;
            color: #276749;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            color: #2d3748;
            transition: border 0.2s;
            outline: none;
        }

        input:focus, select:focus {
            border-color: #667eea;
        }

        /* Error input */
        .is-error { border-color: #fc8181 !important; }

        .error-msg {
            color: #e53e3e;
            font-size: 12px;
            margin-top: 5px;
        }

        /* Radio status */
        .status-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .status-option {
            flex: 1;
            min-width: 100px;
        }

        .status-option input[type="radio"] { display: none; }

        .status-option label {
            display: block;
            text-align: center;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .status-option input[type="radio"]:checked + label {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.4);
        }
    </style>
</head>
<body>

<div class="card">
    <a href="/" class="back">← Kembali</a>

    <div class="icon">✅</div>
    <h1>Isi Absensi</h1>
    <p class="tanggal">{{ date('l, d F Y') }}</p>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert-success">
            🎉 {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/absensi/simpan">
        @csrf

        {{-- Nama --}}
        <div class="form-group">
            <label> Nama Lengkap</label>
            <input
                type="text"
                name="nama"
                placeholder="Masukkan nama kamu"
                value="{{ old('nama') }}"
                class="{{ $errors->has('nama') ? 'is-error' : '' }}"
            >
            @error('nama')
                <p class="error-msg">⚠️ {{ $message }}</p>
            @enderror
        </div>

        {{--kelas--}}
        <div class="from-group">
            <label>kelas</label>
            <input
                type="text"
                name="kelas"
                placeholder="masukan kelas kamu"
                velue="{{ old('number') }}"
                class="{{ $errors->has('number') ? 'is-error' : ' ' }}"
            >
            @error('number')
                <p class="error-msg"> {{ $message }} </p>
            @enderror
        </div>

        {{-- Tanggal --}}
        <div class="form-group">
            <label> Tanggal</label>
            <input
                type="date"
                name="tanggal"
                value="{{ old('tanggal', date('Y-m-d')) }}"
                class="{{ $errors->has('tanggal') ? 'is-error' : '' }}"
            >
            @error('tanggal')
                <p class="error-msg">⚠️ {{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div class="form-group">
            <label>📌 Status Kehadiran</label>
            <div class="status-group">

                <div class="status-option">
                    <input type="radio" name="status" id="hadir"
                        value="hadir"
                        {{ old('status') == 'hadir' ? 'checked' : '' }}>
                    <label for="hadir"> Hadir</label>
                </div>

                <div class="status-option">
                    <input type="radio" name="status" id="izin"
                        value="izin"
                        {{ old('status') == 'izin' ? 'checked' : '' }}>
                    <label for="izin"> Izin</label>
                </div>

                <div class="status-option">
                    <input type="radio" name="status" id="sakit"
                        value="sakit"
                        {{ old('status') == 'sakit' ? 'checked' : '' }}>
                    <label for="sakit"> Sakit</label>
                </div>

                <div class="status-option">
                <input type="radio" name="status" id="bolos"
                    value="bolos"
                    {{ old('status') =='bolos' ? 'checked' : '' }}>
                    <label for="bolos"> Bolos</label>
                </div>

            </div>
            @error('status')
                <p class="error-msg">⚠️ {{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn">Simpan Absensi →</button>

    </form>
</div>

</body>
</html>
