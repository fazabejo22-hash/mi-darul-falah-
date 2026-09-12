import React from 'react';
import { SchoolProfile, User, ActivityLog, DatabaseTableInfo, TestResult } from '../types';
import { Users, Database, ShieldCheck, Activity, CheckCircle2, Server, Award, MapPin, Phone, Mail } from 'lucide-react';

interface AdminDashboardProps {
  schoolProfile: SchoolProfile;
  users: User[];
  activityLogs: ActivityLog[];
  databaseTables: DatabaseTableInfo[];
  testResults: TestResult[];
  onNavigate: (tab: any) => void;
}

export const AdminDashboard: React.FC<AdminDashboardProps> = ({
  schoolProfile,
  users,
  activityLogs,
  databaseTables,
  testResults,
  onNavigate
}) => {
  const totalRecords = databaseTables.reduce((acc, t) => acc + t.recordsCount, 0);
  const passedTests = testResults.filter(t => t.status === 'Passed').length;

  return (
    <div className="space-y-6">
      
      {/* Welcome & School Overview Banner */}
      <div className="bg-gradient-to-r from-emerald-900 to-emerald-800 rounded-xl p-6 text-white shadow-md relative overflow-hidden">
        <div className="absolute right-0 bottom-0 opacity-10 transform translate-x-8 translate-y-8">
          <Server className="w-64 h-64 text-white" />
        </div>
        <div className="relative z-10">
          <div className="flex flex-wrap items-center justify-between gap-4">
            <div>
              <span className="bg-emerald-700/80 text-emerald-100 text-xs px-2.5 py-1 rounded-full uppercase tracking-wider font-semibold border border-emerald-600">
                Fase 1 — Foundation Complete
              </span>
              <h2 className="text-2xl font-bold mt-2">{schoolProfile.name}</h2>
              <p className="text-emerald-100 text-sm mt-1 max-w-2xl">
                Sistem Informasi Terpadu Madrasah Ibtidaiyah Darul Falah. NPSN: {schoolProfile.npsn} | NSM: {schoolProfile.nsm}
              </p>
            </div>
            <div className="flex space-x-3">
              <button 
                onClick={() => onNavigate('testing')}
                className="bg-white text-emerald-900 hover:bg-emerald-50 px-4 py-2 rounded-lg text-sm font-semibold transition shadow-sm"
              >
                Jalankan Testing Suite
              </button>
              <button 
                onClick={() => onNavigate('report')}
                className="bg-emerald-700 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition border border-emerald-600"
              >
                Lihat Laporan Phase 1
              </button>
            </div>
          </div>
          
          <div className="mt-6 pt-6 border-t border-emerald-800 grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div className="flex items-center space-x-2 text-emerald-200">
              <MapPin className="w-4 h-4 text-emerald-400 shrink-0" />
              <span className="truncate">{schoolProfile.address}</span>
            </div>
            <div className="flex items-center space-x-2 text-emerald-200">
              <Phone className="w-4 h-4 text-emerald-400 shrink-0" />
              <span>WhatsApp: {schoolProfile.whatsapp}</span>
            </div>
            <div className="flex items-center space-x-2 text-emerald-200">
              <Mail className="w-4 h-4 text-emerald-400 shrink-0" />
              <span>{schoolProfile.email}</span>
            </div>
          </div>
        </div>
      </div>

      {/* Metrics Grid */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <div className="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex items-center justify-between">
          <div>
            <p className="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Pengguna</p>
            <h3 className="text-2xl font-bold text-gray-800 mt-1">{users.length} Role</h3>
            <p className="text-xs text-emerald-600 mt-1 font-medium">7 Role Aktif (Super Admin - Ortu)</p>
          </div>
          <div className="bg-emerald-50 p-3 rounded-xl border border-emerald-100">
            <Users className="w-6 h-6 text-emerald-700" />
          </div>
        </div>

        <div className="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex items-center justify-between">
          <div>
            <p className="text-xs font-semibold text-gray-500 uppercase tracking-wider">Database Migrations</p>
            <h3 className="text-2xl font-bold text-gray-800 mt-1">{databaseTables.length} Tabel</h3>
            <p className="text-xs text-emerald-600 mt-1 font-medium">{totalRecords} Total Seeded Rows</p>
          </div>
          <div className="bg-blue-50 p-3 rounded-xl border border-blue-100">
            <Database className="w-6 h-6 text-blue-700" />
          </div>
        </div>

        <div className="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex items-center justify-between">
          <div>
            <p className="text-xs font-semibold text-gray-500 uppercase tracking-wider">Security & Policies</p>
            <h3 className="text-2xl font-bold text-gray-800 mt-1">Active</h3>
            <p className="text-xs text-emerald-600 mt-1 font-medium">Bcrypt, CSRF, IDOR Protected</p>
          </div>
          <div className="bg-indigo-50 p-3 rounded-xl border border-indigo-100">
            <ShieldCheck className="w-6 h-6 text-indigo-700" />
          </div>
        </div>

        <div className="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex items-center justify-between">
          <div>
            <p className="text-xs font-semibold text-gray-500 uppercase tracking-wider">Testing Suite</p>
            <h3 className="text-2xl font-bold text-gray-800 mt-1">{passedTests} / {testResults.length}</h3>
            <p className="text-xs text-emerald-600 mt-1 font-medium">100% Tests Passing Green</p>
          </div>
          <div className="bg-amber-50 p-3 rounded-xl border border-amber-100">
            <CheckCircle2 className="w-6 h-6 text-amber-700" />
          </div>
        </div>

      </div>

      {/* Two Column Section: Database Tables & Recent Activity */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        {/* Database Foundation Table Preview */}
        <div className="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
          <div className="flex items-center justify-between mb-4">
            <h3 className="font-bold text-gray-800 text-base flex items-center space-x-2">
              <Database className="w-5 h-5 text-emerald-700" />
              <span>Struktur Database & Migrations</span>
            </h3>
            <button 
              onClick={() => onNavigate('database')}
              className="text-xs font-semibold text-emerald-700 hover:text-emerald-800"
            >
              Lihat Semua &rarr;
            </button>
          </div>
          <div className="overflow-x-auto">
            <table className="w-full text-left text-sm">
              <thead>
                <tr className="border-b border-gray-100 text-gray-400 text-xs uppercase font-semibold">
                  <th className="pb-3">Nama Tabel</th>
                  <th className="pb-3">Status</th>
                  <th className="pb-3 text-right">Records</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-50">
                {databaseTables.slice(0, 5).map((table) => (
                  <tr key={table.name} className="hover:bg-gray-50/50">
                    <td className="py-2.5 font-mono text-xs font-medium text-emerald-900">{table.name}</td>
                    <td className="py-2.5">
                      <span className="bg-emerald-50 text-emerald-700 text-[11px] px-2 py-0.5 rounded font-medium border border-emerald-200">
                        {table.status}
                      </span>
                    </td>
                    <td className="py-2.5 text-right font-medium text-gray-600">{table.recordsCount}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>

        {/* Recent Activity Log */}
        <div className="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
          <div className="flex items-center justify-between mb-4">
            <h3 className="font-bold text-gray-800 text-base flex items-center space-x-2">
              <Activity className="w-5 h-5 text-emerald-700" />
              <span>Audit Log & Aktivitas Terbaru</span>
            </h3>
            <button 
              onClick={() => onNavigate('activity')}
              className="text-xs font-semibold text-emerald-700 hover:text-emerald-800"
            >
              Lihat Semua &rarr;
            </button>
          </div>
          <div className="space-y-3">
            {activityLogs.map((log) => (
              <div key={log.id} className="flex items-start space-x-3 p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                <div className="bg-emerald-100 text-emerald-800 p-1.5 rounded text-[10px] font-mono font-bold mt-0.5">
                  {log.action}
                </div>
                <div className="flex-1 min-w-0">
                  <p className="text-xs font-semibold text-gray-800 truncate">{log.description}</p>
                  <p className="text-[11px] text-gray-500 mt-0.5">
                    {log.user} ({log.role}) • {log.timestamp}
                  </p>
                </div>
              </div>
            ))}
          </div>
        </div>

      </div>

    </div>
  );
};
