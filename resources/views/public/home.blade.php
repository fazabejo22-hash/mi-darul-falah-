@extends('layouts.public')

@section('title', ($schoolProfile->name ?? 'MI Darul Falah') . ' - Beranda')

@section('content')
<!-- Hero Banner -->
<div class="relative bg-emerald-950 text-white overflow-hidden py-20 lg:py-28">
    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-6">
            <span class="bg-emerald-800 text-emerald-200 px-3.5 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider border border-emerald-700">
                Madrasah Unggul & Berkarakter Aswaja
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                Membangun Generasi Cerdas, Berakhlak & Berprestasi
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Selamat datang di website resmi {{ $schoolProfile->name ?? 'MI Darul Falah' }}. Pusat informasi akademik, kegiatan siswa, dan layanan digital madrasah.
            </p>
            <div class="flex flex-wrap gap-4 pt-2">
                <a href="{{ route('posts') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-3 rounded-xl font-semibold shadow-lg shadow-emerald-900/40 transition flex items-center space-x-2">
                    <span>Jelajahi Berita</span>
                </a>
                <a href="{{ route('profile') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-200 px-6 py-3 rounded-xl font-semibold transition border border-slate-700">
                    Profil Madrasah
                </a>
            </div>
        </div>
        
        <!-- Headmaster Preview -->
        <div class="bg-slate-900 border border-slate-800 p-6 sm:p-8 rounded-2xl shadow-xl space-y-6">
            <div class="flex items-center space-x-4 border-b border-slate-800 pb-4">
                <div class="w-16 h-16 rounded-full bg-emerald-800 flex items-center justify-center text-white text-2xl font-bold shadow-inner">
                    AA
                </div>
                <div>
                    <h3 class="font-bold text-white text-lg">{{ $schoolProfile->headmaster ?? 'Drs. Ach. Azhari, M.Pd.I' }}</h3>
                    <p class="text-xs text-emerald-400">Kepala Madrasah</p>
                </div>
            </div>
            <blockquote class="text-sm text-slate-300 italic leading-relaxed">
                &ldquo;Pendidikan madrasah bukan hanya tentang kecerdasan intelektual, melainkan penanaman akidah Ahlussunnah wal Jama'ah dan akhlakul karimah yang kokoh.&rdquo;
            </blockquote>
            <div class="grid grid-cols-3 gap-3 text-center pt-2 border-t border-slate-800">
                <div class="bg-slate-950 p-3 rounded-xl border border-slate-800">
                    <div class="text-xl font-bold text-emerald-400">450+</div>
                    <div class="text-xs text-slate-400">Siswa Aktif</div>
                </div>
                <div class="bg-slate-950 p-3 rounded-xl border border-slate-800">
                    <div class="text-xl font-bold text-emerald-400">30+</div>
                    <div class="text-xs text-slate-400">Guru & Staff</div>
                </div>
                <div class="bg-slate-950 p-3 rounded-xl border border-slate-800">
                    <div class="text-xl font-bold text-emerald-400">{{ $schoolProfile->accreditation ?? 'A' }}</div>
                    <div class="text-xs text-slate-400">Akreditasi</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Announcements Ticker -->
@if(isset($announcements) && $announcements->count() > 0)
<div class="bg-amber-50 border-y border-amber-200 py-3 px-4">
    <div class="max-w-7xl mx-auto flex items-center space-x-3 text-sm text-amber-900">
        <span class="bg-amber-600 text-white text-xs px-2 py-0.5 rounded font-bold uppercase tracking-wide flex-shrink-0">
            Pengumuman
        </span>
        <p class="truncate font-medium">{{ $announcements->first()->title }}</p>
        <a href="{{ route('announcements') }}" class="text-amber-700 hover:text-amber-900 font-bold underline text-xs ml-auto flex-shrink-0">Lihat Semua</a>
    </div>
</div>
@endif

