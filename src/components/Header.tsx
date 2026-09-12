import React from 'react';
import { User, UserRole } from '../types';
import { Shield, School, UserCheck, ChevronDown, CheckCircle2 } from 'lucide-react';

interface HeaderProps {
  currentUser: User;
  onSelectRole: (role: UserRole) => void;
  onOpenReport: () => void;
}

export const Header: React.FC<HeaderProps> = ({ currentUser, onSelectRole, onOpenReport }) => {
  const [dropdownOpen, setDropdownOpen] = React.useState(false);

  const roles: UserRole[] = [
    'Super Admin',
    'Admin/TU',
    'Kepala Madrasah',
    'Guru',
    'Wali Kelas',
    'Siswa',
    'Orang Tua/Wali'
  ];

  return (
    <header className="bg-emerald-900 text-white shadow-md sticky top-0 z-40">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        
        {/* School Branding */}
        <div className="flex items-center space-x-3">
          <div className="bg-emerald-800 p-2 rounded-lg border border-emerald-700 shadow-inner flex items-center justify-center">
            <School className="w-6 h-6 text-emerald-300" />
          </div>
          <div>
            <div className="flex items-center space-x-2">
              <h1 className="font-bold text-lg tracking-wide text-white">MI Darul Falah</h1>
              <span className="bg-emerald-700/80 text-emerald-100 text-xs px-2 py-0.5 rounded-full font-medium border border-emerald-600">
                NPSN: 69881899
              </span>
            </div>
            <p className="text-xs text-emerald-200 hidden sm:block">Sistem Informasi Terpadu Madrasah Ibtidaiyah • Sidoarjo</p>
          </div>
        </div>

        {/* Phase 1 Badge & Role Switcher */}
        <div className="flex items-center space-x-4">
          <button 
            onClick={onOpenReport}
            className="hidden md:flex items-center space-x-1.5 bg-emerald-800 hover:bg-emerald-700 text-emerald-100 px-3 py-1.5 rounded-md text-xs font-medium transition border border-emerald-600 shadow-sm"
          >
            <CheckCircle2 className="w-4 h-4 text-emerald-400" />
            <span>Phase 1 Report</span>
          </button>

          <div className="relative">
            <button
              onClick={() => setDropdownOpen(!dropdownOpen)}
              className="flex items-center space-x-2 bg-emerald-800 hover:bg-emerald-700 px-3 py-2 rounded-lg text-sm font-medium transition border border-emerald-700"
            >
              <Shield className="w-4 h-4 text-emerald-300" />
              <div className="text-left hidden sm:block">
                <div className="text-xs text-emerald-300">Active Role:</div>
                <div className="font-semibold text-white">{currentUser.role}</div>
              </div>
              <ChevronDown className="w-4 h-4 text-emerald-300" />
            </button>

            {dropdownOpen && (
              <div className="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-2 z-50 text-gray-800 border border-gray-100">
                <div className="px-4 py-2 border-b border-gray-100">
                  <p className="text-xs text-gray-500">Switch Simulated User Role:</p>
                  <p className="font-semibold text-sm text-emerald-900">{currentUser.name}</p>
                </div>
                <div className="max-h-64 overflow-y-auto">
                  {roles.map((r) => (
                    <button
                      key={r}
                      onClick={() => {
                        onSelectRole(r);
                        setDropdownOpen(false);
                      }}
                      className={`w-full text-left px-4 py-2 text-sm flex items-center justify-between hover:bg-emerald-50 transition ${
                        currentUser.role === r ? 'bg-emerald-100/70 text-emerald-900 font-semibold' : 'text-gray-700'
                      }`}
                    >
                      <span>{r}</span>
                      {currentUser.role === r && <UserCheck className="w-4 h-4 text-emerald-700" />}
                    </button>
                  ))}
                </div>
              </div>
            )}
          </div>

        </div>

      </div>
    </header>
  );
};
