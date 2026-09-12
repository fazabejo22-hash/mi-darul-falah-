@extends('layouts.public')

@section('title', 'Agenda & Kegiatan - ' . ($schoolProfile->name ?? 'MI Darul Falah'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-8">
    <div class="text-center space-y-2">
        <h2 class="text-3xl font-extrabold text-slate-900">Agenda & Kegiatan</h2>
        <p class="text-slate-600 text-sm">Kalender kegiatan dan event mendatang di madrasah.</p>
    </div>

    <div class="space-y-4">
        @forelse($events as $ev)
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="space-y-1">
                <span class="bg-emerald-100 text-emerald-800 text-xs font-semibold px-2.5 py-1 rounded-md">
                    Agenda Resmi
                </span>
                <h3 class="font-bold text-slate-900 text-lg mt-1">{{ $ev->title }}</h3>
                @if($ev->location)
                <p class="text-xs text-slate-500">Lokasi: {{ $ev->location }}</p>
                @endif
            </div>
            <div class="bg-slate-50 border border-slate-200 px-4 py-3 rounded-xl text-right text-xs text-slate-700">
                <div><strong>Mulai:</strong> {{ $ev->start_at }}</div>
                @if($ev->end_at)
                <div><strong>Selesai:</strong> {{ $ev->end_at }}</div>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-16 text-slate-500">Belum ada agenda kegiatan terjadwal.</div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $events->links() }}
    </div>
</div>
@endsection
