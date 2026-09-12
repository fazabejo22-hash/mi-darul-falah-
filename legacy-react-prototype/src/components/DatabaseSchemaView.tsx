import React from 'react';
import { DatabaseTableInfo } from '../types';
import { Database, CheckCircle2, Server, Table } from 'lucide-react';

interface DatabaseSchemaViewProps {
  databaseTables: DatabaseTableInfo[];
}

export const DatabaseSchemaView: React.FC<DatabaseSchemaViewProps> = ({ databaseTables }) => {
  return (
    <div className="space-y-6">
      
      <div className="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
          <h2 className="text-xl font-bold text-gray-800 flex items-center space-x-2">
            <Database className="w-6 h-6 text-emerald-700" />
            <span>Struktur Database & Migrations (Fase 1)</span>
          </h2>
          <p className="text-sm text-gray-500 mt-1">
            Arsitektur modular MySQL/MariaDB dengan relasi foreign key, constraint histori tahun ajaran, dan soft deletes.
          </p>
        </div>
        <div className="bg-emerald-50 text-emerald-800 px-3 py-1.5 rounded-lg text-xs font-semibold border border-emerald-200">
          Status: Fully Migrated & Seeded
        </div>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        {databaseTables.map((table) => (
          <div key={table.name} className="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between">
            <div>
              <div className="flex items-center justify-between pb-3 border-b border-gray-100">
                <div className="flex items-center space-x-2">
                  <Table className="w-4 h-4 text-emerald-700" />
                  <span className="font-mono font-bold text-sm text-gray-800">{table.name}</span>
                </div>
                <span className="bg-emerald-50 text-emerald-700 text-[11px] px-2 py-0.5 rounded font-medium border border-emerald-200">
                  {table.status}
                </span>
              </div>
              <p className="text-xs text-gray-500 mt-3">{table.description}</p>
              
              <div className="mt-4">
                <p className="text-[11px] uppercase tracking-wider font-semibold text-gray-400 mb-1.5">Kolom Utama:</p>
                <div className="flex flex-wrap gap-1">
                  {table.columns.map((col, idx) => (
                    <span key={idx} className="bg-gray-50 text-gray-600 font-mono text-[11px] px-2 py-0.5 rounded border border-gray-100">
                      {col}
                    </span>
                  ))}
                </div>
              </div>
            </div>

            <div className="mt-4 pt-3 border-t border-gray-50 flex items-center justify-between text-xs text-gray-500">
              <span>Total Rows / Seeded:</span>
              <span className="font-mono font-bold text-gray-800">{table.recordsCount}</span>
            </div>
          </div>
        ))}
      </div>

    </div>
  );
};
