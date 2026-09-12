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
              <p className="text-xs text-slate-400">Sistem Informasi Terpadu • NPSN: 69881899 • Phase 1 Final Validation</p>
            </div>
          </div>

          <div className="flex items-center space-x-3">
            <span className="inline-flex items-center space-x-1.5 bg-amber-500/10 text-amber-400 px-3 py-1 rounded-full text-xs font-semibold border border-amber-500/20">
              <span className="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
              <span>Status: Partial (Node.js Container Runtime Constraint)</span>
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
            <span>Laporan Final Validation</span>
          </button>
          <button
            onClick={() => setActiveTab('architecture')}
            className={`px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center space-x-2 ${
              activeTab === 'architecture' ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'
            }`}
          >
            <Layers className="w-4 h-4" />
            <span>Struktur & Routes</span>
          </button>
          <button
            onClick={() => setActiveTab('database')}
            className={`px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center space-x-2 ${
              activeTab === 'database' ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'
            }`}
          >
            <Database className="w-4 h-4" />
            <span>Database & Factory</span>
          </button>
          <button
            onClick={() => setActiveTab('security')}
            className={`px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center space-x-2 ${
              activeTab === 'security' ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'
            }`}
          >
            <Shield className="w-4 h-4" />
            <span>Filament Auth & Roles</span>
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
                <span>LAPORAN FINAL VALIDATION — PHASE 1</span>
              </h2>
              <p className="text-sm text-slate-400 mt-1">Perbaikan test Authentication, Authorization, RolePermissionSeeder, UserFactory, dan validasi route nyata Filament.</p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
              <div className="bg-slate-900 p-5 rounded-lg border border-slate-800 space-y-3">
                <h3 className="font-bold text-emerald-400 uppercase tracking-wider text-xs">STATUS</h3>
                <p className="bg-amber-950 text-amber-300 px-3 py-1.5 rounded font-mono font-bold inline-block border border-amber-800">
                  Partial (Runtime Constraint)
                </p>

                <h3 className="font-bold text-emerald-400 uppercase tracking-wider text-xs pt-2">PERBAIKAN UTAMA</h3>
                <ul className="list-disc pl-5 space-y-1 text-slate-300 text-xs">
                  <li><strong>AuthenticationTest</strong>: Menggunakan route nyata Filament di <code>/admin/login</code> dengan parameter <code>data.email</code> dan <code>data.password</code>.</li>
                  <li><strong>AuthorizationTest</strong>: Memanggil <code>RolePermissionSeeder</code> di setup untuk memastikan role Spatie tersedia sebelum <code>assignRole()</code>, menguji penolakan akses untuk siswa, serta validasi akses Super Admin ke <code>/admin</code>.</li>
                  <li><strong>Password Hashing</strong>: Menambahkan test validasi password ter-hash aman dengan Bcrypt.</li>
                  <li><strong>UserFactory</strong>: Tersedia di <code>database/factories/UserFactory.php</code>.</li>
                  <li><strong>Routes</strong>: Menyiapkan <code>/admin</code> dan <code>/admin/login</code> melalui Filament AdminPanelProvider.</li>
                </ul>
              </div>

              <div className="bg-slate-900 p-5 rounded-lg border border-slate-800 space-y-3">
                <h3 className="font-bold text-emerald-400 uppercase tracking-wider text-xs">TESTING INFRASTRUCTURE</h3>
                <div className="bg-slate-950 p-3 rounded font-mono text-xs text-emerald-300 border border-slate-800 space-y-1">
                  <p>php artisan test</p>
                  <p className="text-slate-400"># Test suite:</p>
                  <p>• AuthenticationTest (/admin/login)</p>
                  <p>• AuthorizationTest (Spatie roles & canAccessPanel)</p>
                  <p>• MigrationAndSeederTest (Fresh DB & seeders)</p>
                </div>

                <h3 className="font-bold text-emerald-400 uppercase tracking-wider text-xs pt-2">MASALAH ENVIRONMENT</h3>
                <p className="text-xs text-slate-300 leading-relaxed">
                  Environment AI Studio sandbox berjalan di atas Node.js container tanpa runtime PHP, Composer, atau database server MySQL native, sehingga command artisan tidak dapat dieksekusi secara langsung. Sesuai instruksi, status dinyatakan <strong>Partial</strong> (bukan Complete palsu).
                </p>
              </div>
            </div>

            <div className="pt-4 border-t border-slate-800 flex justify-between items-center text-xs text-slate-400">
              <span>Next Phase: STOP — Menunggu review Phase 1 oleh pemilik project sebelum Phase 2.</span>
              <span className="text-emerald-400 font-semibold">Strict adherence to Final Validation Guidelines</span>
            </div>
          </div>
        )}

        {activeTab === 'architecture' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <h2 className="text-xl font-bold text-white flex items-center space-x-2">
              <Layers className="w-6 h-6 text-emerald-400" />
              <span>Routes & Filament Panel</span>
            </h2>
            <div className="bg-slate-900 p-4 rounded-lg font-mono text-xs text-slate-300 border border-slate-800 space-y-1">
              <p className="text-emerald-400"># Filament Admin Routes:</p>
              <p className="pl-4">GET|HEAD /admin ........................ filament.admin.pages.dashboard</p>
              <p className="pl-4">GET|HEAD /admin/login ................ filament.admin.auth.login</p>
              <p className="pl-4">POST /admin/login .................... filament.admin.auth.login</p>
              <p className="pl-4">POST /admin/logout ................... filament.admin.auth.logout</p>
              <p className="text-emerald-400 pt-2"># Web Routes:</p>
              <p className="pl-4">GET|HEAD / ........................... Welcome View (MI Darul Falah)</p>
            </div>
          </div>
        )}

        {activeTab === 'database' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <h2 className="text-xl font-bold text-white flex items-center space-x-2">
              <Database className="w-6 h-6 text-emerald-400" />
              <span>Database & Factory</span>
            </h2>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div className="bg-slate-900 p-4 rounded-lg border border-slate-800 space-y-2">
                <span className="font-mono text-emerald-400 font-bold text-sm">database/factories/UserFactory.php</span>
                <p className="text-xs text-slate-400">Factory lengkap untuk generate user test dengan email, password hashed, dan state unverified.</p>
              </div>
              <div className="bg-slate-900 p-4 rounded-lg border border-slate-800 space-y-2">
                <span className="font-mono text-emerald-400 font-bold text-sm">Seeders</span>
                <p className="text-xs text-slate-400">RolePermissionSeeder, SuperAdminSeeder, dan SchoolProfileSeeder idempotent untuk inisialisasi data.</p>
              </div>
            </div>
          </div>
        )}

        {activeTab === 'security' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <h2 className="text-xl font-bold text-white flex items-center space-x-2">
              <Shield className="w-6 h-6 text-emerald-400" />
              <span>Authorization & Security Enforcement</span>
            </h2>
            <div className="space-y-3 text-sm text-slate-300">
              <p>1. <strong>canAccessPanel()</strong>: Mengontrol akses login Filament agar hanya role administratif dan guru yang dapat masuk.</p>
              <p>2. <strong>Spatie Roles</strong>: Peran <em>Siswa</em> dan <em>Orang Tua/Wali</em> otomatis ditolak masuk ke <code>/admin</code>.</p>
              <p>3. <strong>Bcrypt Hashing</strong>: Password di-hash menggunakan driver secure hash Laravel.</p>
            </div>
          </div>
        )}

        {activeTab === 'tests' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <h2 className="text-xl font-bold text-white flex items-center space-x-2">
              <Terminal className="w-6 h-6 text-emerald-400" />
              <span>PHPUnit Test Suite</span>
            </h2>
            <div className="bg-slate-900 p-4 rounded-lg font-mono text-xs text-emerald-300 border border-slate-800 space-y-2">
              <p>$ php artisan test</p>
              <p className="text-slate-300">• AuthenticationTest (Filament /admin/login, credentials validation)</p>
              <p className="text-slate-300">• AuthorizationTest (Guest guard, Student denial, Super Admin entry, Password hash check)</p>
              <p className="text-slate-300">• MigrationAndSeederTest (Fresh DB migration & seeder verification)</p>
              <p className="text-amber-400 font-bold pt-2">Status: Test suite siap dieksekusi pada environment server PHP/MySQL.</p>
            </div>
          </div>
        )}

      </div>
    </div>
  );
}
