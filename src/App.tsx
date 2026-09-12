import React, { useState } from 'react';
import { Terminal, Database, Shield, CheckCircle2, Server, FileCode, Layers, AlertCircle } from 'lucide-react';

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
            <span className="inline-flex items-center space-x-1.5 bg-red-500/10 text-red-400 px-3 py-1 rounded-full text-xs font-semibold border border-red-500/20">
              <span className="w-2 h-2 rounded-full bg-red-400 animate-pulse"></span>
              <span>Status: BLOCKED (PHP Runtime Not Available in Node Container)</span>
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
            <AlertCircle className="w-4 h-4 text-amber-400" />
            <span>Status: BLOCKED</span>
          </button>
          <button
            onClick={() => setActiveTab('architecture')}
            className={`px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center space-x-2 ${
              activeTab === 'architecture' ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'
            }`}
          >
            <Layers className="w-4 h-4" />
            <span>Filament Livewire Test</span>
          </button>
        </div>

        {/* Content Area */}
        {activeTab === 'status' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <div className="border-b border-slate-800 pb-4">
              <h2 className="text-xl font-bold text-white flex items-center space-x-2">
                <AlertCircle className="w-6 h-6 text-red-400" />
                <span>STATUS: BLOCKED (PHP/Composer Environment Constraint)</span>
              </h2>
              <p className="text-sm text-slate-400 mt-1">AuthenticationTest.php telah diperbarui menggunakan Livewire testing API Filament 3 (`Filament\Pages\Auth\Login::class`) dan RolePermissionSeeder.</p>
            </div>

            <div className="bg-slate-900 p-5 rounded-lg border border-slate-800 space-y-3 text-sm">
              <h3 className="font-bold text-red-400 uppercase tracking-wider text-xs">ALASAN BLOCKED</h3>
              <p className="text-slate-300 leading-relaxed">
                Sesuai instruksi: <em>"Jika environment tidak dapat menjalankan PHP/Composer, tulis BLOCKED, jangan mengklaim PASS."</em><br/>
                Environment AI Studio saat ini berjalan di dalam container Node.js terisolasi yang tidak memiliki runtime PHP, Composer, PHPUnit, maupun MySQL server native terpasang. Oleh karena itu, command <code>composer install</code>, <code>php artisan</code>, dan <code>php artisan test</code> tidak dapat dijalankan secara aktual di lingkungan ini.
              </p>
              <div className="bg-slate-950 p-4 rounded font-mono text-xs text-amber-300 border border-slate-800 space-y-1">
                <p># Code implementation completed & verified statically:</p>
                <p>• AuthenticationTest.php menggunakan Livewire::test(\Filament\Pages\Auth\Login::class)</p>
                <p>• RolePermissionSeeder seeded before assignRole('Super Admin')</p>
                <p>• canAccessPanel() enforced correctly</p>
              </div>
            </div>
          </div>
        )}

      </div>
    </div>
  );
}
