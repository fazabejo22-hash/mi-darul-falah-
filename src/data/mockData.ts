import { SchoolProfile, User, ActivityLog, DatabaseTableInfo, TestResult, RolePermission } from '../types';

export const initialSchoolProfile: SchoolProfile = {
  name: "MI Darul Falah",
  npsn: "69881899",
  nsm: "111235150224",
  status: "Swasta",
  accreditation: "B",
  establishedYear: 2007,
  address: "Bendomungal RT/RW 002/001, Sidorejo, Krian, Sidoarjo, Jawa Timur 61262",
  whatsapp: "082139808646",
  email: "midarulfalahpusat@yahoo.com",
  headmaster: "Drs. Ach. Azhari",
  vision: "Berilmu, Berprestasi, Berakhlaqul Karimah",
  extracurriculars: ["Pramuka", "Kaligrafi", "Tahfidz Al-Qur'an", "Pencak Silat Pagar Nusa", "Drumband"],
  facilities: ["Ruang kelas multimedia", "Laboratorium komputer", "Perpustakaan Madrasah", "Masjid Al-Falah", "Lapangan Olahraga", "UKS"]
};

export const initialUsers: User[] = [
  { id: 1, name: "Dr. H. Ahmad Fauzi, M.Pd.I", email: "superadmin@darulfalah.sch.id", role: "Super Admin", phone: "081234567890", isActive: true, lastLogin: "2026-09-11 08:30:00" },
  { id: 2, name: "Siti Aminah, S.Pd", email: "admin.tu@darulfalah.sch.id", role: "Admin/TU", phone: "081345678901", isActive: true, lastLogin: "2026-09-11 09:15:00" },
  { id: 3, name: "Drs. Ach. Azhari", email: "kepala@darulfalah.sch.id", role: "Kepala Madrasah", phone: "082139808646", isActive: true, lastLogin: "2026-09-10 14:20:00" },
  { id: 4, name: "Ustadz M. Zainul Arifin, S.Pd", email: "guru.zainul@darulfalah.sch.id", role: "Guru", phone: "085678901234", isActive: true, lastLogin: "2026-09-11 07:45:00" },
  { id: 5, name: "Ibu Lailatul Fitri, S.Pd", email: "walikelas.laili@darulfalah.sch.id", role: "Wali Kelas", phone: "087890123456", isActive: true, lastLogin: "2026-09-11 08:00:00" },
  { id: 6, name: "Ahmad Zaky Al-Faruq", email: "siswa.zaky@darulfalah.sch.id", role: "Siswa", phone: "089012345678", isActive: true, lastLogin: "2026-09-10 16:10:00" },
  { id: 7, name: "Bpk. H. Abdullah & Ibu Khodijah", email: "ortu.zaky@darulfalah.sch.id", role: "Orang Tua/Wali", phone: "081987654321", isActive: true, lastLogin: "2026-09-09 20:05:00" }
];

export const initialRolePermissions: RolePermission[] = [
  { id: 1, role: "Super Admin", permissions: ["manage-all", "database-migration", "system-settings", "user-management", "activity-logs"] },
  { id: 2, role: "Admin/TU", permissions: ["manage-students", "manage-teachers", "manage-ppdb", "manage-schedule", "manage-news"] },
  { id: 3, role: "Kepala Madrasah", permissions: ["view-reports", "approve-grades", "view-statistics", "manage-school-profile"] },
  { id: 4, role: "Guru", permissions: ["input-grades", "input-attendance", "view-schedule", "manage-teaching-materials"] },
  { id: 5, role: "Wali Kelas", permissions: ["manage-class-students", "recap-attendance", "input-class-grades", "generate-report-cards"] },
  { id: 6, role: "Siswa", permissions: ["view-own-grades", "view-own-attendance", "view-schedule", "view-announcements"] },
  { id: 7, role: "Orang Tua/Wali", permissions: ["view-children-grades", "view-children-attendance", "view-children-reports", "receive-notifications"] }
];

