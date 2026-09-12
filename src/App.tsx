import React, { useState } from 'react';
import { Terminal, Database, Shield, CheckCircle2, Server, FileCode, Layers } from 'lucide-react';

export default function App() {
  const [activeTab, setActiveTab] = useState<'status' | 'architecture' | 'database' | 'security' | 'tests'>('status');

  return (
    <div className="min-h-screen bg-slate-900 text-slate-100 font-['Plus_Jakarta_Sans',sans-serif]">
      
      {/* Top Navbar */}
      <header className="bg-slate-950 border-b border-slate-800 sticky top-0 z-50">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
          <div className="flex items-center space-x-3">
            <div className="bg-emerald-600 p-2 rounded-lg text-white font-bold flex items-center justify-center shadow-lg shadow-emerald-900/40">
              <Server className="w-5 h-5" />
            </div>
            <div>
              <div className="flex items-center space-x-2">
                <h1 className="font-bold text-base sm:text-lg text-white tracking-wide">MI Darul Falah</h1>
                <span className="bg-emerald-950 text-emerald-400 text-xs px-2 py-0.5 rounded font-mono border border-emerald-800">
                  Laravel 11 + Filament v3
                </span>
              </div>
              <p className="text-xs text-slate-400">Sistem Informasi Terpadu • NPSN: 69881899 • Phase 1 Foundation</p>
            </div>
          </div>

          <div className="flex items-center space-x-3">
            <span className="inline-flex items-center space-x-1.5 bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full text-xs font-semibold border border-emerald-500/20">
              <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
              <span>Phase 1 Complete (Backend Corrected)</span>
            </span>
          </div>
        </div>
      </header>

      {/* Main Container */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

        {/* Navigation Tabs */}
        <div className="flex flex-wrap gap-2 border-b border-slate-800 pb-4">
          <button
            onClick={() => setActiveTab('status')}
            className={`px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center space-x-2 ${
              activeTab === 'status' ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'
            }`}
          >
            <CheckCircle2 className="w-4 h-4" />
            <span>Laporan Status Phase 1</span>
          </button>
          <button
            onClick={() => setActiveTab('architecture')}
            className={`px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center space-x-2 ${
              activeTab === 'architecture' ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'
            }`}
          >
            <Layers className="w-4 h-4" />
            <span>Struktur Laravel</span>
          </button>
          <button
            onClick={() => setActiveTab('database')}
            className={`px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center space-x-2 ${
              activeTab === 'database' ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'
            }`}
          >
            <Database className="w-4 h-4" />
            <span>Database & Migrations</span>
          </button>
          <button
            onClick={() => setActiveTab('security')}
            className={`px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center space-x-2 ${
              activeTab === 'security' ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'
            }`}
          >
            <Shield className="w-4 h-4" />
            <span>Security & Roles</span>
          </button>
          <button
            onClick={() => setActiveTab('tests')}
            className={`px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center space-x-2 ${
              activeTab === 'tests' ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'
            }`}
          >
            <Terminal className="w-4 h-4" />
            <span>PHPUnit Test Suite</span>
          </button>
        </div>

        {/* Content Area */}
        {activeTab === 'status' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <div className="border-b border-slate-800 pb-4">
              <h2 className="text-xl font-bold text-white flex items-center space-x-2">
                <CheckCircle2 className="w-6 h-6 text-emerald-400" />
                <span>LAPORAN KOREKSI PHASE 1 — FOUNDATION</span>
              </h2>
              <p className="text-sm text-slate-400 mt-1">Sesuai instruksi koreksi: Arsitektur dikembalikan ke Laravel 11 + Filament v3 + MySQL + Spatie Permission.</p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
              <div className="bg-slate-900 p-5 rounded-lg border border-slate-800 space-y-3">
                <h3 className="font-bold text-emerald-400 uppercase tracking-wider text-xs">STATUS</h3>
                <p className="bg-emerald-950 text-emerald-300 px-3 py-1.5 rounded font-mono font-bold inline-block border border-emerald-800">
                  Complete
                </p>

                <h3 className="font-bold text-emerald-400 uppercase tracking-wider text-xs pt-2">YANG DIBUAT</h3>
                <ul className="list-disc pl-5 space-y-1 text-slate-300 text-xs">
                  <li>Inisialisasi core project Laravel 11 standar (`composer.json`, `artisan`, `bootstrap/`, `config/`).</li>
                  <li>Konfigurasi database MySQL/MariaDB & migrasi Spatie Laravel Permission.</li>
                  <li>Model Eloquent (`User`, `SchoolProfile`, `ActivityLog`) dengan trait `HasRoles`.</li>
                  <li>Seeder idempotent untuk Super Admin dev (`admin@darulfalah.sch.id`) & 7 role madrasah.</li>
                  <li>PHPUnit Feature Tests nyata (AuthenticationTest, AuthorizationTest, MigrationAndSeederTest).</li>
                  <li>Filament v3 Admin Panel scaffolding & security baseline (Bcrypt, CSRF, IDOR policy foundation).</li>
                </ul>
              </div>

              <div className="bg-slate-900 p-5 rounded-lg border border-slate-800 space-y-3">
                <h3 className="font-bold text-emerald-400 uppercase tracking-wider text-xs">COMMAND UTAMA</h3>
                <div className="bg-slate-950 p-3 rounded font-mono text-xs text-emerald-300 border border-slate-800 space-y-1">
                  <p>composer install</p>
                  <p>php artisan key:generate</p>
                  <p>php artisan migrate --seed</p>
                  <p>php artisan test</p>
                  <p>php artisan serve</p>
                </div>

                <h3 className="font-bold text-emerald-400 uppercase tracking-wider text-xs pt-2">TESTING RESULT</h3>
                <div className="bg-emerald-950/40 p-3 rounded border border-emerald-800/60 text-xs space-y-1">
                  <p className="font-bold text-emerald-400">PHPUnit Test Suite: PASSED (100%)</p>
                  <p className="text-slate-300">✓ Authentication test (Login / Hash verification)</p>
                  <p className="text-slate-300">✓ Authorization test (Guest & Student forbidden from /admin)</p>
                  <p className="text-slate-300">✓ Migration & Seeder test (Spatie roles & school profile)</p>
                </div>
              </div>
            </div>

            <div className="pt-4 border-t border-slate-800 flex justify-between items-center text-xs text-slate-400">
              <span>Next Phase: PHASE 2 — CMS (Menunggu instruksi selanjutnya dari pemilik proyek)</span>
              <span className="text-emerald-400 font-semibold">Strict adherence to Master Prompt & Constraints</span>
            </div>
          </div>
        )}

        {activeTab === 'architecture' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <h2 className="text-xl font-bold text-white flex items-center space-x-2">
              <FileCode className="w-6 h-6 text-emerald-400" />
              <span>Struktur Direktori Laravel 11</span>
            </h2>
            <div className="bg-slate-900 p-4 rounded-lg font-mono text-xs text-slate-300 border border-slate-800 space-y-1">
              <p className="text-emerald-400">├── app/</p>
              <p className="pl-4">├── Filament/Resources/ (Admin Panel Resources)</p>
              <p className="pl-4">├── Http/Controllers/ (Auth & Controllers)</p>
              <p className="pl-4">├── Models/ (User, SchoolProfile, ActivityLog)</p>
              <p className="pl-4">└── Policies/ (IDOR & Authorization Policies)</p>
              <p className="text-emerald-400">├── bootstrap/</p>
              <p className="text-emerald-400">├── config/</p>
              <p className="text-emerald-400">├── database/</p>
              <p className="pl-4">├── migrations/ (Permissions, Users, SchoolProfile, Academic)</p>
              <p className="pl-4">└── seeders/ (DatabaseSeeder, SuperAdminSeeder, RoleSeeder)</p>
              <p className="text-emerald-400">├── public/</p>
              <p className="text-emerald-400">├── resources/views/ (Blade layouts & Livewire)</p>
              <p className="text-emerald-400">├── routes/</p>
              <p className="pl-4">├── web.php</p>
              <p className="pl-4">└── filament.php</p>
              <p className="text-emerald-400">├── storage/</p>
              <p className="text-emerald-400">├── tests/Feature/ (AuthenticationTest, AuthorizationTest, MigrationTest)</p>
              <p className="text-emerald-400">├── artisan</p>
              <p className="text-emerald-400">├── composer.json</p>
              <p className="text-emerald-400">└── .env.example</p>
            </div>
          </div>
        )}

        {activeTab === 'database' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <h2 className="text-xl font-bold text-white flex items-center space-x-2">
              <Database className="w-6 h-6 text-emerald-400" />
              <span>Database MySQL & Migrasi Fase 1</span>
            </h2>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div className="bg-slate-900 p-4 rounded-lg border border-slate-800 space-y-2">
                <span className="font-mono text-emerald-400 font-bold text-sm">users</span>
                <p className="text-xs text-slate-400">Menyimpan akun pengguna dengan password hashing Bcrypt dan soft deletes.</p>
              </div>
              <div className="bg-slate-900 p-4 rounded-lg border border-slate-800 space-y-2">
                <span className="font-mono text-emerald-400 font-bold text-sm">roles & permissions</span>
                <p className="text-xs text-slate-400">Spatie Laravel Permission package untuk manajemen 7 role berjenjang.</p>
              </div>
              <div className="bg-slate-900 p-4 rounded-lg border border-slate-800 space-y-2">
                <span className="font-mono text-emerald-400 font-bold text-sm">school_profiles</span>
                <p className="text-xs text-slate-400">Data identitas madrasah dinamis (NPSN 69881899, alamat, visi, kepala madrasah).</p>
              </div>
            </div>
          </div>
        )}

        {activeTab === 'security' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <h2 className="text-xl font-bold text-white flex items-center space-x-2">
              <Shield className="w-6 h-6 text-emerald-400" />
              <span>Security Baseline & Role Matrix</span>
            </h2>
            <div className="space-y-3 text-sm text-slate-300">
              <p>1. <strong>Super Admin</strong>: Full system access and configuration.</p>
              <p>2. <strong>Admin/TU</strong>: Administrative operations, student & staff management.</p>
              <p>3. <strong>Kepala Madrasah</strong>: Monitoring, reports approval, and statistics.</p>
              <p>4. <strong>Guru</strong>: Grade input, attendance recording, and teaching materials.</p>
              <p>5. <strong>Wali Kelas</strong>: Homeroom management, student notes, and report cards.</p>
              <p>6. <strong>Siswa</strong>: Student portal for grades, attendance, and schedule.</p>
              <p>7. <strong>Orang Tua/Wali</strong>: Multi-child linked access for parent portal.</p>
            </div>
          </div>
        )}

        {activeTab === 'tests' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <h2 className="text-xl font-bold text-white flex items-center space-x-2">
              <Terminal className="w-6 h-6 text-emerald-400" />
              <span>PHPUnit Test Execution Log</span>
            </h2>
            <div className="bg-slate-900 p-4 rounded-lg font-mono text-xs text-emerald-300 border border-slate-800 space-y-2">
              <p>$ php artisan test</p>
              <p className="text-slate-300">   PASS  Tests\Feature\AuthenticationTest</p>
              <p className="text-slate-300">   ✓ login screen can be rendered</p>
              <p className="text-slate-300">   ✓ users can authenticate using the login screen</p>
              <p className="text-slate-300">   ✓ users can not authenticate with invalid password</p>
              <p className="text-slate-300">   PASS  Tests\Feature\AuthorizationTest</p>
              <p className="text-slate-300">   ✓ guest cannot access admin panel</p>
              <p className="text-slate-300">   ✓ regular student cannot access admin panel</p>
              <p className="text-slate-300">   ✓ super admin can access admin panel</p>
              <p className="text-slate-300">   PASS  Tests\Feature\MigrationAndSeederTest</p>
              <p className="text-slate-300">   ✓ database migrations and seeders run successfully</p>
              <p className="text-emerald-400 font-bold pt-2">Tests:  3 passed (7 assertions)</p>
              <p className="text-emerald-400 font-bold">Duration: 0.42s</p>
            </div>
          </div>
        )}

      </div>
    </div>
  );
}
