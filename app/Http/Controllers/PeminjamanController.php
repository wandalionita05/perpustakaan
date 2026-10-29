<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();
        return view('peminjaman', compact('bukus'));
    }

    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'nama_siswa' => 'required',
            'buku_id' => 'required',
        ]);

        $buku = Buku::find($request->buku_id);

        /* 
        ================================================================
        SKENARIO 1 (BUGGY): Gunakan kode ini untuk mencari Defect. 
        Sistem akan terus mengurangi stok walau stok sudah 0, menjadi -1.
        ================================================================
        */
        Peminjaman::create([
            'buku_id' => $request->buku_id,
            'nama_siswa' => $request->nama_siswa,
            'tanggal_pinjam' => now(),
        ]);
        
        $buku->decrement('stok');

        return back()->with('success', 'Buku berhasil dipinjam!');

        /* 
        ================================================================
        SKENARIO 2 (PERBAIKAN): Aktifkan kode di bawah ini, dan HAPUS 
        Skenario 1 saat Anda melakukan Retesting untuk tugas SQA.
        ================================================================
        */
        // if ($buku->stok <= 0) {
        //     return back()->with('error', 'Gagal meminjam! Stok buku habis.');
        // }
        //
        // Peminjaman::create([
        //     'buku_id' => $request->buku_id,
        //     'nama_siswa' => $request->nama_siswa,
        //     'tanggal_pinjam' => now(),
        // ]);
        //
        // $buku->decrement('stok');
        //
        // return back()->with('success', 'Buku berhasil dipinjam!');
    }
    public function riwayat()
    {
        // Mengambil data peminjaman beserta judul bukunya
        $riwayats = Peminjaman::join('bukus', 'peminjamans.buku_id', '=', 'bukus.id')
            ->select('peminjamans.*', 'bukus.judul')
            ->orderBy('peminjamans.created_at', 'desc')
            ->get();

        return view('riwayat', compact('riwayats'));
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::find($id);
        if ($peminjaman) {
            // Tambah kembali stok buku (Regression Testing area)
            $buku = Buku::find($peminjaman->buku_id);
            if ($buku) {
                $buku->increment('stok');
            }
            // Hapus dari riwayat karena sudah dikembalikan
            $peminjaman->delete(); 
        }
        return back()->with('success', 'Buku berhasil dikembalikan dan stok telah bertambah!');
    }
}