export const initialActivityLogs: ActivityLog[] = [
  { id: 1, user: "Dr. H. Ahmad Fauzi, M.Pd.I", role: "Super Admin", action: "LOGIN", description: "Successful login from Admin Dashboard", ipAddress: "192.168.1.15", timestamp: "2026-09-11 08:30:00" },
  { id: 2, user: "Siti Aminah, S.Pd", role: "Admin/TU", action: "UPDATE_PROFILE", description: "Updated Madrasah contact details", ipAddress: "192.168.1.22", timestamp: "2026-09-11 09:15:00" },
  { id: 3, user: "Dr. H. Ahmad Fauzi, M.Pd.I", role: "Super Admin", action: "RUN_MIGRATION", description: "Executed php artisan migrate:fresh --seed", ipAddress: "192.168.1.15", timestamp: "2026-09-11 07:00:00" },
  { id: 4, user: "Ibu Lailatul Fitri, S.Pd", role: "Wali Kelas", action: "ATTENDANCE_RECORD", description: "Recorded attendance for Class 6A", ipAddress: "192.168.1.45", timestamp: "2026-09-11 08:15:00" }
];

export const initialDatabaseTables: DatabaseTableInfo[] = [
  { name: "users", columns: ["id", "name", "email", "password", "role_id", "timestamps"], recordsCount: 7, status: "Migrated", description: "Core user accounts and authentication credentials" },
  { name: "roles", columns: ["id", "name", "guard_name", "timestamps"], recordsCount: 7, status: "Migrated", description: "Role definitions (Super Admin down to Parent)" },
  { name: "permissions", columns: ["id", "name", "guard_name", "timestamps"], recordsCount: 24, status: "Migrated", description: "Granular access control permissions" },
  { name: "school_profiles", columns: ["id", "name", "npsn", "nsm", "address", "headmaster", "timestamps"], recordsCount: 1, status: "Migrated", description: "Dynamic school identity and profile settings" },
  { name: "teachers", columns: ["id", "user_id", "nip", "specialization", "timestamps"], recordsCount: 15, status: "Migrated", description: "Madrasah educators and staff profiles" },
  { name: "students", columns: ["id", "user_id", "nisn", "gender", "birth_date", "timestamps"], recordsCount: 245, status: "Migrated", description: "Enrolled students with historical tracking" },
  { name: "parents", columns: ["id", "user_id", "occupation", "address", "timestamps"], recordsCount: 190, status: "Migrated", description: "Parent and guardian records supporting multi-child linkage" },
  { name: "academic_years", columns: ["id", "name", "is_active", "timestamps"], recordsCount: 3, status: "Migrated", description: "Academic year history (e.g., 2025/2026, 2026/2027)" },
  { name: "activity_logs", columns: ["id", "user_id", "action", "description", "ip_address", "timestamps"], recordsCount: 1250, status: "Migrated", description: "Security audit trail and system activity logs" }
];

export const initialTestResults: TestResult[] = [
  { id: "test-1", name: "Authentication Test (Login & Hash Verification)", category: "Security", status: "Passed", durationMs: 45, message: "Successfully verified password hashing (Bcrypt) and session generation." },
  { id: "test-2", name: "Authorization & Role Policy Test", category: "Security", status: "Passed", durationMs: 32, message: "IDOR protection verified; user cannot access unauthorized endpoints." },
  { id: "test-3", name: "School Profile Dynamic CRUD Test", category: "Data Management", status: "Passed", durationMs: 28, message: "School profile successfully updated and fetched dynamically from database." },
  { id: "test-4", name: "Multi-Child Parent Relationship Test", category: "Database Integrity", status: "Passed", durationMs: 51, message: "Verified that one parent account correctly links to multiple student records." },
  { id: "test-5", name: "Historical Academic Year Integrity Test", category: "Academic Core", status: "Passed", durationMs: 60, message: "Ensured class assignments and homeroom teachers preserve history across academic years." }
];
