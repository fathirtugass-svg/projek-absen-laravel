<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Absensi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 30px 20px;
        }
        .container { max-width: 900px; margin: 0 auto; }
        .back {
            display: inline-block;
            color: white;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 16px;
        }
        h2 { color: white; margin-bottom: 20px; font-size: 22px; }

        /* Rekap */
        .rekap {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .rekap-card {
            flex: 1;
            min-width: 100px;
            background: white;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .rekap-card .angka {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
        }
        .rekap-card .label {
            font-size: 12px;
            color: #718096;
            margin-top: 4px;
        }

        /* Search */
        .search-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 16px;
        }
        .search-bar input {
            flex: 1;
            padding: 10px 16px;
            border-radius: 10px;
            border: none;
            font-size: 14px;
            outline: none;
        }
        .search-bar button {
            padding: 10px 20px;
            background: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: #667eea;
        }

        /* Alert */
        .alert-success {
            background: #c6f6d5;
            color: #276749;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        }
        th {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 14px 16px;
            text-align: left;
            font-size: 13px;
        }
        td {
            padding: 12px 16px;
            border-bottom: 1px solid #edf2f7;
            font-size: 14px;
            color: #4a5568;
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f7fafc; }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .hadir { background: #c6f6d5; color: #276749; }
        .izin  { background: #fefcbf; color: #744210; }
        .sakit { background: #fed7d7; color: #9b2c2c; }
        .bolos { background: #e9d8fd; color: #553c9a; }

        .btn-edit {
            padding: 4px 12px;
            background: #ebf8ff;
            color: #2b6cb0;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
        }
        .btn-hapus {
            padding: 4px 10px;
            background: #fff5f5;
            color: #c53030;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }
        .total {
            text-align: right;
            color: white;
            font-size: 13px;
            margin-top: 12px;
        }
    </style>
</head>
<body>
<div class="container">
    <a href="/" class="back">← Kembali</a>
    <h2> Daftar Absensi</h2>

    @if(session('success'))
        <div class="alert-success"> {{ session('success') }}</div>
    @endif

    {{-- Rekap --}}
    <div class="rekap">
        <div class="rekap-card">
            <div class="angka">{{ $rekap['total'] }}</div>
            <div class="label">Total</div>
        </div>
        <div class="rekap-card">
            <div class="angka" style="color:#276749">{{ $rekap['hadir'] }}</div>
            <div class="label">Hadir</div>
        </div>
        <div class="rekap-card">
            <div class="angka" style="color:#744210">{{ $rekap['izin'] }}</div>
            <div class="label">Izin</div>
        </div>
        <div class="rekap-card">
            <div class="angka" style="color:#9b2c2c">{{ $rekap['sakit'] }}</div>
            <div class="label">Sakit</div>
        </div>
        <div class="rekap-card">
            <div class="angka" style="color:#553c9a">{{ $rekap['bolos'] }}</div>
            <div class="label">Bolos</div>
        </div>
    </div>

    {{-- Search --}}
    <form method="GET" action="/absensi/list">
        <div class="search-bar">
            <input type="text" name="cari"
                placeholder="🔍 Cari nama..."
                value="{{ request('cari') }}">
            <button type="submit">Cari</button>
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($absensi as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->kelas ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                <td>
                    <span class="badge {{ $item->status }}">
                        @if($item->status == 'hadir') ✅
                        @elseif($item->status == 'izin') 📝
                        @elseif($item->status == 'sakit') 🤒
                        @else 🚫
                        @endif
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td>
                    <a href="/absensi/edit/{{ $item->id }}" class="btn-edit">✏️ Edit</a>
                    <form method="POST" action="/absensi/hapus/{{ $item->id }}"
                        style="display:inline"
                        onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        <button type="submit" class="btn-hapus">🗑️</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; padding:30px; color:#a0aec0">
                    📭 Belum ada data absensi
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <p class="total">Total: {{ $absensi->count() }} data</p>
</div>
</body>
</html>
