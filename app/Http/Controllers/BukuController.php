<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();
        return view('buku', compact('bukus'));
    }

    public function store(Request $request)
    {
        $request->validate(['judul' => 'required', 'stok' => 'required|numeric']);
        Buku::create(['judul' => $request->judul, 'stok' => $request->stok]);
        return back()->with('success', 'Data buku berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Buku::find($id)->delete();
        return back()->with('success', 'Buku berhasil dihapus!');
    }
}