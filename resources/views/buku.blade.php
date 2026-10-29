<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLib - Kelola Inventaris</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f7ff; }
        .glass-nav { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.3); }
        .glass-card { background: rgba(255, 255, 255, 1); border: 1px solid rgba(255,255,255,0.6); box-shadow: 0 10px 40px -10px rgba(79, 70, 229, 0.1); }
    </style>
</head>
<body class="text-slate-800">

    <nav class="glass-nav sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3 cursor-pointer group">
                    <div class="bg-gradient-to-br from-violet-500 to-indigo-600 p-2.5 rounded-xl shadow-lg shadow-indigo-200 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-layer-group text-white text-xl"></i>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-slate-800">Edu<span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-indigo-600">Lib.</span></span>
                </div>
                <div class="hidden md:flex space-x-2 bg-white/50 p-1.5 rounded-2xl border border-white shadow-sm">
                    <a href="/" class="text-slate-500 hover:text-indigo-600 hover:bg-white/60 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all">Peminjaman</a>
                    <a href="/riwayat" class="text-slate-500 hover:text-indigo-600 hover:bg-white/60 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all">Riwayat</a>
                    <a href="/buku" class="bg-white text-indigo-700 px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-all">Data Buku</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Inventaris Perpustakaan</h1>
            <p class="text-slate-500 mt-2 font-medium">Kelola database buku dan sinkronisasi stok secara menyeluruh.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-4">
                <div class="glass-card rounded-3xl p-7 sticky top-28 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-violet-100 rounded-full blur-2xl -z-10"></div>
                    <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-circle-plus text-indigo-500"></i> Entri Buku Baru
                    </h2>
                    
                    @if (session('success'))
                        <div class="mb-6 bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl border border-emerald-100 text-sm font-bold flex items-center gap-2">
                            <i class="fa-solid fa-check-double text-emerald-500"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('buku.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-wider">Judul Buku</label>
                            <input type="text" name="judul" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 p-3.5 transition-all" placeholder="Tulis judul..." required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-wider">Kuantitas Stok</label>
                            <input type="number" name="stok" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 p-3.5 transition-all" placeholder="0" required>
                        </div>
                        <button type="submit" class="w-full mt-2 text-indigo-700 bg-indigo-50 border border-indigo-100 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 font-bold rounded-xl text-sm px-5 py-3.5 transition-all duration-300">
                            Simpan ke Database
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="glass-card rounded-3xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-slate-600">
                            <thead class="text-xs text-slate-500 uppercase bg-slate-50/80 border-b border-slate-100">
                                <tr>
                                    <th scope="col" class="px-6 py-5 font-bold tracking-wider">Judul Koleksi</th>
                                    <th scope="col" class="px-6 py-5 font-bold tracking-wider text-center">Tersedia</th>
                                    <th scope="col" class="px-6 py-5 font-bold tracking-wider text-right">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @if($bukus->isEmpty())
                                <tr>
                                    <td colspan="3" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 mb-4 inline-block">
                                                <i class="fa-solid fa-inbox text-3xl text-slate-300"></i>
                                            </div>
                                            <h3 class="text-slate-800 font-bold mb-1 text-lg">Data Kosong</h3>
                                            <p class="text-slate-500 text-sm font-medium">Mulai dengan menambahkan entri buku baru.</p>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                    @foreach($bukus as $buku)
                                    <tr class="hover:bg-indigo-50/30 transition-colors group">
                                        <td class="px-6 py-4 font-bold text-slate-800">
                                            <div class="flex items-center gap-3">
                                                <div class="bg-indigo-100 text-indigo-600 p-2 rounded-lg group-hover:scale-110 transition-transform">
                                                    <i class="fa-solid fa-book"></i>
                                                </div>
                                                {{ $buku->judul }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($buku->stok > 0)
                                                <span class="bg-emerald-100 text-emerald-700 font-extrabold px-3.5 py-1.5 rounded-full text-xs">
                                                    {{ $buku->stok }} Unit
                                                </span>
                                            @else
                                                <span class="bg-rose-100 text-rose-700 font-extrabold px-3.5 py-1.5 rounded-full text-xs">
                                                    Habis
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Hapus data buku secara permanen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-rose-500 hover:text-white bg-rose-50 hover:bg-rose-500 p-2.5 rounded-xl transition-all shadow-sm hover:shadow-rose-200" title="Hapus Data">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>