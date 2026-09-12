@extends('layouts.public')

@section('title', 'Fasilitas & Sarana - ' . ($schoolProfile->name ?? 'MI Darul Falah'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
    <div class="text-center max-w-2xl mx-auto space-y-2">
        <h2 class="text-3xl font-extrabold text-slate-900">Fasilitas & Sarana Prasarana</h2>
        <p class="text-slate-600 text-sm">Fasilitas belajar modern untuk menunjang kenyamanan dan prestasi siswa.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($facilities as $fac)
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-3">
            <div class="flex justify-between items-start">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">F</div>
                @if(isset($fac->quantity))
                <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-2.5 py-1 rounded-md">
                    Jumlah: {{ $fac->quantity }}
                </span>
                @endif
            </div>
            <h3 class="font-bold text-slate-900 text-lg">{{ $fac->name }}</h3>
            <div class="text-sm text-slate-600 leading-relaxed prose">{!! $fac->description ?? 'Fasilitas madrasah' !!}</div>
        </div>
        @empty
        <div class="col-span-3 text-center py-16 text-slate-500">Belum ada data fasilitas.</div>
        @endforelse
    </div>
</div>
@endsection
