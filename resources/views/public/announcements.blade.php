@extends('layouts.public')

@section('title', 'Pengumuman Resmi - ' . ($schoolProfile->name ?? 'MI Darul Falah'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-8">
    <div class="text-center space-y-2">
        <h2 class="text-3xl font-extrabold text-slate-900">Pengumuman Resmi</h2>
        <p class="text-slate-600 text-sm">Informasi penting bagi orang tua, wali murid, dan seluruh siswa.</p>
    </div>

    <div class="space-y-4">
        @forelse($announcements as $ann)
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-3">
            <div class="flex justify-between items-start">
                <span class="bg-amber-100 text-amber-800 text-xs font-semibold px-2.5 py-1 rounded-md">
                    {{ $ann->is_pinned ? 'Disematkan (Penting)' : 'Pengumuman' }}
                </span>
                <span class="text-xs text-slate-400">{{ $ann->created_at->format('d M Y') }}</span>
            </div>
            <h3 class="font-bold text-slate-900 text-lg">{{ $ann->title }}</h3>
            <div class="text-sm text-slate-600 leading-relaxed prose">{!! $ann->content !!}</div>
        </div>
        @empty
        <div class="text-center py-16 text-slate-500">Tidak ada pengumuman aktif saat ini.</div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $announcements->links() }}
    </div>
</div>
@endsection
