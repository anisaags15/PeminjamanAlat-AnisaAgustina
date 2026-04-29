<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Peminjaman; 
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Statistik Admin - Menggunakan whereIn agar bisa baca huruf kecil/besar
        $stats = [
            'total'                => Peminjaman::count(),
            'menunggu_verifikasi'  => Peminjaman::whereIn('status', ['menunggu', 'MENUNGGU'])->count(),
            'sedang_dipinjam'      => Peminjaman::whereIn('status', ['disetujui', 'DISETUJUI'])->count(),
            'selesai'              => Peminjaman::whereIn('status', ['kembali', 'KEMBALI'])->count(),
            'total_inventaris'     => Alat::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // --- KELOLA KATEGORI ---
    public function kategori()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori', compact('kategoris'));
    }

    public function storeKategori(Request $req)
    {
        Kategori::create($req->all());
        return back()->with('success', 'Kategori Ditambah');
    }

    public function editKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.edit_kategori', compact('kategori'));
    }

    public function updateKategori(Request $req, $id)
    {
        $k = Kategori::findOrFail($id);
        $k->update($req->all());
        return redirect()->route('admin.kategori')->with('success', 'Kategori Diupdate');
    }

    public function destroyKategori($id)
    {
        Kategori::destroy($id);
        return back()->with('success', 'Kategori Dihapus');
    }

    // --- KELOLA ALAT (DENGAN FOTO) ---
    public function alat()
    {
        $alats = Alat::with('kategori')->get(); 
        $kategoris = Kategori::all(); 
        return view('admin.alat', compact('alats', 'kategoris'));
    }

    public function storeAlat(Request $req)
    {
        $data = $req->all();

        if ($req->hasFile('foto')) {
            $file = $req->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('storage/alat'), $nama_file);
            $data['foto'] = $nama_file;
        }

        Alat::create($data);
        return back()->with('success', 'Alat Berhasil Ditambah dengan Foto');
    }

    public function editAlat($id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all(); 
        return view('admin.edit_alat', compact('alat', 'kategoris'));
    }

    public function updateAlat(Request $req, $id)
    {
        $a = Alat::findOrFail($id);
        $data = $req->all();

        if ($req->hasFile('foto')) {
            if ($a->foto && file_exists(public_path('storage/alat/' . $a->foto))) {
                unlink(public_path('storage/alat/' . $a->foto));
            }

            $file = $req->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('storage/alat'), $nama_file);
            $data['foto'] = $nama_file;
        }

        $a->update($data);
        return redirect()->route('admin.alat')->with('success', 'Alat Berhasil Diupdate');
    }

    public function destroyAlat($id)
    {
        $a = Alat::findOrFail($id);
        if ($a->foto && file_exists(public_path('storage/alat/' . $a->foto))) {
            unlink(public_path('storage/alat/' . $a->foto));
        }
        $a->delete();
        return back()->with('success', 'Alat dan Foto Berhasil Dihapus');
    }

    // --- KELOLA USER ---
    public function user()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    public function storeUser(Request $req) {
        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'role' => $req->role
        ]);
        return back()->with('success', 'User Ditambah');
    }

    public function destroyUser($id)
    {
        User::destroy($id);
        return back()->with('success', 'User Dihapus');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function updateUser(Request $req, $id)
    {
        $u = User::findOrFail($id);
        $data = [
            'name' => $req->name,
            'email' => $req->email,
            'role' => $req->role
        ];
        if ($req->password) {
            $data['password'] = bcrypt($req->password);
        }
        $u->update($data);
        return redirect()->route('admin.user')->with('success', 'User Diupdate');
    }

    // --- KELOLA PEMINJAMAN ---
    public function peminjaman()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])->latest()->get();
        return view('admin.peminjaman', compact('peminjamans'));
    }

    public function destroyPeminjaman($id)
    {
        Peminjaman::destroy($id);
        return back()->with('success', 'Peminjaman Berhasil Dihapus!');
    }

    public function cetakPeminjaman()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])->latest()->get();
        return view('admin.cetak_peminjaman', compact('peminjamans'));
    }
}