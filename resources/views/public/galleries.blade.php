@extends('layouts.public')

@section('title', 'Galeri Foto - ' . ($schoolProfile->name ?? 'MI Darul Falah'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
    <div class="text-center max-w-2xl mx-auto space-y-2">
        <h2 class="text-3xl font-extrabold text-slate-900">Galeri Foto Kegiatan</h2>
        <p class="text-slate-600 text-sm">Dokumentasi visual aktivitas siswa, fasilitas, dan momen berharga.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($galleries as $gallery)
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs space-y-4 p-6">
            <h3 class="font-bold text-slate-900 text-lg">{{ $gallery->title }}</h3>
            @if(isset($gallery->items) && $gallery->items->count() > 0)
            <div class="grid grid-cols-2 gap-2">
                @foreach($gallery->items as $item)
                <div class="h-32 bg-slate-100 rounded-lg overflow-hidden relative flex items-center justify-center text-xs text-slate-400">
                    <span>{{ $item->caption ?? 'Foto' }}</span>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-xs text-slate-500">Belum ada foto dalam galeri ini.</p>
            @endif
        </div>
        @empty
        <div class="col-span-3 text-center py-16 text-slate-500">Belum ada galeri foto yang dipublikasikan.</div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $galleries->links() }}
    </div>
</div>
@endsection
