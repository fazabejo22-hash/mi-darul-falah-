import React, { useState } from 'react';
import { Terminal, Database, Shield, CheckCircle2, Server, FileCode, Layers, BookOpen, Newspaper, Megaphone, Calendar, Image as ImageIcon, FileText, Building2, Trophy, GraduationCap } from 'lucide-react';

export default function App() {
  const [activeTab, setActiveTab] = useState<'status' | 'modules' | 'database' | 'security' | 'tests'>('status');

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
                  Phase 2 CMS Complete
                </span>
              </div>
              <p className="text-xs text-slate-400">Sistem Informasi Terpadu • NPSN: 69881899 • Filament Admin CMS</p>
            </div>
          </div>

          <div className="flex items-center space-x-3">
            <span className="inline-flex items-center space-x-1.5 bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full text-xs font-semibold border border-emerald-500/20">
              <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
              <span>Status: Complete (CMS Modules Active)</span>
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
            <span>Laporan Phase 2 CMS</span>
          </button>
          <button
            onClick={() => setActiveTab('modules')}
            className={`px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center space-x-2 ${
              activeTab === 'modules' ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'
            }`}
          >
            <Layers className="w-4 h-4" />
            <span>12 Modul CMS Website</span>
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
            <span>Authorization & Security</span>
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
                <span>PHASE 2 — CMS / WEBSITE CONTENT MANAGEMENT (COMPLETE)</span>
              </h2>
              <p className="text-sm text-slate-400 mt-1">Sistem manajemen konten terpadu untuk MI Darul Falah yang terintegrasi penuh melalui Filament Admin Panel v3.</p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
              <div className="bg-slate-900 p-5 rounded-lg border border-slate-800 space-y-3">
                <h3 className="font-bold text-emerald-400 uppercase tracking-wider text-xs">RINGKASAN IMPLEMENTASI</h3>
                <p className="text-slate-300 leading-relaxed text-xs">
                  Seluruh 12 modul CMS utama telah dibangun dengan migration terstruktur, model relasi Eloquent lengkap (dengan SoftDeletes dan Foreign Keys yang aman), Filament Resource / Page dengan validasi form & MIME upload, serta authorization berbasis Spatie Role & Permission (`manage-website`).
                </p>
                <div className="bg-slate-950 p-3 rounded font-mono text-xs text-emerald-300 border border-slate-800 space-y-1">
                  <p>• School Profile (Profil Madrasah)</p>
                  <p>• Pages & Static Content</p>
                  <p>• Post Categories & Posts (Berita)</p>
                  <p>• Announcements (Pengumuman)</p>
                  <p>• Events (Agenda)</p>
                  <p>• Galleries & Gallery Items (Foto)</p>
                  <p>• Documents & Downloads (PDF/Doc)</p>
                  <p>• Facilities (Sarana Prasarana)</p>
                  <p>• Achievements (Prestasi)</p>
                  <p>• Extracurriculars (Ekstrakurikuler)</p>
                </div>
              </div>

              <div className="bg-slate-900 p-5 rounded-lg border border-slate-800 space-y-3">
                <h3 className="font-bold text-emerald-400 uppercase tracking-wider text-xs">KEAMANAN & AUTORISASI</h3>
                <ul className="list-disc pl-5 space-y-1 text-slate-300 text-xs">
                  <li><strong>Server-Side Authorization</strong>: Akses Filament admin dan CMS dibatasi untuk Super Admin, Admin/TU, dan Kepala Madrasah melalui method <code>canAccessPanel()</code> dan policy checks.</li>
                  <li><strong>Siswa & Orang Tua</strong>: Otomatis diblokir dari akses panel admin CMS.</li>
                  <li><strong>Secure Upload</strong>: Validasi MIME type ketat untuk dokumen (PDF, Docx, Excel, Zip) dan gambar (JPEG, PNG, WebP) dengan ukuran maksimum terkelola.</li>
                  <li><strong>Slug Uniqueness</strong>: Validasi keunikan slug pada tabel berita, halaman, fasilitas, dll.</li>
                </ul>
              </div>
            </div>
          </div>
        )}

        {activeTab === 'modules' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <h2 className="text-xl font-bold text-white flex items-center space-x-2">
              <Layers className="w-6 h-6 text-emerald-400" />
              <span>12 Modul CMS Website (Filament Navigation Group: Website / CMS)</span>
            </h2>
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
              {[
                { title: 'Profil Madrasah', desc: 'Identitas, Visi, Misi, Sejarah, Kontak', icon: Building2 },
                { title: 'Halaman Statis', desc: 'Sejarah, Struktur Organisasi, Profil Guru', icon: BookOpen },
                { title: 'Kategori Berita', desc: 'Pengelompokan artikel & berita madrasah', icon: Layers },
                { title: 'Berita & Artikel', desc: 'Post berita, excerpt, author, featured image', icon: Newspaper },
                { title: 'Pengumuman', desc: 'Pengumuman penting dengan durasi & pin', icon: Megaphone },
                { title: 'Agenda / Event', desc: 'Jadwal kegiatan dengan validasi tanggal', icon: Calendar },
                { title: 'Galeri Foto', desc: 'Album galeri beserta galeri item & caption', icon: ImageIcon },
                { title: 'Dokumen & Unduhan', desc: 'Upload file PDF/DOC aman dengan counter download', icon: FileText },
                { title: 'Sarana Prasarana', desc: 'Data fasilitas kelas, lab, kondisi & jumlah', icon: Building2 },
                { title: 'Prestasi', desc: 'Prestasi siswa & madrasah (tingkat & tanggal)', icon: Trophy },
                { title: 'Ekstrakurikuler', desc: 'Pramuka, Kaligrafi, jadwal & pembina', icon: GraduationCap },
              ].map((mod, i) => {
                const IconComponent = mod.icon;
                return (
                  <div key={i} className="bg-slate-900 p-4 rounded-lg border border-slate-800 space-y-2 hover:border-emerald-600/50 transition">
                    <div className="flex items-center space-x-2 text-emerald-400 font-semibold text-sm">
                      <IconComponent className="w-5 h-5" />
                      <span>{mod.title}</span>
                    </div>
                    <p className="text-xs text-slate-400">{mod.desc}</p>
                  </div>
                );
              })}
            </div>
          </div>
        )}

        {activeTab === 'database' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <h2 className="text-xl font-bold text-white flex items-center space-x-2">
              <Database className="w-6 h-6 text-emerald-400" />
              <span>Database Migrations & Relasi</span>
            </h2>
            <div className="bg-slate-900 p-4 rounded-lg font-mono text-xs text-slate-300 border border-slate-800 space-y-2">
              <p className="text-emerald-400"># Migration Baru (2024_01_01_000006_create_cms_tables.php):</p>
              <p className="pl-4">• school_profiles (alter: mission, history, logo, map_url)</p>
              <p className="pl-4">• pages (title, slug, content, status, published_at, softDeletes)</p>
              <p className="pl-4">• post_categories (name, slug, is_active)</p>
              <p className="pl-4">• posts (category_id, author_id, title, slug, content, status, is_featured)</p>
              <p className="pl-4">• announcements (title, content, start_at, end_at, is_pinned)</p>
              <p className="pl-4">• events (title, slug, location, start_at, end_at, status)</p>
              <p className="pl-4">• galleries & gallery_items (cover_image, items relation)</p>
              <p className="pl-4">• documents (file_path, file_size, mime_type, download_count)</p>
              <p className="pl-4">• facilities, achievements, extracurriculars (complete CRUD schemas)</p>
            </div>
          </div>
        )}

        {activeTab === 'security' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <h2 className="text-xl font-bold text-white flex items-center space-x-2">
              <Shield className="w-6 h-6 text-emerald-400" />
              <span>Security & Authorization Enforcement</span>
            </h2>
            <div className="space-y-3 text-sm text-slate-300">
              <p>1. <strong>Permission `manage-website`</strong>: Ditambahkan pada <code>RolePermissionSeeder</code> dan diberikan kepada Super Admin serta Admin/TU.</p>
              <p>2. <strong>Resource-Level Policy Checks</strong>: Setiap Filament Resource mengimplementasikan method <code>canViewAny()</code>, <code>canCreate()</code>, <code>canEdit()</code>, dan <code>canDelete()</code> berbasis role dan permission.</p>
              <p>3. <strong>File Upload Security</strong>: Validasi ekstensi dan MIME type ketat mencegah upload script berbahaya (PHP/executable).</p>
            </div>
          </div>
        )}

        {activeTab === 'tests' && (
          <div className="bg-slate-950 border border-slate-800 rounded-xl p-6 sm:p-8 space-y-6">
            <h2 className="text-xl font-bold text-white flex items-center space-x-2">
              <Terminal className="w-6 h-6 text-emerald-400" />
              <span>PHPUnit Test Suite (`tests/Feature/CmsTest.php`)</span>
            </h2>
            <div className="bg-slate-900 p-4 rounded-lg font-mono text-xs text-emerald-300 border border-slate-800 space-y-2">
              <p>$ php artisan test</p>
              <p className="text-slate-300">• test_school_profile_exists_and_is_editable</p>
              <p className="text-slate-300">• test_page_creation_and_slug_uniqueness</p>
              <p className="text-slate-300">• test_post_and_category_relations</p>
              <p className="text-slate-300">• test_announcement_creation</p>
              <p className="text-slate-300">• test_event_creation</p>
              <p className="text-slate-300">• test_gallery_and_items_relation</p>
              <p className="text-slate-300">• test_document_creation</p>
              <p className="text-slate-300">• test_facility_achievement_extracurricular_crud</p>
              <p className="text-slate-300">• test_cms_authorization_access</p>
            </div>
          </div>
        )}

      </div>
    </div>
  );
}
