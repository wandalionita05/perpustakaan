<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan SQA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-purple-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-xl shadow-lg border-t-4 border-purple-600 w-full max-w-md p-6">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-purple-800">Perpustakaan SQA</h1>
            <p class="text-sm text-purple-500">Form Peminjaman Buku</p>
        </div>

        <!-- Alert Notifikasi -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('pinjam.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-purple-700 text-sm font-bold mb-2">Nama Siswa</label>
                <input type="text" name="nama_siswa" class="w-full px-3 py-2 border border-purple-200 rounded-lg focus:outline-none focus:border-purple-600 focus:ring-1 focus:ring-purple-600 transition-colors" placeholder="Masukkan nama...">
                @error('nama_siswa')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-purple-700 text-sm font-bold mb-2">Pilih Buku</label>
                <select name="buku_id" class="w-full px-3 py-2 border border-purple-200 rounded-lg focus:outline-none focus:border-purple-600 focus:ring-1 focus:ring-purple-600 bg-white">
                    <option value="">-- Pilih Buku --</option>
                    @foreach ($bukus as $buku)
                        <option value="{{ $buku->id }}">{{ $buku->judul }} (Stok: {{ $buku->stok }})</option>
                    @endforeach
                </select>
                @error('buku_id')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                Simpan Peminjaman
            </button>
        </form>
    </div>

</body>
</html>