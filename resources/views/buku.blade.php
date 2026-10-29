<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buku - SQA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-purple-50 min-h-screen p-8">

    <!-- Navigasi -->
    <nav class="bg-purple-700 max-w-4xl mx-auto p-4 mb-8 rounded-xl shadow-md flex justify-center space-x-8">
        <a href="/" class="text-white hover:text-purple-200 font-semibold transition">Form Peminjaman</a>
        <a href="/riwayat" class="text-white hover:text-purple-200 font-semibold transition">Riwayat Pinjam</a>
        <a href="/buku" class="text-purple-200 font-bold border-b-2 border-purple-200">Manajemen Buku</a>
    </nav>

    <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Form Tambah Buku -->
        <div class="bg-white rounded-xl shadow-lg border-t-4 border-purple-600 p-6 h-fit">
            <h2 class="font-bold text-purple-800 mb-4">Tambah Buku Baru</h2>
            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-3 py-2 rounded text-sm mb-3">{{ session('success') }}</div>
            @endif
            <form action="{{ route('buku.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm text-purple-700 font-bold mb-1">Judul Buku</label>
                    <input type="text" name="judul" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-600" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm text-purple-700 font-bold mb-1">Jumlah Stok</label>
                    <input type="number" name="stok" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-600" required>
                </div>
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded-lg">Simpan Buku</button>
            </form>
        </div>

        <!-- Tabel Daftar Buku -->
        <div class="bg-white rounded-xl shadow-lg p-6 md:col-span-2">
            <h2 class="font-bold text-purple-800 mb-4">Daftar Buku Tersedia</h2>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-purple-100 text-purple-800">
                        <th class="p-3 border">Judul Buku</th>
                        <th class="p-3 border">Stok</th>
                        <th class="p-3 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bukus as $buku)
                    <tr>
                        <td class="p-3 border">{{ $buku->judul }}</td>
                        <td class="p-3 border font-bold text-center">{{ $buku->stok }}</td>
                        <td class="p-3 border text-center">
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:text-red-700 font-bold text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>