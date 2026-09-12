@extends('layouts.public')

@section('title', 'Profil Madrasah - ' . ($schoolProfile->name ?? 'MI Darul Falah'))

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
    <div class="text-center max-w-3xl mx-auto space-y-3">
        <span class="text-emerald-700 font-semibold text-xs uppercase tracking-wider bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100">Profil Resmi</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900">Tentang {{ $schoolProfile->name ?? 'MI Darul Falah' }}</h2>
        <p class="text-slate-600 text-base">Lembaga pendidikan Islam dasar terpadu yang membimbing siswa berakhlak mulia dan berprestasi.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-xs space-y-4">
            <h3 class="text-xl font-bold text-slate-900 flex items-center space-x-2">
                <span>Identitas Madrasah</span>
            </h3>
            <ul class="space-y-3 text-sm text-slate-700">
                <li class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Nama Madrasah</span>
                    <strong class="text-slate-900">{{ $schoolProfile->name }}</strong>
                </li>
                <li class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">NPSN</span>
                    <strong class="text-slate-900">{{ $schoolProfile->npsn }}</strong>
                </li>
                <li class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Akreditasi</span>
                    <strong class="text-emerald-700">{{ $schoolProfile->accreditation }}</strong>
                </li>
                <li class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Kepala Madrasah</span>
                    <strong class="text-slate-900">{{ $schoolProfile->headmaster }}</strong>
                </li>
                <li class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Alamat</span>
                    <span class="text-slate-900 text-right">{{ $schoolProfile->address }}</span>
                </li>
            </ul>
        </div>

        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-xs space-y-4 flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-bold text-slate-900 mb-4">Visi & Misi</h3>
                <p class="text-slate-700 italic bg-emerald-50 p-4 rounded-xl border border-emerald-100 text-base leading-relaxed">
                    &ldquo;{{ $schoolProfile->vision ?? 'Terwujudnya peserta didik yang berakhlak mulia, cerdas, terampil, dan berwawasan Aswaja.' }}&rdquo;
                </p>
            </div>
            @if(isset($schoolProfile->mission) && is_array($schoolProfile->mission))
            <div>
                <h4 class="font-bold text-slate-900 mb-2">Misi Utama:</h4>
                <ul class="space-y-2 text-xs text-slate-600 list-disc list-inside">
                    @foreach($schoolProfile->mission as $m)
                    <li>{{ $m }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>

    @if(isset($pages) && $pages->count() > 0)
    <div class="space-y-8 pt-8 border-t border-slate-200">
        <h3 class="text-2xl font-bold text-slate-900">Halaman & Informasi Tambahan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($pages as $page)
            <div class="bg-white p-6 rounded-2xl border border-slate-200 space-y-3 shadow-xs">
                <h4 class="font-bold text-lg text-slate-900">{{ $page->title }}</h4>
                <div class="text-sm text-slate-600 prose">{!! Str::limit(strip_tags($page->content), 200) !!}</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
