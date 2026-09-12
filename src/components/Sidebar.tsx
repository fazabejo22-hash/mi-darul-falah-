import React from 'react';
import { LayoutDashboard, Users, Shield, Database, Activity, CheckSquare, FileText, Settings, School } from 'lucide-react';

export type ActiveTab = 
  | 'dashboard' 
  | 'users' 
  | 'roles' 
  | 'profile' 
  | 'database' 
  | 'activity' 
  | 'testing' 
  | 'report';

interface SidebarProps {
  activeTab: ActiveTab;
  setActiveTab: (tab: ActiveTab) => void;
}

export const Sidebar: React.FC<SidebarProps> = ({ activeTab, setActiveTab }) => {
  const menuItems = [
    { id: 'dashboard', label: 'Admin Dashboard', icon: LayoutDashboard },
    { id: 'users', label: 'Pengguna & Role', icon: Users },
    { id: 'profile', label: 'Profil Madrasah', icon: School },
    { id: 'database', label: 'Database & Migration', icon: Database },
    { id: 'activity', label: 'Activity Logs', icon: Activity },
    { id: 'testing', label: 'Testing Suite', icon: CheckSquare },
    { id: 'report', label: 'Laporan Phase 1', icon: FileText },
  ];

  return (
    <aside className="w-full md:w-64 bg-white border-r border-gray-200 flex flex-col shrink-0">
      <div className="p-4 border-b border-gray-100 hidden md:block">
        <span className="text-xs uppercase tracking-wider text-gray-400 font-semibold">Navigasi Utama</span>
      </div>
      <nav className="p-2 space-y-1 flex flex-row md:flex-col overflow-x-auto md:overflow-x-visible">
        {menuItems.map((item) => {
          const Icon = item.icon;
          const isActive = activeTab === item.id;
          return (
            <button
              key={item.id}
              onClick={() => setActiveTab(item.id as ActiveTab)}
              className={`flex items-center space-x-3 w-full px-3 py-2.5 rounded-lg text-sm font-medium transition whitespace-nowrap ${
                isActive 
                  ? 'bg-emerald-50 text-emerald-900 border-l-4 border-emerald-700 font-semibold' 
                  : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
              }`}
            >
              <Icon className={`w-5 h-5 ${isActive ? 'text-emerald-700' : 'text-gray-400'}`} />
              <span>{item.label}</span>
            </button>
          );
        })}
      </nav>

      <div className="mt-auto p-4 border-t border-gray-100 hidden md:block">
        <div className="bg-emerald-50/70 p-3 rounded-lg border border-emerald-100">
          <p className="text-xs font-medium text-emerald-900">Phase 1 Foundation</p>
          <p className="text-[11px] text-emerald-700 mt-0.5">Laravel 11 + Filament Ready Architecture</p>
        </div>
      </div>
    </aside>
  );
};
