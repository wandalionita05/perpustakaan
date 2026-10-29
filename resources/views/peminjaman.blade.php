<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLib - Premium Workspace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f7ff; overflow-x: hidden; }
        .glass-nav { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.3); }
        .glass-card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.6); }
        .blob { position: absolute; filter: blur(60px); z-index: -1; opacity: 0.6; animation: float 8s infinite ease-in-out; border-radius: 50%; }
        .blob-1 { top: -10%; left: -10%; width: 400px; height: 400px; background: #c084fc; }
        .blob-2 { bottom: -10%; right: -5%; width: 500px; height: 500px; background: #818cf8; animation-delay: 2s; }
        @keyframes float { 0%, 100% { transform: translateY(0px) scale(1); } 50% { transform: translateY(-30px) scale(1.1); } }
    </style>
</head>
<body class="text-slate-800 relative min-h-screen">

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <nav class="glass-nav sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3 cursor-pointer group">
                    <div class="bg-gradient-to-br from-violet-500 to-indigo-600 p-2.5 rounded-xl shadow-lg shadow-indigo-200 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-layer-group text-white text-xl"></i>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-slate-800">Edu<span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-indigo-600">Lib.</span></span>
                </div>
                <div class="hidden md:flex space-x-2 bg-white/50 p-1.5 rounded-2xl border border-white">
                    <a href="/" class="bg-white text-indigo-700 px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-all">Peminjaman</a>
                    <a href="/riwayat" class="text-slate-500 hover:text-indigo-600 hover:bg-white/60 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all">Riwayat</a>
                    <a href="/buku" class="text-slate-500 hover:text-indigo-600 hover:bg-white/60 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all">Data Buku</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-16 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            
            <div class="lg:col-span-7 space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-700 text-sm font-bold">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-indigo-500"></span>
                    </span>
                    Sistem Manajemen V2.0
                </div>
                <h1 class="text-5xl lg:text-6xl font-extrabold text-slate-900 leading-[1.15] tracking-tight">
                    Kelola sirkulasi <br> perpustakaan dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-indigo-600">lebih cerdas.</span>
                </h1>
                <p class="text-lg text-slate-500 leading-relaxed max-w-xl">
                    Otomatisasi pencatatan peminjaman, pantau ketersediaan buku secara real-time, dan minimalkan kehilangan inventaris sekolah Anda.
                </p>
                <div class="flex gap-6 pt-4">
                    <div>
                        <p class="text-3xl font-extrabold text-slate-800">{{ count($bukus) }}</p>
                        <p class="text-sm font-semibold text-slate-500 mt-1">Total Judul Buku</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="glass-card rounded-3xl shadow-2xl shadow-indigo-900/5 p-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-violet-100 to-indigo-50 rounded-full blur-3xl -z-10"></div>
                    
                    <h2 class="text-2xl font-extrabold text-slate-800 mb-2">Peminjaman Baru</h2>
                    <p class="text-sm text-slate-500 mb-8 font-medium">Lengkapi form di bawah untuk mencatat sirkulasi.</p>

                    @if (session('success'))
                        <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-700 p-4 rounded-2xl flex items-start gap-3 shadow-sm">
                            <i class="fa-solid fa-circle-check text-emerald-500 mt-0.5"></i>
                            <div>
                                <h4 class="font-bold text-sm">Berhasil!</h4>
                                <p class="text-xs mt-0.5 opacity-90">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-6 bg-rose-50 border border-rose-100 text-rose-700 p-4 rounded-2xl flex items-start gap-3 shadow-sm">
                            <i class="fa-solid fa-circle-xmark text-rose-500 mt-0.5"></i>
                            <div>
                                <h4 class="font-bold text-sm">Gagal Diproses</h4>
                                <p class="text-xs mt-0.5 opacity-90">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('pinjam.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Peminjam</label>
                            <input type="text" name="nama_siswa" class="w-full bg-white/60 border border-slate-200 text-slate-900 text-sm rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block p-3.5 transition-all shadow-sm backdrop-blur-sm placeholder:text-slate-400" placeholder="Contoh: John Doe">
                            @error('nama_siswa') <span class="text-rose-500 text-xs font-semibold mt-1.5 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Buku yang Dipinjam</label>
                            <div class="relative">
                                <select name="buku_id" class="w-full bg-white/60 border border-slate-200 text-slate-900 text-sm rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block p-3.5 transition-all shadow-sm backdrop-blur-sm appearance-none cursor-pointer">
                                    <option value="">Pilih judul buku...</option>
                                    @foreach($bukus as $buku)
                                        <option value="{{ $buku->id }}">{{ $buku->judul }} (Stok: {{$buku->stok }})</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-chevron-down text-slate-400 text-xs"></i>
                                </div>
                            </div>
                            @error('buku_id') <span class="text-rose-500 text-xs font-semibold mt-1.5 block">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full mt-4 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white font-bold rounded-2xl text-sm px-5 py-4 shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:-translate-y-0.5 transition-all duration-300 flex justify-center items-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i> Proses Transaksi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>