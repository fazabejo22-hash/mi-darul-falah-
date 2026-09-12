@extends('layouts.public')

@section('title', 'Dokumen Unduhan - ' . ($schoolProfile->name ?? 'MI Darul Falah'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-8">
    <div class="text-center space-y-2">
        <h2 class="text-3xl font-extrabold text-slate-900">Unduhan Dokumen Resmi</h2>
        <p class="text-slate-600 text-sm">Unduh kalender akademik, panduan kurikulum, dan formulir penting.</p>
    </div>

    <div class="space-y-4">
        @forelse($documents as $doc)
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between gap-4">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">PDF</div>
                <div>
                    <h3 class="font-bold text-slate-900 text-base">{{ $doc->title }}</h3>
                    <p class="text-xs text-slate-500">Dipublikasikan: {{ $doc->created_at->format('d M Y') }}</p>
                </div>
            </div>
            @if($doc->file_path)
            <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-2 rounded-xl text-xs font-semibold flex items-center space-x-1.5 transition flex-shrink-0">
                <span>Unduh File</span>
            </a>
            @else
            <span class="text-xs text-slate-400">File tidak tersedia</span>
            @endif
        </div>
        @empty
        <div class="text-center py-16 text-slate-500">Belum ada dokumen publik yang diunggah.</div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $documents->links() }}
    </div>
</div>
@endsection
