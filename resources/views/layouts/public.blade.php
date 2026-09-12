<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $schoolProfile->name ?? 'MI Darul Falah')</title>
    <meta name="description" content="Sistem Informasi Terpadu & Website Resmi {{ $schoolProfile->name ?? 'MI Darul Falah' }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen antialiased">

    <!-- Top Contact Bar -->
    <div class="bg-emerald-900 text-emerald-100 text-xs py-2 px-4">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center space-x-4">
                <span>NPSN: <strong>{{ $schoolProfile->npsn ?? '69881899' }}</strong> | Kab. Lamongan, Jawa Timur</span>
                <span class="hidden sm:inline">Telp: {{ $schoolProfile->phone ?? '(0322) 551234' }}</span>
            </div>
            <div class="flex items-center space-x-3">
                <span>Akreditasi: <strong>{{ $schoolProfile->accreditation ?? 'A (Unggul)' }}</strong></span>
                <a href="/admin" class="bg-emerald-700 hover:bg-emerald-600 text-white px-3 py-1 rounded font-medium transition shadow-xs">
                    Login Admin CMS
                </a>
            </div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-40 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <div class="bg-emerald-600 text-white p-2.5 rounded-xl shadow-md font-bold text-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </div>
                <div>
                    <h1 class="font-bold text-lg sm:text-xl text-slate-900 tracking-tight leading-tight">
                        {{ $schoolProfile->name ?? 'MI Darul Falah' }}
                    </h1>
                    <p class="text-xs text-emerald-700 font-semibold">Sistem Informasi Terpadu Madrasah</p>
                </div>
            </a>

            <!-- Desktop Menu -->
            <nav class="hidden lg:flex items-center space-x-1 text-sm font-medium text-slate-600">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('home') ? 'text-emerald-700 bg-emerald-50 font-semibold' : 'hover:text-emerald-600' }}">Beranda</a>
                <a href="{{ route('profile') }}" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('profile') ? 'text-emerald-700 bg-emerald-50 font-semibold' : 'hover:text-emerald-600' }}">Profil</a>
                <a href="{{ route('posts') }}" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('posts*') ? 'text-emerald-700 bg-emerald-50 font-semibold' : 'hover:text-emerald-600' }}">Berita</a>
                <a href="{{ route('announcements') }}" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('announcements') ? 'text-emerald-700 bg-emerald-50 font-semibold' : 'hover:text-emerald-600' }}">Pengumuman</a>
                <a href="{{ route('events') }}" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('events') ? 'text-emerald-700 bg-emerald-50 font-semibold' : 'hover:text-emerald-600' }}">Agenda</a>
                <a href="{{ route('galleries') }}" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('galleries') ? 'text-emerald-700 bg-emerald-50 font-semibold' : 'hover:text-emerald-600' }}">Galeri</a>
                <a href="{{ route('documents') }}" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('documents') ? 'text-emerald-700 bg-emerald-50 font-semibold' : 'hover:text-emerald-600' }}">Dokumen</a>
                <a href="{{ route('facilities') }}" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('facilities') ? 'text-emerald-700 bg-emerald-50 font-semibold' : 'hover:text-emerald-600' }}">Fasilitas</a>
                <a href="{{ route('achievements') }}" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('achievements') ? 'text-emerald-700 bg-emerald-50 font-semibold' : 'hover:text-emerald-600' }}">Prestasi</a>
                <a href="{{ route('extracurriculars') }}" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('extracurriculars') ? 'text-emerald-700 bg-emerald-50 font-semibold' : 'hover:text-emerald-600' }}">Ekstrakurikuler</a>
                <a href="{{ route('contact') }}" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('contact') ? 'text-emerald-700 bg-emerald-50 font-semibold' : 'hover:text-emerald-600' }}">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 border-t border-slate-800 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="space-y-3">
                <h3 class="font-bold text-white text-base">{{ $schoolProfile->name ?? 'MI Darul Falah' }}</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Sistem Informasi Terpadu & Website Resmi Madrasah. Mencetak generasi unggul, berakhlak mulia, dan berwawasan Aswaja.
                </p>
            </div>
            <div class="space-y-3">
                <h3 class="font-bold text-white text-base">Tautan Cepat</h3>
                <ul class="space-y-1.5 text-xs">
                    <li><a href="{{ route('profile') }}" class="hover:text-white transition">Profil Madrasah</a></li>
                    <li><a href="{{ route('posts') }}" class="hover:text-white transition">Berita & Artikel</a></li>
                    <li><a href="{{ route('announcements') }}" class="hover:text-white transition">Pengumuman Resmi</a></li>
                    <li><a href="{{ route('facilities') }}" class="hover:text-white transition">Fasilitas Madrasah</a></li>
                </ul>
            </div>
            <div class="space-y-3">
                <h3 class="font-bold text-white text-base">Kontak & Admin</h3>
                <p class="text-xs">NPSN: {{ $schoolProfile->npsn ?? '69881899' }}</p>
                <p class="text-xs">{{ $schoolProfile->address ?? 'Lamongan, Jawa Timur' }}</p>
                <div class="pt-2">
                    <a href="/admin" class="inline-flex items-center space-x-1.5 text-xs bg-emerald-800 hover:bg-emerald-700 text-white px-3.5 py-2 rounded-lg font-semibold transition">
                        <span>Login Filament CMS</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-slate-800 mt-8 pt-6 text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} {{ $schoolProfile->name ?? 'Madrasah Ibtidaiyah Darul Falah' }}. All rights reserved.
        </div>
    </footer>

</body>
</html>
