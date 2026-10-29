<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLib - Riwayat Sirkulasi</title>
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
                    <a href="/riwayat" class="bg-white text-indigo-700 px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-all">Riwayat</a>
                    <a href="/buku" class="text-slate-500 hover:text-indigo-600 hover:bg-white/60 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all">Data Buku</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Sirkulasi Aktif</h1>
                <p class="text-slate-500 mt-2 font-medium">Pemantauan buku yang sedang berada di tangan siswa.</p>
            </div>
            <a href="/" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-5 rounded-xl text-sm transition-all shadow-lg shadow-indigo-200 hover:-translate-y-0.5 inline-flex items-center gap-2">
                <i class="fa-solid fa-hand-holding-hand"></i> Buat Peminjaman
            </a>
        </div>

        @if (session('success'))
            <div class="mb-8 bg-emerald-50 text-emerald-700 px-5 py-4 rounded-2xl border border-emerald-100 font-bold flex items-center gap-3 shadow-sm">
                <div class="bg-emerald-200 text-emerald-700 rounded-full w-8 h-8 flex items-center justify-center">
                    <i class="fa-solid fa-check"></i>
                </div>
                {{ session('success') }}
            </div>
        @endif

        <div class="glass-card rounded-3xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50/80 border-b border-slate-100">
                        <tr>
                            <th scope="col" class="px-6 py-5 font-bold tracking-wider">Identitas Peminjam</th>
                            <th scope="col" class="px-6 py-5 font-bold tracking-wider">Materi Literasi</th>
                            <th scope="col" class="px-6 py-5 font-bold tracking-wider">Timestamp</th>
                            <th scope="col" class="px-6 py-5 font-bold tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-5 font-bold tracking-wider text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @if($riwayats->isEmpty())
                        <tr>
                            <td colspan="5" class="px-6 py-24 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="relative mb-5">
                                        <div class="absolute inset-0 bg-indigo-100 rounded-full blur-xl opacity-50"></div>
                                        <div class="bg-white p-5 rounded-3xl shadow-sm border border-slate-100 relative">
                                            <i class="fa-solid fa-shield-check text-4xl text-emerald-400"></i>
                                        </div>
                                    </div>
                                    <h3 class="text-slate-800 font-extrabold text-xl mb-1">Aman & Terkendali</h3>
                                    <p class="text-slate-500 text-sm font-medium">Seluruh buku saat ini telah dikembalikan ke rak perpustakaan.</p>
                                </div>
                            </td>
                        </tr>
                        @else
                            @foreach($riwayats as $riwayat)
                            <tr class="hover:bg-indigo-50/30 transition-colors">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-gradient-to-br from-violet-200 to-indigo-200 text-indigo-800 rounded-xl w-10 h-10 flex items-center justify-center font-extrabold shadow-sm border border-white">
                                            {{ strtoupper(substr($riwayat->nama_siswa, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-extrabold text-slate-900">{{ $riwayat->nama_siswa }}</div>
                                            <div class="text-xs text-slate-500 font-medium">Siswa / Anggota</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="font-bold text-slate-800">{{ $riwayat->judul }}</div>
                                    <div class="text-xs text-indigo-500 font-semibold mt-0.5">Sedang dibaca</div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="inline-flex items-center gap-1.5 text-slate-500 font-medium bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
                                        <i class="fa-regular fa-clock text-xs"></i> 
                                        {{ date('d M Y, H:i', strtotime($riwayat->tanggal_pinjam)) }}
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-2 bg-amber-50 border border-amber-100 text-amber-700 font-bold px-3 py-1.5 rounded-xl text-xs">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                        </span>
                                        Belum Kembali
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <form action="{{ route('peminjaman.kembalikan', $riwayat->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-slate-900 hover:bg-indigo-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-colors shadow-sm inline-flex items-center gap-2">
                                            <i class="fa-solid fa-arrow-right-arrow-left"></i> Kembalikan
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
    </main>
</body>
</html>