<!-- Latest News Section -->
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-end mb-10">
        <div>
            <span class="text-emerald-700 font-semibold text-xs uppercase tracking-wider bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100">Informasi & Kegiatan</span>
            <h2 className="text-2xl sm:text-3xl font-bold text-slate-900 mt-2">Berita & Artikel Terbaru</h2>
        </div>
        <a href="{{ route('posts') }}" class="hidden sm:flex items-center space-x-1 text-emerald-700 hover:text-emerald-800 font-semibold text-sm">
            <span>Semua Berita</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($posts as $post)
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition flex flex-col">
            <div class="h-48 bg-slate-200 relative overflow-hidden flex items-center justify-center text-slate-400">
                <span class="absolute top-3 left-3 bg-emerald-600 text-white text-xs font-semibold px-2.5 py-1 rounded-lg">
                    {{ $post->category->name ?? 'Berita' }}
                </span>
                <span>Berita Madrasah</span>
            </div>
            <div class="p-6 flex flex-col flex-grow space-y-3">
                <div class="text-xs text-slate-500">{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</div>
                <h3 class="font-bold text-slate-900 text-lg leading-snug hover:text-emerald-700">
                    <a href="{{ route('posts.detail', $post->slug) }}">{{ $post->title }}</a>
                </h3>
                <p class="text-sm text-slate-600 line-clamp-2 leading-relaxed">{{ $post->excerpt }}</p>
                <a href="{{ route('posts.detail', $post->slug) }}" class="mt-auto pt-4 text-emerald-700 font-semibold text-sm flex items-center space-x-1 hover:text-emerald-800">
                    <span>Baca Selengkapnya</span>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12 text-slate-500">Belum ada berita dipublikasikan.</div>
        @endforelse
    </div>
</section>

<!-- Quick Navigation Cards -->
<section class="bg-slate-100 py-16 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Jelajahi Portal Madrasah</h2>
            <p class="text-slate-600 text-sm mt-2">Akses cepat ke seluruh layanan dan informasi terpadu.</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            <a href="{{ route('profile') }}" class="bg-white p-6 rounded-2xl border border-slate-200 text-center hover:border-emerald-500 hover:shadow-md transition space-y-3 block">
                <div class="w-12 h-12 mx-auto rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">P</div>
                <h4 class="font-bold text-slate-900 text-sm">Profil</h4>
            </a>
            <a href="{{ route('posts') }}" class="bg-white p-6 rounded-2xl border border-slate-200 text-center hover:border-emerald-500 hover:shadow-md transition space-y-3 block">
                <div class="w-12 h-12 mx-auto rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">B</div>
                <h4 class="font-bold text-slate-900 text-sm">Berita</h4>
            </a>
            <a href="{{ route('announcements') }}" class="bg-white p-6 rounded-2xl border border-slate-200 text-center hover:border-emerald-500 hover:shadow-md transition space-y-3 block">
                <div class="w-12 h-12 mx-auto rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">O</div>
                <h4 class="font-bold text-slate-900 text-sm">Pengumuman</h4>
            </a>
            <a href="{{ route('events') }}" class="bg-white p-6 rounded-2xl border border-slate-200 text-center hover:border-emerald-500 hover:shadow-md transition space-y-3 block">
                <div class="w-12 h-12 mx-auto rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">A</div>
                <h4 class="font-bold text-slate-900 text-sm">Agenda</h4>
            </a>
            <a href="{{ route('galleries') }}" class="bg-white p-6 rounded-2xl border border-slate-200 text-center hover:border-emerald-500 hover:shadow-md transition space-y-3 block">
                <div class="w-12 h-12 mx-auto rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">G</div>
                <h4 class="font-bold text-slate-900 text-sm">Galeri</h4>
            </a>
            <a href="{{ route('documents') }}" class="bg-white p-6 rounded-2xl border border-slate-200 text-center hover:border-emerald-500 hover:shadow-md transition space-y-3 block">
                <div class="w-12 h-12 mx-auto rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">D</div>
                <h4 class="font-bold text-slate-900 text-sm">Dokumen</h4>
            </a>
        </div>
    </div>
</section>
@endsection
