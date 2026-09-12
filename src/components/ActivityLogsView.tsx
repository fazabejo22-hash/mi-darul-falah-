import React from 'react';
import { ActivityLog } from '../types';
import { Activity, ShieldAlert, Search } from 'lucide-react';

interface ActivityLogsViewProps {
  activityLogs: ActivityLog[];
}

export const ActivityLogsView: React.FC<ActivityLogsViewProps> = ({ activityLogs }) => {
  return (
    <div className="space-y-6">
      
      <div className="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
          <h2 className="text-xl font-bold text-gray-800 flex items-center space-x-2">
            <Activity className="w-6 h-6 text-emerald-700" />
            <span>Activity Logs & Audit Trail</span>
          </h2>
          <p className="text-sm text-gray-500 mt-1">
            Pencatatan aktivitas sistem, login, perubahan data penting, dan keamanan secara real-time.
          </p>
        </div>
        <div className="bg-emerald-50 text-emerald-800 px-3 py-1.5 rounded-lg text-xs font-semibold border border-emerald-200">
          Security Mode: Strict Audit
        </div>
      </div>

      <div className="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full text-left text-sm">
            <thead>
              <tr className="bg-gray-50 text-gray-500 text-xs uppercase font-semibold border-b border-gray-100">
                <th className="px-6 py-3">Timestamp</th>
                <th className="px-6 py-3">Aksi</th>
                <th className="px-6 py-3">Pengguna</th>
                <th className="px-6 py-3">Role</th>
                <th className="px-6 py-3">Deskripsi</th>
                <th className="px-6 py-3">IP Address</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-100">
              {activityLogs.map((log) => (
                <tr key={log.id} className="hover:bg-gray-50/50">
                  <td className="px-6 py-4 font-mono text-xs text-gray-500">{log.timestamp}</td>
                  <td className="px-6 py-4">
                    <span className="bg-emerald-50 text-emerald-800 font-mono text-[11px] px-2.5 py-1 rounded font-semibold border border-emerald-200">
                      {log.action}
                    </span>
                  </td>
                  <td className="px-6 py-4 font-semibold text-gray-800">{log.user}</td>
                  <td className="px-6 py-4">
                    <span className="text-xs text-gray-600 bg-gray-100 px-2 py-0.5 rounded font-medium">
                      {log.role}
                    </span>
                  </td>
                  <td className="px-6 py-4 text-gray-600">{log.description}</td>
                  <td className="px-6 py-4 font-mono text-xs text-gray-500">{log.ipAddress}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>

    </div>
  );
};
