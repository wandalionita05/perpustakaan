<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat - SQA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-purple-50 min-h-screen p-8">

    <!-- Navigasi -->
    <nav class="bg-purple-700 max-w-4xl mx-auto p-4 mb-8 rounded-xl shadow-md flex justify-center space-x-8">
        <a href="/" class="text-white hover:text-purple-200 font-semibold transition">Form Peminjaman</a>
        <a href="/riwayat" class="text-purple-200 font-bold border-b-2 border-purple-200">Riwayat Pinjam</a>
        <a href="/buku" class="text-white hover:text-purple-200 font-semibold transition">Manajemen Buku</a>
    </nav>

    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg border-t-4 border-purple-600 p-6">
        <h2 class="font-bold text-2xl text-purple-800 mb-6">Riwayat Peminjaman Aktif</h2>
        
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-purple-100 text-purple-800">
                        <th class="p-3 border">Tanggal Pinjam</th>
                        <th class="p-3 border">Nama Siswa</th>
                        <th class="p-3 border">Buku Dipinjam</th>
                        <th class="p-3 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayats as $riwayat)
                    <tr>
                        <td class="p-3 border">{{ $riwayat->tanggal_pinjam }}</td>
                        <td class="p-3 border">{{ $riwayat->nama_siswa }}</td>
                        <td class="p-3 border font-semibold text-purple-700">{{ $riwayat->judul }}</td>
                        <td class="p-3 border text-center">
                            <form action="{{ route('peminjaman.kembalikan', $riwayat->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm font-bold transition">
                                    Kembalikan Buku
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-6 border text-center text-gray-500">Belum ada data peminjaman aktif.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>