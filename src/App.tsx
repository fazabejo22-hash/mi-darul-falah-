import React, { useState } from 'react';
import { initialSchoolProfile, initialUsers, initialRolePermissions, initialActivityLogs, initialDatabaseTables, initialTestResults } from './data/mockData';
import { SchoolProfile, User, UserRole, ActivityLog, DatabaseTableInfo, TestResult } from './types';
import { Header } from './components/Header';
import { Sidebar, ActiveTab } from './components/Sidebar';
import { AdminDashboard } from './components/AdminDashboard';
import { UserRoleManagement } from './components/UserRoleManagement';
import { SchoolProfileManager } from './components/SchoolProfileManager';
import { DatabaseSchemaView } from './components/DatabaseSchemaView';
import { ActivityLogsView } from './components/ActivityLogsView';
import { TestingSuiteView } from './components/TestingSuiteView';
import { Phase1ReportModal } from './components/Phase1ReportModal';

export default function App() {
  const [schoolProfile, setSchoolProfile] = useState<SchoolProfile>(initialSchoolProfile);
  const [users, setUsers] = useState<User[]>(initialUsers);
  const [activityLogs, setActivityLogs] = useState<ActivityLog[]>(initialActivityLogs);
  const [databaseTables] = useState<DatabaseTableInfo[]>(initialDatabaseTables);
  const [testResults] = useState<TestResult[]>(initialTestResults);
  
  const [currentUser, setCurrentUser] = useState<User>(initialUsers[0]); // Super Admin default
  const [activeTab, setActiveTab] = useState<ActiveTab>('dashboard');
  const [isReportOpen, setIsReportOpen] = useState(false);

  const handleSelectRole = (role: UserRole) => {
    const found = users.find(u => u.role === role);
    if (found) {
      setCurrentUser(found);
    } else {
      setCurrentUser({
        id: 99,
        name: `User ${role}`,
        email: `${role.toLowerCase().replace(/[^a-z]/g, '')}@darulfalah.sch.id`,
        role: role,
        isActive: true,
        lastLogin: new Date().toISOString().replace('T', ' ').substring(0, 19)
      });
    }
  };

  const handleUpdateProfile = (updated: SchoolProfile) => {
    setSchoolProfile(updated);
    // Add activity log
    const newLog: ActivityLog = {
      id: Date.now(),
      user: currentUser.name,
      role: currentUser.role,
      action: 'UPDATE_SCHOOL_PROFILE',
      description: `Updated Madrasah profile details (${updated.name})`,
      ipAddress: '192.168.1.15',
      timestamp: new Date().toISOString().replace('T', ' ').substring(0, 19)
    };
    setActivityLogs([newLog, ...activityLogs]);
  };

  return (
    <div className="min-h-screen bg-gray-50 flex flex-col font-['Plus_Jakarta_Sans',sans-serif]">
      
      {/* Header */}
      <Header 
        currentUser={currentUser}
        onSelectRole={handleSelectRole}
        onOpenReport={() => setIsReportOpen(true)}
      />

      {/* Main Body */}
      <div className="flex-1 flex flex-col md:flex-row max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 gap-6">
        
        {/* Sidebar */}
        <Sidebar 
          activeTab={activeTab}
          setActiveTab={(tab) => {
            if (tab === 'report') {
              setIsReportOpen(true);
            } else {
              setActiveTab(tab);
            }
          }}
        />

        {/* Content Area */}
        <main className="flex-1 min-w-0">
          {activeTab === 'dashboard' && (
            <AdminDashboard 
              schoolProfile={schoolProfile}
              users={users}
              activityLogs={activityLogs}
              databaseTables={databaseTables}
              testResults={testResults}
              onNavigate={(tab) => setActiveTab(tab)}
            />
          )}

          {activeTab === 'users' && (
            <UserRoleManagement 
              users={users}
              rolePermissions={initialRolePermissions}
            />
          )}

          {activeTab === 'profile' && (
            <SchoolProfileManager 
              schoolProfile={schoolProfile}
              onUpdateProfile={handleUpdateProfile}
            />
          )}

          {activeTab === 'database' && (
            <DatabaseSchemaView 
              databaseTables={databaseTables}
            />
          )}

          {activeTab === 'activity' && (
            <ActivityLogsView 
              activityLogs={activityLogs}
            />
          )}

          {activeTab === 'testing' && (
            <TestingSuiteView 
              testResults={testResults}
            />
          )}
        </main>

      </div>

      {/* Phase 1 Report Modal */}
      <Phase1ReportModal 
        isOpen={isReportOpen}
        onClose={() => setIsReportOpen(false)}
      />

    </div>
  );
}
