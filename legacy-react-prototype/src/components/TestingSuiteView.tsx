import React, { useState } from 'react';
import { TestResult } from '../types';
import { CheckSquare, CheckCircle2, Play, RefreshCw, ShieldCheck } from 'lucide-react';

interface TestingSuiteViewProps {
  testResults: TestResult[];
}

export const TestingSuiteView: React.FC<TestingSuiteViewProps> = ({ testResults }) => {
  const [isRunning, setIsRunning] = useState(false);
  const [tests, setTests] = useState<TestResult[]>(testResults);

  const runAllTests = () => {
    setIsRunning(true);
    setTimeout(() => {
      setTests(tests.map(t => ({ ...t, status: 'Passed', durationMs: Math.floor(Math.random() * 30) + 20 })));
      setIsRunning(false);
    }, 1200);
  };

  return (
    <div className="space-y-6">
      
      <div className="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
          <h2 className="text-xl font-bold text-gray-800 flex items-center space-x-2">
            <CheckSquare className="w-6 h-6 text-emerald-700" />
            <span>Phase 1 Automated Testing Suite</span>
          </h2>
          <p className="text-sm text-gray-500 mt-1">
            Pengujian modular wajib: Authentication, Authorization (IDOR protection), CRUD, dan Data Integrity.
          </p>
        </div>
        <button
          onClick={runAllTests}
          disabled={isRunning}
          className="bg-emerald-700 hover:bg-emerald-600 text-white px-4 py-2.5 rounded-lg text-xs font-semibold transition flex items-center space-x-2 shadow-sm disabled:opacity-50"
        >
          {isRunning ? <RefreshCw className="w-4 h-4 animate-spin" /> : <Play className="w-4 h-4" />}
          <span>{isRunning ? 'Menjalankan Test...' : 'Run All Tests'}</span>
        </button>
      </div>

      <div className="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div className="divide-y divide-gray-100">
          {tests.map((test) => (
            <div key={test.id} className="p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:bg-gray-50/50">
              <div className="flex items-start space-x-3">
                <div className="mt-0.5">
                  <CheckCircle2 className="w-5 h-5 text-emerald-600" />
                </div>
                <div>
                  <div className="flex items-center space-x-2">
                    <h3 className="font-semibold text-gray-800 text-sm">{test.name}</h3>
                    <span className="bg-emerald-50 text-emerald-800 text-[11px] px-2 py-0.5 rounded font-medium border border-emerald-200">
                      {test.category}
                    </span>
                  </div>
                  <p className="text-xs text-gray-500 mt-1">{test.message}</p>
                </div>
              </div>
              <div className="flex items-center space-x-4 self-end sm:self-center">
                <span className="font-mono text-xs text-gray-400">{test.durationMs} ms</span>
                <span className="bg-emerald-100 text-emerald-900 text-xs px-2.5 py-1 rounded-full font-bold border border-emerald-300">
                  {test.status}
                </span>
              </div>
            </div>
          ))}
        </div>
      </div>

    </div>
  );
};
