@extends('layouts.public')

@section('title', 'Berita & Artikel - ' . ($schoolProfile->name ?? 'MI Darul Falah'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
    <div class="text-center max-w-2xl mx-auto space-y-2">
        <h2 class="text-3xl font-extrabold text-slate-900">Berita & Artikel Terbaru</h2>
        <p class="text-slate-600 text-sm">Informasi seputar kegiatan akademik, prestasi, dan pengumuman madrasah.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($posts as $post)
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition flex flex-col">
            <div class="h-48 bg-slate-200 flex items-center justify-center text-slate-400 relative">
                <span class="absolute top-3 left-3 bg-emerald-600 text-white text-xs font-semibold px-2.5 py-1 rounded-lg">
                    {{ $post->category->name ?? 'Berita' }}
                </span>
                <span>Foto Berita</span>
            </div>
            <div class="p-6 flex flex-col flex-grow space-y-3">
                <div class="text-xs text-slate-500">{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</div>
                <h3 class="font-bold text-slate-900 text-lg leading-snug hover:text-emerald-700">
                    <a href="{{ route('posts.detail', $post->slug) }}">{{ $post->title }}</a>
                </h3>
                <p class="text-sm text-slate-600 line-clamp-3 leading-relaxed">{{ $post->excerpt }}</p>
                <a href="{{ route('posts.detail', $post->slug) }}" class="mt-auto pt-4 text-emerald-700 font-semibold text-sm flex items-center space-x-1">
                    <span>Baca Selengkapnya</span>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-16 text-slate-500">Belum ada berita yang dipublikasikan.</div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
@endsection
