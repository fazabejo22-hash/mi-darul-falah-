@extends('layouts.public')

@section('title', $post->title . ' - ' . ($schoolProfile->name ?? 'MI Darul Falah'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
    <div class="space-y-4">
        <a href="{{ route('posts') }}" class="text-xs font-bold text-emerald-700 hover:underline">&larr; Kembali ke Berita</a>
        <div class="flex items-center space-x-2">
            <span class="bg-emerald-100 text-emerald-800 text-xs font-semibold px-2.5 py-1 rounded-md">
                {{ $post->category->name ?? 'Berita' }}
            </span>
            <span class="text-xs text-slate-400">{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight">{{ $post->title }}</h1>
    </div>

    <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-xs space-y-6">
        <div class="prose max-w-none text-slate-700 leading-relaxed space-y-4">
            {!! $post->content !!}
        </div>
    </div>

    @if(isset($recentPosts) && $recentPosts->count() > 0)
    <div class="space-y-6 pt-10 border-t border-slate-200">
        <h3 class="text-xl font-bold text-slate-900">Berita Terkait Lainnya</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($recentPosts as $rp)
            <div class="bg-white p-5 rounded-xl border border-slate-200 space-y-2">
                <div class="text-xs text-slate-400">{{ $rp->created_at->format('d M Y') }}</div>
                <h4 class="font-bold text-sm text-slate-900 leading-snug hover:text-emerald-700">
                    <a href="{{ route('posts.detail', $rp->slug) }}">{{ $rp->title }}</a>
                </h4>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
