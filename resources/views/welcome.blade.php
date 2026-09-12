<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Informasi Terpadu MI Darul Falah</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700" rel="stylesheet" />
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0f172a; color: #f8fafc; }
        </style>
    </head>
    <body class="antialiased flex items-center justify-center min-h-screen">
        <div class="max-w-xl mx-auto p-8 bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl text-center space-y-6">
            <div class="inline-flex bg-emerald-500/10 text-emerald-400 px-4 py-1.5 rounded-full text-xs font-semibold border border-emerald-500/20">
                Laravel 11 + Filament v3 Foundation
            </div>
            <h1 class="text-3xl font-bold tracking-tight text-white">Sistem Informasi Terpadu MI Darul Falah</h1>
            <p class="text-slate-400 text-sm">NPSN: 69881899 • Bendomungal, Sidorejo, Krian, Sidoarjo</p>
            <div class="pt-4 flex justify-center space-x-4">
                <a href="/admin" class="bg-emerald-600 hover:bg-emerald-500 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition shadow-lg shadow-emerald-900/40">
                    Masuk Admin Panel (/admin)
                </a>
            </div>
        </div>
    </body>
</html>
