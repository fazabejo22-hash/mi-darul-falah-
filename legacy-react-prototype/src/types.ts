export type UserRole = 
  | 'Super Admin' 
  | 'Admin/TU' 
  | 'Kepala Madrasah' 
  | 'Guru' 
  | 'Wali Kelas' 
  | 'Siswa' 
  | 'Orang Tua/Wali';

export interface User {
  id: number;
  name: string;
  email: string;
  role: UserRole;
  avatar?: string;
  phone?: string;
  isActive: boolean;
  lastLogin?: string;
}

export interface RolePermission {
  id: number;
  role: UserRole;
  permissions: string[];
}

export interface SchoolProfile {
  name: string;
  npsn: string;
  nsm: string;
  status: string;
  accreditation: string;
  establishedYear: number;
  address: string;
  whatsapp: string;
  email: string;
  headmaster: string;
  vision: string;
  extracurriculars: string[];
  facilities: string[];
}

export interface ActivityLog {
  id: number;
  user: string;
  role: UserRole;
  action: string;
  description: string;
  ipAddress: string;
  timestamp: string;
}

export interface DatabaseTableInfo {
  name: string;
  columns: string[];
  recordsCount: number;
  status: 'Migrated' | 'Pending';
  description: string;
}

export interface TestResult {
  id: string;
  name: string;
  category: string;
  status: 'Passed' | 'Failed' | 'Running';
  durationMs: number;
  message: string;
}
