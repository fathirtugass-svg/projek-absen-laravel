<?php

use Illuminate\Support\Facades\Route;
use App\Models\Absensi;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/absensi', function () {
    return view('absensi');
});

Route::post('/absensi/simpan', function () {
    request()->validate([
        'nama'    => 'required|min:3',
        'tanggal' => 'required|date',
        'status'  => 'required',
    ]);

    Absensi::create([
        'nama'    => request('nama'),
        'kelas'   => request('kelas'),
        'tanggal' => request('tanggal'),
        'status'  => request('status'),
    ]);

    return redirect('/absensi')->with('success', 'Absensi berhasil disimpan!');
});

// List + search + rekap
Route::get('/absensi/list', function () {
    $query = Absensi::latest();

    if (request('cari')) {
        $query->where('nama', 'like', '%' . request('cari') . '%');
    }

    $absensi = $query->get();

    $rekap = [
        'hadir' => Absensi::where('status', 'hadir')->count(),
        'izin'  => Absensi::where('status', 'izin')->count(),
        'sakit' => Absensi::where('status', 'sakit')->count(),
        'bolos' => Absensi::where('status', 'bolos')->count(),
        'total' => Absensi::count(),
    ];

    return view('absensi-list', compact('absensi', 'rekap'));
});

// Hapus
Route::post('/absensi/hapus/{id}', function ($id) {
    Absensi::findOrFail($id)->delete();
    return redirect('/absensi/list')->with('success', 'Data berhasil dihapus!');
});

// Form edit
Route::get('/absensi/edit/{id}', function ($id) {
    $item = Absensi::findOrFail($id);
    return view('absensi-edit', compact('item'));
});

// Simpan edit
Route::post('/absensi/update/{id}', function ($id) {
    request()->validate([
        'nama'    => 'required|min:3',
        'tanggal' => 'required|date',
        'status'  => 'required',
    ]);

    Absensi::findOrFail($id)->update([
        'nama'    => request('nama'),
        'kelas'   => request('kelas'),
        'tanggal' => request('tanggal'),
        'status'  => request('status'),
    ]);

    return redirect('/absensi/list')->with('success', 'Data berhasil diupdate!');
});
