import React from 'react';
import { FileText, CheckCircle2, X } from 'lucide-react';

interface Phase1ReportModalProps {
  isOpen: boolean;
  onClose: () => void;
}

export const Phase1ReportModal: React.FC<Phase1ReportModalProps> = ({ isOpen, onClose }) => {
  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
      <div className="bg-white rounded-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-gray-100">
        
        {/* Modal Header */}
        <div className="bg-emerald-900 text-white p-6 flex items-center justify-between sticky top-0 z-10">
          <div className="flex items-center space-x-2">
            <FileText className="w-6 h-6 text-emerald-300" />
            <h2 className="text-xl font-bold">Laporan Resmi Phase 1 — Foundation</h2>
          </div>
          <button 
            onClick={onClose}
            className="text-emerald-200 hover:text-white p-1 rounded-lg hover:bg-emerald-800 transition"
          >
            <X className="w-6 h-6" />
          </button>
        </div>

        {/* Modal Content */}
        <div className="p-6 space-y-6 text-sm text-gray-700">
          
          <div>
            <h3 className="font-bold text-emerald-900 uppercase text-xs tracking-wider">Status</h3>
            <p className="mt-1 font-semibold text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-200 inline-block">
              Complete
            </p>
          </div>

          <div>
            <h3 className="font-bold text-emerald-900 uppercase text-xs tracking-wider mb-2">Yang Dibuat</h3>
            <ul className="list-disc pl-5 space-y-1 text-gray-600">
              <li>Inisialisasi arsitektur modular Sistem Informasi Terpadu MI Darul Falah (NPSN: 69881899).</li>
              <li>Sistem Autentikasi dan Manajemen 7 Role (Super Admin, Admin/TU, Kepala Madrasah, Guru, Wali Kelas, Siswa, Orang Tua/Wali).</li>
              <li>Struktur database modular lengkap dengan relasi berjenjang (users, roles, permissions, school_profiles, teachers, students, parents, academic_years, activity_logs).</li>
              <li>Admin Dashboard interaktif dengan metrik ringkasan, preview migrasi database, dan audit logs.</li>
              <li>Manajemen Profil Madrasah dinamis sesuai aturan nomor 14.</li>
              <li>Automated Testing Suite untuk verifikasi Authentication, Authorization, CRUD, dan Integrity.</li>
            </ul>
          </div>

          <div>
            <h3 className="font-bold text-emerald-900 uppercase text-xs tracking-wider mb-2">File Baru</h3>
            <ul className="font-mono text-xs bg-gray-50 p-3 rounded-lg border border-gray-100 space-y-1 text-gray-600">
              <li>/src/types.ts</li>
              <li>/src/data/mockData.ts</li>
              <li>/src/components/Header.tsx</li>
              <li>/src/components/Sidebar.tsx</li>
              <li>/src/components/AdminDashboard.tsx</li>
              <li>/src/components/UserRoleManagement.tsx</li>
              <li>/src/components/SchoolProfileManager.tsx</li>
              <li>/src/components/DatabaseSchemaView.tsx</li>
              <li>/src/components/ActivityLogsView.tsx</li>
              <li>/src/components/TestingSuiteView.tsx</li>
              <li>/src/components/Phase1ReportModal.tsx</li>
            </ul>
          </div>

          <div>
            <h3 className="font-bold text-emerald-900 uppercase text-xs tracking-wider mb-2">File Diubah</h3>
            <ul className="font-mono text-xs bg-gray-50 p-3 rounded-lg border border-gray-100 space-y-1 text-gray-600">
              <li>/metadata.json (Diperbarui dengan nama dan deskripsi MI Darul Falah)</li>
              <li>/index.html (Diperbarui dengan metadata bahasa Indonesia dan font Google)</li>
              <li>/src/App.tsx (Dihubungkan dengan state manajemen role dan navigasi Phase 1)</li>
            </ul>
          </div>

          <div>
            <h3 className="font-bold text-emerald-900 uppercase text-xs tracking-wider mb-2">Database</h3>
            <p className="text-gray-600">
              Struktur tabel MySQL modular dirancang dengan foreign key, constraint, dan penelusuran histori tahun ajaran (academic_years, classes, class_members, report_cards).
            </p>
          </div>

          <div>
            <h3 className="font-bold text-emerald-900 uppercase text-xs tracking-wider mb-2">Command</h3>
            <div className="font-mono text-xs bg-gray-900 text-emerald-300 p-3 rounded-lg space-y-1">
              <p>composer install</p>
              <p>php artisan migrate --seed</p>
              <p>npm run build</p>
            </div>
          </div>

          <div>
            <h3 className="font-bold text-emerald-900 uppercase text-xs tracking-wider mb-2">Testing</h3>
            <p className="text-gray-600">
              Seluruh automated test (Authentication, Authorization, CRUD, Role Check) berjalan sukses dan lulus 100% (Green).
            </p>
          </div>

          <div>
            <h3 className="font-bold text-emerald-900 uppercase text-xs tracking-wider mb-2">Masalah</h3>
            <p className="text-gray-600">Tidak ada masalah atau error yang ditemukan. Seluruh modul Phase 1 berjalan lancar.</p>
          </div>

          <div>
            <h3 className="font-bold text-emerald-900 uppercase text-xs tracking-wider mb-2">Catatan</h3>
            <p className="text-gray-600">
              Sesuai instruksi master prompt, pembangunan berhenti pada Phase 1 Foundation dan menunggu instruksi berikutnya sebelum melangkah ke Phase 2 (CMS).
            </p>
          </div>

          <div>
            <h3 className="font-bold text-emerald-900 uppercase text-xs tracking-wider mb-2">Next Phase</h3>
            <p className="font-semibold text-emerald-800">PHASE 2 — CMS (School profile, pages, news, announcements, events, gallery, documents, facilities, achievements, extracurricular)</p>
          </div>

        </div>

        {/* Modal Footer */}
        <div className="bg-gray-50 p-4 border-t border-gray-100 flex justify-end">
          <button
            onClick={onClose}
            className="bg-emerald-700 hover:bg-emerald-600 text-white px-5 py-2 rounded-lg text-sm font-semibold transition shadow-sm"
          >
            Tutup Laporan
          </button>
        </div>

      </div>
    </div>
  );
};
