@extends('layouts.public')

@section('title', 'Prestasi Siswa - ' . ($schoolProfile->name ?? 'MI Darul Falah'))

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
    <div class="text-center max-w-2xl mx-auto space-y-2">
        <h2 class="text-3xl font-extrabold text-slate-900">Prestasi Siswa & Madrasah</h2>
        <p class="text-slate-600 text-sm">Daftar kejuaraan dan penghargaan membanggakan di berbagai tingkat kompetisi.</p>
    </div>

    <div class="space-y-4">
        @forelse($achievements as $ach)
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold flex-shrink-0">🏆</div>
                <div>
                    <div class="flex items-center space-x-2">
                        @if($ach->level)
                        <span class="bg-amber-100 text-amber-800 text-xs font-semibold px-2 py-0.5 rounded">
                            {{ $ach->level }}
                        </span>
                        @endif
                        @if($ach->category)
                        <span class="bg-emerald-100 text-emerald-800 text-xs font-semibold px-2 py-0.5 rounded">
                            {{ $ach->category }}
                        </span>
                        @endif
                    </div>
                    <h3 class="font-bold text-slate-900 text-lg mt-1">{{ $ach->title }}</h3>
                    @if(isset($ach->recipient_name))
                    <p class="text-xs text-slate-500 mt-0.5">Penerima: <strong>{{ $ach->recipient_name }}</strong></p>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-16 text-slate-500">Belum ada prestasi yang dicatat.</div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $achievements->links() }}
    </div>
</div>
@endsection
