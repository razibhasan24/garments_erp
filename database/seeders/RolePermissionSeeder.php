<?php
// database/seeders/RolePermissionSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Users & Access
            'manage-users', 'manage-roles',
            // Masters
            'manage-buyers', 'manage-styles', 'manage-machines', 'manage-lines',
            // Orders / Merchandising
            'view-orders', 'create-orders', 'edit-orders', 'delete-orders', 'approve-orders',
            // Production
            'manage-cutting', 'manage-sewing-production', 'view-production-reports',
            // QC
            'manage-qc-inline', 'manage-qc-endline', 'manage-qc-final',
            // Inventory
            'manage-inventory', 'manage-grn', 'manage-store-issue',
            // HR
            'manage-employees', 'manage-attendance', 'manage-leave', 'manage-payroll',
            // Accounts
            'manage-invoices', 'manage-expenses', 'view-ledger',
            // Reports & Settings
            'view-dashboard', 'view-reports', 'manage-settings', 'view-audit-logs',
            // add to $permissions array in RolePermissionSeeder
            'manage-departments', 'manage-designations', 'manage-floors', 'manage-lines', 'manage-machines',
            // add to RolePermissionSeeder $permissions array
            'manage-leave-types', 'approve-leave',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        $roles = [
            'Super Admin'        => $permissions, // gets everything
            'Factory Admin'      => $permissions,
            'Merchandiser'       => ['view-orders', 'create-orders', 'edit-orders', 'manage-buyers', 'manage-styles', 'view-dashboard'],
            'Production Manager' => ['manage-cutting', 'manage-sewing-production', 'view-production-reports', 'manage-lines', 'view-dashboard'],
            'Line Supervisor'    => ['manage-sewing-production', 'view-dashboard'],
            'QC Inspector'       => ['manage-qc-inline', 'manage-qc-endline', 'manage-qc-final', 'view-dashboard'],
            'Store Keeper'       => ['manage-inventory', 'manage-grn', 'manage-store-issue', 'view-dashboard'],
            'HR Manager'         => ['manage-employees', 'manage-attendance', 'manage-leave', 'manage-payroll', 'view-dashboard'],
            'Accountant'         => ['manage-invoices', 'manage-expenses', 'view-ledger', 'view-dashboard'],
            'Viewer'             => ['view-dashboard', 'view-reports'],
        ];

        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($perms);
        }
    }
}
