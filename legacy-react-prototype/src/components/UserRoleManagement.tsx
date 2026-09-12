import React, { useState } from 'react';
import { User, RolePermission, UserRole } from '../types';
import { Users, Shield, Lock, CheckCircle2, UserPlus, Search } from 'lucide-react';

interface UserRoleManagementProps {
  users: User[];
  rolePermissions: RolePermission[];
}

export const UserRoleManagement: React.FC<UserRoleManagementProps> = ({ users, rolePermissions }) => {
  const [activeSubTab, setActiveSubTab] = useState<'users' | 'roles'>('users');
  const [searchTerm, setSearchTerm] = useState('');

  const filteredUsers = users.filter(u => 
    u.name.toLowerCase().includes(searchTerm.toLowerCase()) || 
    u.email.toLowerCase().includes(searchTerm.toLowerCase()) ||
    u.role.toLowerCase().includes(searchTerm.toLowerCase())
  );

  return (
    <div className="space-y-6">
      
      {/* Header & Sub-tabs */}
      <div className="flex flex-wrap items-center justify-between gap-4 bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
        <div>
          <h2 className="text-xl font-bold text-gray-800 flex items-center space-x-2">
            <Users className="w-6 h-6 text-emerald-700" />
            <span>Manajemen Pengguna & Role</span>
          </h2>
          <p className="text-sm text-gray-500 mt-1">
            Sistem role berjenjang (Super Admin, Admin/TU, Kepala Madrasah, Guru, Wali Kelas, Siswa, Orang Tua)
          </p>
        </div>
        <div className="flex space-x-2 bg-gray-100 p-1 rounded-lg">
          <button
            onClick={() => setActiveSubTab('users')}
            className={`px-4 py-2 rounded-md text-xs font-semibold transition ${
              activeSubTab === 'users' ? 'bg-white text-emerald-900 shadow-sm' : 'text-gray-600 hover:text-gray-900'
            }`}
          >
            Daftar Pengguna ({users.length})
          </button>
          <button
            onClick={() => setActiveSubTab('roles')}
            className={`px-4 py-2 rounded-md text-xs font-semibold transition ${
              activeSubTab === 'roles' ? 'bg-white text-emerald-900 shadow-sm' : 'text-gray-600 hover:text-gray-900'
            }`}
          >
            Role & Permission Matrix
          </button>
        </div>
      </div>

      {activeSubTab === 'users' ? (
        <div className="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
          <div className="p-4 border-b border-gray-100 flex items-center justify-between">
            <div className="relative w-72">
              <Search className="w-4 h-4 text-gray-400 absolute left-3 top-3" />
              <input
                type="text"
                placeholder="Cari pengguna atau role..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-emerald-500"
              />
            </div>
            <button className="bg-emerald-700 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-xs font-semibold transition flex items-center space-x-1.5">
              <UserPlus className="w-4 h-4" />
              <span>Tambah Pengguna Baru</span>
            </button>
          </div>

          <div className="overflow-x-auto">
            <table className="w-full text-left text-sm">
              <thead>
                <tr className="bg-gray-50 text-gray-500 text-xs uppercase font-semibold border-b border-gray-100">
                  <th className="px-6 py-3">Nama & Email</th>
                  <th className="px-6 py-3">Role</th>
                  <th className="px-6 py-3">No. WhatsApp</th>
                  <th className="px-6 py-3">Status</th>
                  <th className="px-6 py-3">Login Terakhir</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-100">
                {filteredUsers.map((user) => (
                  <tr key={user.id} className="hover:bg-gray-50/50">
                    <td className="px-6 py-4">
                      <div className="font-semibold text-gray-800">{user.name}</div>
                      <div className="text-xs text-gray-500">{user.email}</div>
                    </td>
                    <td className="px-6 py-4">
                      <span className="bg-emerald-50 text-emerald-800 text-xs px-2.5 py-1 rounded-full font-semibold border border-emerald-200">
                        {user.role}
                      </span>
                    </td>
                    <td className="px-6 py-4 text-gray-600 font-mono text-xs">{user.phone || '-'}</td>
                    <td className="px-6 py-4">
                      <span className="inline-flex items-center space-x-1 text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded text-xs font-medium">
                        <CheckCircle2 className="w-3.5 h-3.5" />
                        <span>Aktif</span>
                      </span>
                    </td>
                    <td className="px-6 py-4 text-gray-500 text-xs">{user.lastLogin || '-'}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          {rolePermissions.map((rp) => (
            <div key={rp.id} className="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
              <div className="flex items-center space-x-2 pb-3 border-b border-gray-100">
                <Shield className="w-5 h-5 text-emerald-700" />
                <h3 className="font-bold text-gray-800">{rp.role}</h3>
              </div>
              <div className="mt-4 space-y-2">
                <p className="text-xs font-semibold text-gray-400 uppercase">Assigned Permissions:</p>
                <div className="flex flex-wrap gap-1.5">
                  {rp.permissions.map((perm, idx) => (
                    <span key={idx} className="bg-emerald-50 text-emerald-900 text-xs px-2 py-1 rounded font-mono border border-emerald-200">
                      {perm}
                    </span>
                  ))}
                </div>
              </div>
            </div>
          ))}
        </div>
      )}

    </div>
  );
};
