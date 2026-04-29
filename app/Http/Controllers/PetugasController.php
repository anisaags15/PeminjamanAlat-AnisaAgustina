<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        // Statistik Petugas - Mendukung huruf kecil & besar agar sinkron dengan Admin
        $stats = [
            'total_peminjaman'    => Peminjaman::count(),
            'menunggu_verifikasi' => Peminjaman::whereIn('status', ['menunggu', 'MENUNGGU'])->count(),
            'sedang_dipinjam'     => Peminjaman::whereIn('status', ['disetujui', 'DISETUJUI'])->count(),
            'selesai'             => Peminjaman::whereIn('status', ['kembali', 'KEMBALI'])->count(),
        ];

        $peminjamans = Peminjaman::with(['user', 'alat'])->latest()->get();
        return view('petugas.dashboard', compact('peminjamans', 'stats'));
    }

    public function approve($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $alat = Alat::findOrFail($pinjam->alat_id);

        if ($alat->stok > 0) {
            // Gunakan huruf kecil agar sesuai dengan pengecekan di Blade kamu
            $pinjam->update(['status' => 'disetujui']); 
            $alat->decrement('stok');
            return back()->with('success', 'Peminjaman Berhasil Disetujui');
        }

        return back()->with('error', 'Stok Alat Habis!');
    }

    public function reject($id)
    {
        // Gunakan huruf kecil
        Peminjaman::where('id', $id)->update(['status' => 'ditolak']);
        return back()->with('success', 'Peminjaman Berhasil Ditolak');
    }

    public function return($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        
        $pinjam->update([
            'status' => 'kembali', 
            'tgl_dikembalikan' => now()
        ]);

        Alat::where('id', $pinjam->alat_id)->increment('stok');
        return back()->with('success', 'Barang Sudah Dikembalikan');
    }
}