@extends('layouts.public')

@section('title', 'Kontak Kami - ' . ($schoolProfile->name ?? 'MI Darul Falah'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
    <div class="text-center space-y-2">
        <h2 class="text-3xl font-extrabold text-slate-900">Hubungi Kami</h2>
        <p class="text-slate-600 text-sm">Silakan kunjungi atau hubungi sekretariat madrasah untuk informasi pendaftaran dan layanan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-xs space-y-6">
            <h3 class="font-bold text-slate-900 text-lg">Sekretariat Madrasah</h3>
            <div class="space-y-4 text-sm text-slate-700">
                <div class="flex items-start space-x-3">
                    <span class="font-bold text-emerald-600">Alamat:</span>
                    <span>{{ $schoolProfile->address }}</span>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="font-bold text-emerald-600">Telepon:</span>
                    <span>{{ $schoolProfile->phone }}</span>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="font-bold text-emerald-600">Email:</span>
                    <span>{{ $schoolProfile->email }}</span>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="font-bold text-emerald-600">NPSN:</span>
                    <span>{{ $schoolProfile->npsn }}</span>
                </div>
            </div>
        </div>

        <div class="bg-emerald-900 text-white p-8 rounded-2xl shadow-lg flex flex-col justify-between space-y-6">
            <div>
                <h3 class="font-bold text-lg mb-2">Portal Administrasi CMS</h3>
                <p class="text-xs text-emerald-200 leading-relaxed">
                    Bagi guru, staff, dan administrator yang memiliki hak akses, silakan masuk ke Panel Administrasi Filament untuk mengelola konten website.
                </p>
            </div>
            <a href="/admin" class="bg-white text-emerald-900 hover:bg-emerald-50 text-center py-3 rounded-xl font-bold text-sm transition shadow-md flex items-center justify-center space-x-2">
                <span>Masuk ke Panel Admin</span>
            </a>
        </div>
    </div>
</div>
@endsection
